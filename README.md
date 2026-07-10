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

## Local Development Setup

To develop this package locally and see your changes immediately in a Laravel host application:

### 1. Symlink the PHP Package (Composer)

In your host application's `composer.json` file:

1. Add the local path repository pointing to this package's directory:
   ```json
   "repositories": [
       {
           "type": "path",
           "url": "../sales-management",
           "options": {
               "symlink": true
           }
       }
   ]
   ```
2. Update the package version requirement to target your active branch (e.g. `dev-main`):
   ```json
   "require": {
       "teamtnt/sales-management": "dev-main"
   }
   ```
3. Run the update command to symlink the package:
   - **For local environments (Valet, Herd, Native PHP):**
     ```bash
     composer update teamtnt/sales-management
     ```
   - **For Docker environments:**
     Run the composer update command *inside* the container to ensure the relative symlink resolves correctly within the container's virtualized filesystem:
     ```bash
     docker exec <container_name> composer update teamtnt/sales-management
     ```

### 2. Symlink the Public Assets (Vite)

This package compiles frontend assets into its own `public/sales-management` directory. To see JS/CSS changes immediately in the host app without repeatedly running `php artisan vendor:publish`:

- **For local environments (Valet, Herd, Native PHP):**
  From the host application's root directory, run:
  ```bash
  rm -rf public/sales-management
  ln -s ../vendor/teamtnt/sales-management/public/sales-management public/sales-management
  ```
- **For Docker environments:**
  Because Docker virtualization layers (like VirtioFS or gRPC FUSE) isolate mounts and restrict relative symlinks that traverse outside of the project volume, you should create an **absolute container-internal symlink** instead:
  ```bash
  docker exec <container_name> rm -rf /var/www/<host_app>/public/sales-management
  docker exec <container_name> ln -s /var/www/sales-management/public/sales-management /var/www/<host_app>/public/sales-management
  ```

### 3. Building & Compiling Assets

When editing JS/CSS files within the package:
1. Make sure npm dependencies are installed in the package directory:
   ```bash
   npm install
   ```
2. Run Vite build to compile changes:
   ```bash
   npm run build
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
