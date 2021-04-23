<?php

namespace CraigPotter\LaravelIEHoneypot;

use CraigPotter\LaravelIEHoneypot\Commands\LaravelIEHoneypotCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelIEHoneypotServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-ie-honeypot')
            ->hasConfigFile()
            ->hasCommand(LaravelIEHoneypotCommand::class);
    }
}
