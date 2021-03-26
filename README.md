# A small package to capture IE users and recommend they use a modern browser before they hit your site

[![Latest Version on Packagist](https://img.shields.io/packagist/v/craigpotter/laravel-ie-honeypot.svg?style=flat-square)](https://packagist.org/packages/craigpotter/laravel-ie-honeypot)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/craigpotter/laravel-ie-honeypot/run-tests?label=tests)](https://github.com/craigpotter/laravel-ie-honeypot/actions?query=workflow%3ATests+branch%3Amaster)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/craigpotter/laravel-ie-honeypot/Check%20&%20fix%20styling?label=code%20style)](https://github.com/craigpotter/laravel-ie-honeypot/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/craigpotter/laravel-ie-honeypot.svg?style=flat-square)](https://packagist.org/packages/craigpotter/laravel-ie-honeypot)


This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/package-laravel-ie-honeypot-laravel.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/package-laravel-ie-honeypot-laravel)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require craigpotter/laravel-ie-honeypot
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --provider="CraigPotter\LaravelIEHoneypot\LaravelIEHoneypotServiceProvider" --tag="ie-honeypot-migrations"
php artisan migrate
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="CraigPotter\LaravelIEHoneypot\LaravelIEHoneypotServiceProvider" --tag="ie-honeypot-config"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

```php
$laravel-ie-honeypot = new CraigPotter\LaravelIEHoneypot();
echo $laravel-ie-honeypot->echoPhrase('Hello, CraigPotter!');
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
