<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Auth;
use App\Models\Record;
use App\Models\Prop;
use Exception;
use Error;
use Throwable;

class ImportController extends Controller
{
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

    public function answer (Prop $prop) {
        if ((int) $prop->getProp('import_redirect')) {
            return to_route('app.record.index')->with(['status' => 'Данные загружены']);
        } else {
            return back()->with(['status' => 'Данные загружены']);
        }
    }

    public function local_disk () {
        return Storage::disk('records');
    }

    public function ftp_disk (Prop $prop) {
        return Storage::build([
            'driver' => 'ftp',
            'host' => $prop->getProp('ftp_host'),
            'username' => $prop->getProp('ftp_username'),
            'password' => $prop->getProp('ftp_password'),
            'root' => $prop->getProp('ftp_root'),
            'port' => (int) $prop->getProp('ftp_port'),
        ]);
    }

    public function import (Prop $prop) {
        $limit = (int) $prop->getProp('import_limit');
        $current = 0;
        try {
            if (!$list = $this->ftp_disk($prop)->files()) {
                return back()->withErrors(['status' => 'Нет новых данных']);
            }
            foreach ($list as $k => $v) {
                if ($current == $limit and $limit != 0) {
                    return back()->with(['status' => 'Данные частично загружены']);
                }
                $current++;
                $file = $this->ftp_disk($prop)->get($v);
                $this->local_disk()->put($v, $file);
                $this->ftp_disk($prop)->delete($v);
                Record::create($this->parse($v));
                sleep((float) $prop->getProp('import_sleep'));
            }
            return $this->answer($prop);
        } catch (Exception $e) {
            return back()->withErrors(['status' => 'Исключение [FTP]']);
        } catch (Error $e) {
            return back()->withErrors(['status' => 'Ошибка [FTP]']);
        } catch (Throwable $e) {
            return back()->withErrors(['status' => 'ОМГ, ты не должен был это увидеть...']);
        }
    }
}
