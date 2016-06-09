<?php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as BaseEncrypter;

class EncryptCookies extends BaseEncrypter
{
    /**
     * The names of the cookies that should not be encrypted.
     *
     * @var array
     */
    protected $except = [
        // Cookies are NOT used in this DB project.
        // In another project(Human-Computer Interface) my teammate used javascript to set cookie but it's so silly because I have to put the names of those cookies in this array and the project will be vulnerable then.
    ];
}
