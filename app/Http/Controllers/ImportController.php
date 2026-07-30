<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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

    public function import () {
        $records_disk = Storage::disk('records');
        $inputs_disk = Storage::disk('inputs');
        if ($this->checkRequestStatus()) {
            return back()->withErrors(['status' => 'Запрос уже выполняется']);
        }
        try {
            if (!$list = $inputs_disk->files()) {
                return back()->with(['status' => 'Нет новых данных']);
            }
            foreach ($list as $k => $v) {
               if (!$this->checkFileName($v)) {
                    return back()->withErrors(['status' => 'Найден временный файл']);
               }
                $records_disk->put($v, $inputs_disk->get($v));
                $inputs_disk->delete($v);
                Record::create($this->parse($v));
            }
        } catch (Exception $e) {
            return back()->withErrors(['status' => 'Исключение']);
        } catch (Error $e) {
            return back()->withErrors(['status' => 'Ошибка']);
        } catch (Throwable $e) {
            return back()->withErrors(['status' => 'ОМГ, ты не должен был это увидеть...']);
        }
        return back()->with(['status' => 'Данные загружены']);
    }
}
