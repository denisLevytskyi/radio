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
        preg_match('/\h(KHz|MHz|GHz)\.wav$/u', $filename, $match);
        $unit = $match[1] ?? 'MHz';
        $basename = preg_replace('/\h(?:KHz|MHz|GHz)\.wav$/u', '', $filename);
        $parts = explode('.', $basename);
        $freq = (float) str_replace(',', '.', preg_replace('/\h+/u', '', $parts[2]));
        switch ($unit) {
            case 'KHz':
                $freq /= 1000;
                break;
            case 'GHz':
                $freq *= 1000;
                break;
        }
        return [
            'user_id' => Auth::user()->id,
            'timestamp' => Carbon::createFromFormat('Y_m_dH-i-s', $parts[0] . $parts[1])->toDateTimeString(),
            'freq' => $freq,
            'file' => $filename,
        ];
    }

    public function checkFileName (string $filename) {
        return preg_match('/^\d{4}_\d{2}_\d{2}\.\d{2}-\d{2}-\d{2}\..+\h(?:KHz|MHz|GHz)\.wav$/u', $filename) === 1;
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
        $start = Carbon::now()->getTimestamp();
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
                if ($start + 15 <= Carbon::now()->getTimestamp()) {
                    return back()->withErrors(['status' => 'Исчерпан лимит времени']);
                } elseif (!$this->checkFileName($v)) {
                    $inputs_disk->delete($v);
                    return back()->withErrors(['status' => 'Найден и удален временный файл: ' . $v]);
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
