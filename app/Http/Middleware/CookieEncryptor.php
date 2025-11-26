<?php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

class CookieEncryptor extends Middleware
{
    /**
     * Nama cookie yang tidak dienkripsi.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
    ];
}
