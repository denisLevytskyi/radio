<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Auth;
use App\Models\Record;
use Exception;
use Error;
use Throwable;

class ImportController extends Controller
{
    public function __destruct () {
        if ($this->canChangeStatus) {
            $this->prop->updateOrCreate(['key' => 'app_import_status'], ['value' => 0]);
        }
    }

    public function answer () {
        if ((int) $this->prop->getProp('import_redirect')) {
            return to_route('app.record.index')->with(['status' => 'Данные загружены']);
        } else {
            return back()->with(['status' => 'Данные загружены']);
        }
    }

    public function fakeSleep (int $time) {
        if (!$time) {
            return FALSE;
        }
        return Http::get('https://httpbin.org/delay/' . $time);
    }

    public function parse (string $filename) {
        $basename = str_replace(' MHz.wav', '', $filename);
        $parts = explode('.', $basename);
        return [
            'user_id' => Auth::user()->id,
            'timestamp' => Carbon::createFromFormat('Y_m_dH-i-s', $parts[0] . $parts[1])->toDateTimeString(),
            'freq' => (float) str_replace(',', '.', $parts[2]),
            'file' => $filename,
        ];
    }

    public function checkFileName (string $filename) {
        return is_numeric($filename[0]);
    }

    public bool $canChangeStatus = FALSE;

    public function checkRequestStatus () {
        if ((int) $this->prop->getProp('app_import_status')) {
            return TRUE;
        } else {
            $this->canChangeStatus = TRUE;
            $this->prop->updateOrCreate(['key' => 'app_import_status'], ['value' => 1]);
            return FALSE;
        }
    }

    public function set_records_disk () {
        return Storage::disk('records');
    }

    public function local_disk () {
        return $this->set_records_disk();
    }

    public function set_ftp_disk () {
        $this->disk = Storage::build([
            'driver' => 'ftp',
            'host' => $this->prop->getProp('ftp_host'),
            'username' => $this->prop->getProp('ftp_username'),
            'password' => $this->prop->getProp('ftp_password'),
            'root' => $this->prop->getProp('ftp_root'),
            'port' => (int) $this->prop->getProp('ftp_port'),
            'passive' => (bool) (int) $this->prop->getProp('ftp_passive'),
            'timeout' => (int) $this->prop->getProp('ftp_timeout'),
        ]);
    }

    public function set_self_disk () {
        $this->disk = Storage::build([
            'driver' => 'local',
            'root' => storage_path('app/self/' . $this->prop->getProp('self_path')),
            'throw' => false,
        ]);
    }

    public bool $isDiskSet = FALSE;

    public object $disk;

    public function remote_disk () {
        if (!(int) $this->prop->getProp('import_separate') and $this->isDiskSet) {
            return $this->disk;
        } elseif ((int) $this->prop->getProp('import_disk') == 0) {
            $this->set_self_disk();
        } elseif ((int) $this->prop->getProp('import_disk') == 1) {
            $this->set_ftp_disk();
        } else {
            abort(404);
        }
        $this->isDiskSet = TRUE;
        return $this->disk;
    }

    public function import () {
        $limit = (int) $this->prop->getProp('import_limit');
        $start = Carbon::now()->getTimestamp();
        $remote_disk = $this->remote_disk();
        $local_disk = $this->local_disk();
        if ($this->checkRequestStatus()) {
            return back()->withErrors(['status' => 'Запрос уже выполняется']);
        }
        try {
            if (!$list = $remote_disk->files()) {
                return back()->with(['status' => 'Нет новых данных']);
            }
            foreach ($list as $k => $v) {
                if ($start + $limit <= Carbon::now()->getTimestamp() and $limit != 0) {
                    return back()->withErrors(['status' => 'Исчерпан лимит времени']);
                } elseif (!$this->checkFileName($v)) {
                    return back()->withErrors(['status' => 'Найден временный файл']);
                }
                $local_disk->put($v, $remote_disk->get($v));
                $remote_disk->delete($v);
                Record::create($this->parse($v));
                $remote_disk = $this->remote_disk();
                $this->fakeSleep((int) $this->prop->getProp('import_sleep'));
            }
            return $this->answer();
        } catch (Exception $e) {
            return back()->withErrors(['status' => 'Исключение [FTP]']);
        } catch (Error $e) {
            return back()->withErrors(['status' => 'Ошибка [FTP]']);
        } catch (Throwable $e) {
            return back()->withErrors(['status' => 'ОМГ, ты не должен был это увидеть...']);
        }
    }
}
