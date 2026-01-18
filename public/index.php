<?php

error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));
