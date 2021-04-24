# A small package to capture IE users and redirect them before they hit your site

[![Latest Version on Packagist](https://img.shields.io/packagist/v/craigpotter/laravel-ie-honeypot.svg?style=flat-square)](https://packagist.org/packages/craigpotter/laravel-ie-honeypot)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/craigpotter/laravel-ie-honeypot/run-tests?label=tests)](https://github.com/craigpotter/laravel-ie-honeypot/actions?query=workflow%3ATests+branch%3Amaster)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/craigpotter/laravel-ie-honeypot/Check%20&%20fix%20styling?label=code%20style)](https://github.com/craigpotter/laravel-ie-honeypot/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/craigpotter/laravel-ie-honeypot.svg?style=flat-square)](https://packagist.org/packages/craigpotter/laravel-ie-honeypot)


Web development should be a progressive journey and let's face it, we all hate Microsoft Internet Explorer. 
Have you had an issue where users were using IE, getting JS errors and then complaining about how your application is broken?
This simple package might be for you then! Laravel IE Honeypot detects requests coming in to the app from users using IE and redirects to a page of your choice. 
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

    /**
     * This switch determines if the bypass functionality is enabled.
     * This will allow use of the @ieBypass directive and allow IE users to access your
     * site by adding ?ie-bypass=true to a url
     */
    'bypass_enabled' => env('IE_HONEYPOT_BYPASS_ENABLED', true),

];
```

## Usage

If you want to display a page within your own application to your IE users, you should create a route with a simple layout and add the URL to your configuration file.  

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

## Bypass

If the `bypass_enabled` option is true in your configuration, the middleware will allow any user to a path if it has a url param of `ie-bypass=true`. 
You can share links with this bypass if you need to e.g `https://your-app.com/contact-us?ie-bypass=true` 

You also have the option to add this to your own bypass page to allow users to proceed at their own risk. 
For example, if a user visits `/contact-us` with an IE browser, they would be redirected to our `redirect_url`, you can use the `@ieBypass` blade directive to automatically generate the bypass url for the initial page visited. In this case, it would be `/contact-us?ie-bypass=true`. 
If we look at the view for that page: 

```blade
    <div>
        <h1>Use a better browser!>

        <a href="@ieBypass">Click here to proceed at your own risk</a>
    </div>
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
