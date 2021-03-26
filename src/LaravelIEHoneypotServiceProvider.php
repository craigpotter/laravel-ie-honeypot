<?php

namespace CraigPotter\LaravelIEHoneypot;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use CraigPotter\LaravelIEHoneypot\Commands\LaravelIEHoneypotCommand;

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
            ->hasViews()
            ->hasMigration('create_laravel_ie_honeypot_table')
            ->hasCommand(LaravelIEHoneypotCommand::class);
    }
}
