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

    public function import () {
        try {
            if (!$list = Storage::disk('ftp')->files()) {
                return back()->withErrors(['status' => 'Нет новых записей']);
            }
            foreach ($list as $k => $v) {
                $file = Storage::disk('ftp')->get($v);
                Storage::disk('records')->put($v, $file);
                Storage::disk('ftp')->delete($v);
                Record::create($this->parse($v));
            }
            return back()->with(['status' => 'Данные загружены']);
        } catch (Exception $e) {
            return back()->withErrors(['status' => 'Исключение [FTP]']);
        } catch (Error $e) {
            return back()->withErrors(['status' => 'Ошибка [FTP]']);
        } catch (Throwable $e) {
            return back()->withErrors(['status' => 'Ошибка...']);
        }
    }
}
