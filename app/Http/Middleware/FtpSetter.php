<?php

namespace App\Http\Middleware;

use App\Models\Prop;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FtpSetter
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $model = new Prop();
        config([
            'filesystems.disks.ftp' => [
                'driver' => 'ftp',
                'host' => $model->getProp('ftp_host'),
                'username' => $model->getProp('ftp_username'),
                'password' => $model->getProp('ftp_password'),
                'root' => $model->getProp('ftp_root'),
                'port' => (int) $model->getProp('ftp_port'),
            ]
        ]);
        return $next($request);
    }
}
