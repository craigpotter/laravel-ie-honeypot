<?php

namespace CraigPotter\LaravelIEHoneypot;

use CraigPotter\LaravelIEHoneypot\Commands\LaravelIEHoneypotCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelIEHoneypotServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-ie-honeypot')
            ->hasConfigFile()
            ->hasCommand(LaravelIEHoneypotCommand::class);
    }
}
