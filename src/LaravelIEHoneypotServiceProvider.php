<?php

namespace CraigPotter\LaravelIEHoneypot;

use Illuminate\Support\Facades\Blade;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelIEHoneypotServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-ie-honeypot')
            ->hasConfigFile();
    }

    public function bootingPackage()
    {
        parent::bootingPackage();
        Blade::directive('ieBypass', function () {
            return "<?php echo session('ie-bypass-trapped', ''); ?>?ie-bypass=true";
        });
    }
}
