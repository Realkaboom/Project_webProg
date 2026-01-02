<?php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

class CookieEncryptor extends Middleware
{
    protected $except = [
        
    ];
}
