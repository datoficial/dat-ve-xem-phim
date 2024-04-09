<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\QuanLy;
use App\Http\Middleware\NhanVien;
use App\Http\Middleware\KhachHang;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->appendToGroup('manager', [
            QuanLy::class,
        ]);
        $middleware->prependToGroup('nhanvien', [
            NhanVien::class,
        ]);
        $middleware->prependToGroup('user', [
            KhachHang::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
