# A small package to capture IE users and recommend they use a modern browser before they hit your site

[![Latest Version on Packagist](https://img.shields.io/packagist/v/craigpotter/laravel-ie-honeypot.svg?style=flat-square)](https://packagist.org/packages/craigpotter/laravel-ie-honeypot)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/craigpotter/laravel-ie-honeypot/run-tests?label=tests)](https://github.com/craigpotter/laravel-ie-honeypot/actions?query=workflow%3ATests+branch%3Amaster)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/craigpotter/laravel-ie-honeypot/Check%20&%20fix%20styling?label=code%20style)](https://github.com/craigpotter/laravel-ie-honeypot/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/craigpotter/laravel-ie-honeypot.svg?style=flat-square)](https://packagist.org/packages/craigpotter/laravel-ie-honeypot)


Web development should be a progressive journey and let's face it, we all hate Microsoft Internet Explorer.
Have you had an issue where users were using IE and getting JS errors and complaining about how you application is broken?
This simple package might be for you then! Laravel IE Honeypot detects requests coming in to the app and redirects IE Users to a page of your choice. 
This should be a simple page informing the user their browser is too old or maybe even link them to [what they deserve](https://bit.ly/IqT6zt)

## Installation

You can install the package via composer:

```bash
composer require craigpotter/laravel-ie-honeypot
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="CraigPotter\LaravelIEHoneypot\LaravelIEHoneypotServiceProvider" --tag="ie-honeypot-config"
```

This is the contents of the published config file:

```php
return [
    /**
     * This switch determines if the honeypot protection should be activated.
     */
    'enabled' => env('IE_HONEYPOT_ENABLED', true),

    /**
     * This switch determines the URL that IE users will get redirect to.
     */
    'redirect_url' => env('IE_HONEYPOT_REDIRECT_URL', '/ie-trap'),

];
```

## Usage

There are two main ways to use this package but both involve adding middleware to your routes. 

### Option 1

Add the middleware to indiviual routes in your routes file or to a group of routes.
This option might be best if you have a single point of entry for your application. For example, Users have to login so you might choose to add it to your login route only. 

```php
use CraigPotter\LaravelIEHoneypot\CaptureIE;

Route::get('/', [YourController::class])->middleware(CaptureIE::class);

// OR

Route::middleware(CaptureIE::class)->group(function() {
    // Routes
});
```

### Option 2

If you have a lot of routes or just need to keep those pesky IE Users off your site, you could register it as global middleware

```php
// app\Http\Kernal.php 

protected $middleware = [
   // ...
   \CraigPotter\LaravelIEHoneypot\CaptureIE::class,
];

```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Craig Potter](https://github.com/CraigPotter)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
