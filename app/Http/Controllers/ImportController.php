<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Auth;
use App\Models\Record;
use App\Models\Prop;
use Exception;
use Error;
use Throwable;

class ImportController extends Controller
{
    public function __construct (public Prop $prop, public bool $isDiskSet = FALSE) {}

    public function fakeSleep ($time) {
        if (!$time) {
            return FALSE;
        }
        return Http::get('https://httpbin.org/delay/' . $time);
    }

    public function parse ($filename) {
        $basename = str_replace(' MHz.wav', '', $filename);
        $parts = explode('.', $basename);
        return [
            'user_id' => Auth::user()->id,
            'timestamp' => Carbon::createFromFormat('Y_m_dH-i-s', $parts[0] . $parts[1])->toDateTimeString(),
            'freq' => (float) str_replace(',', '.', $parts[2]),
            'path' => $filename,
        ];
    }

    public function answer () {
        if ((int) $this->prop->getProp('import_redirect')) {
            return to_route('app.record.index')->with(['status' => 'Данные загружены']);
        } else {
            return back()->with(['status' => 'Данные загружены']);
        }
    }

    public function local_disk () {
        return Storage::disk('records');
    }

    public function ftp_disk () {
        if ((int) $this->prop->getProp('import_separate') or !$this->isDiskSet) {
            $this->isDiskSet = TRUE;
            $this->disk = Storage::build([
                'driver' => 'ftp',
                'host' => $this->prop->getProp('ftp_host'),
                'username' => $this->prop->getProp('ftp_username'),
                'password' => $this->prop->getProp('ftp_password'),
                'root' => $this->prop->getProp('ftp_root'),
                'port' => (int) $this->prop->getProp('ftp_port'),
            ]);
        }
        return $this->disk;
    }

    public function import () {
        $limit = (int) $this->prop->getProp('import_limit');
        $start = Carbon::now()->getTimestamp();
        $frp_disk = $this->ftp_disk();
        $local_disk = $this->local_disk();
        try {
            if (!$list = $frp_disk->files()) {
                return back()->withErrors(['status' => 'Нет новых данных']);
            }
            foreach ($list as $k => $v) {
                if ($start + $limit <= Carbon::now()->getTimestamp() and $limit != 0) {
                    return back()->withErrors(['status' => 'Исчерпан лимит времени']);
                }
                $local_disk->put($v, $frp_disk->get($v));
                $frp_disk->delete($v);
                Record::create($this->parse($v));
                $frp_disk = $this->ftp_disk();
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
