<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Exception;
use Error;
use Throwable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExportController extends ImportController
{
    public function __destruct () {
        if ($this->canChangeStatus) {
            $this->prop->updateOrCreate(['key' => 'app_export_status'], ['value' => 0]);
        }
    }

    public function checkRequestStatus () {
        if ((int) $this->prop->getProp('app_export_status')) {
            return TRUE;
        } else {
            $this->canChangeStatus = TRUE;
            $this->prop->updateOrCreate(['key' => 'app_export_status'], ['value' => 1]);
            return FALSE;
        }
    }

    public function set_temp_disk () {
        return Storage::build([
            'driver' => 'local',
            'root' => storage_path('app/temp/' . $this->prop->getProp('temp_path')),
            'throw' => false,
        ]);
    }

    public function local_disk () {
        return $this->set_temp_disk();
    }

    public function set_out_disk () {
        $this->disk = Storage::build([
            'driver' => 'ftp',
            'host' => $this->prop->getProp('out_host'),
            'username' => $this->prop->getProp('out_username'),
            'password' => $this->prop->getProp('out_password'),
            'root' => $this->prop->getProp('out_root'),
            'port' => (int) $this->prop->getProp('out_port'),
            'passive' => (bool) (int) $this->prop->getProp('out_passive'),
            'timeout' => (int) $this->prop->getProp('out_timeout'),
        ]);
    }

    public function remote_disk () {
        if (!(int) $this->prop->getProp('export_separate') and $this->isDiskSet) {
            return $this->disk;
        } else {
            $this->set_out_disk();
        }
        $this->isDiskSet = TRUE;
        return $this->disk;
    }

    public function export () {
        $limit = (int) $this->prop->getProp('export_limit');
        $start = Carbon::now()->getTimestamp();
        $remote_disk = $this->remote_disk();
        $local_disk = $this->local_disk();
        if ($this->checkRequestStatus()) {
            return back()->withErrors(['status' => 'Запрос уже выполняется']);
        }
        try {
            if (!$list = $local_disk->files()) {
                return back()->with(['status' => 'Нет новых данных']);
            }
            foreach ($list as $k => $v) {
                if ($start + $limit <= Carbon::now()->getTimestamp() and $limit != 0) {
                    return back()->withErrors(['status' => 'Исчерпан лимит времени']);
                } elseif (!$this->checkFileName($v)) {
                    return back()->withErrors(['status' => 'Найден временный файл']);
                }
                $remote_disk->put($v, $local_disk->get($v));
                $local_disk->delete($v);
                $remote_disk = $this->remote_disk();
                $this->fakeSleep((int) $this->prop->getProp('export_sleep'));
            }
            return back()->with(['status' => 'Данные отправлены']);
        } catch (Exception $e) {
            return back()->withErrors(['status' => 'Исключение [FTP]']);
        } catch (Error $e) {
            return back()->withErrors(['status' => 'Ошибка [FTP]']);
        } catch (Throwable $e) {
            return back()->withErrors(['status' => 'ОМГ, ты не должен был это увидеть...']);
        }
    }
}
