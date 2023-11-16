# A minimalistic approach to sales management

[![Latest Version on Packagist](https://img.shields.io/packagist/v/teamtnt/sales-management.svg?style=flat-square)](https://packagist.org/packages/teamtnt/sales-management)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/teamtnt/sales-management/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/teamtnt/sales-management/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/teamtnt/sales-management/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/teamtnt/sales-management/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/teamtnt/sales-management.svg?style=flat-square)](https://packagist.org/packages/teamtnt/sales-management)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require teamtnt/sales-management
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="sales-management-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="sales-management-config"
```

This is the contents of the published config file:

```php
return [
];
```

Optionally, you can publish the views using

```bash
php artisan vendor:publish --tag="sales-management-views"
```

Publishing assets

```bash
php artisan vendor:publish --tag="sales-management-assets"
```

## Building Assets

We use Vite to build assets. First install all dependencies.

```js
npm
install
```

If there is no **public** folder in project root run first production build which will build needed folders:

```js
npm
run
build
```

Development build:

```js
npm
run
dev
```

For local development to have hot reloading create a symlink

`ln -s ../vendor/teamtnt/sales-management/public/sales-management public/sales-management`

Add to composer.json

```
    "repositories": [{
        "type": "path",
        "url": "../sales-management"
    }],
    "require": {
        "teamtnt/sales-management": "@dev"
    }
```

## Usage

```php
$salesManagement = new Teamtnt\SalesManagement();
echo $salesManagement->echoPhrase('Hello, Teamtnt!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Nenad Ticaric](https://github.com/teamtnt)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
