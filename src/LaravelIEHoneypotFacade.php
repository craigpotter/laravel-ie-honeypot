<?php

namespace CraigPotter\LaravelIEHoneypot;

use Illuminate\Support\Facades\Facade;

/**
 * @see \CraigPotter\LaravelIEHoneypot\LaravelIEHoneypot
 */
class LaravelIEHoneypotFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-ie-honeypot';
    }
}
