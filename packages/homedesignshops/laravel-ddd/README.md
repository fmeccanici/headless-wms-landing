# Laravel DDD

[comment]: <> ([![Latest Version on Packagist]&#40;https://img.shields.io/packagist/v/homedesignshops/laravel-ddd.svg?style=flat-square&#41;]&#40;https://packagist.org/packages/homedesignshops/laravel-ddd&#41;)

[comment]: <> ([![Build Status]&#40;https://img.shields.io/travis/homedesignshops/laravel-ddd/master.svg?style=flat-square&#41;]&#40;https://travis-ci.org/homedesignshops/laravel-ddd&#41;)

[comment]: <> ([![Quality Score]&#40;https://img.shields.io/scrutinizer/g/homedesignshops/laravel-ddd.svg?style=flat-square&#41;]&#40;https://scrutinizer-ci.com/g/homedesignshops/laravel-ddd&#41;)

[comment]: <> ([![Total Downloads]&#40;https://img.shields.io/packagist/dt/homedesignshops/laravel-ddd.svg?style=flat-square&#41;]&#40;https://packagist.org/packages/homedesignshops/laravel-ddd&#41;)

This package provides you the structure of Domain Driven Development in Laravel via the command line interface.

## Installation

Clone the Laravel DDD package into `packages/homedesignshops/laravel-ddd`
```bash
# Mac
git clone homedesignshops@vs-ssh.visualstudio.com:v3/homedesignshops/Legacy.SiteManager.Web/Laravel.DDD packages/homedesignshops/laravel-ddd

# Windows
git clone https://homedesignshops.visualstudio.com/Legacy.SiteManager.Web/_git/Laravel.DDD packages/homedesignshops/laravel-ddd
```

Add the path of the package to the composer file:
```json
"repositories": [
    {
        "type": "path",
        "url": "packages/homedesignshops/laravel-ddd"
    }
]
```

Install the package:

```bash
composer require homedesignshops/laravel-ddd
```

Publish the config file

```bash
php artisan vendor:publish --tag=ddd-config
```

That's it. You're ready to create the DDD structure in Laravel.

## Configuration

### Doctrine
Create a `Persistence/Doctrine` folder in the `Infrastructure` folder of your module.

Extend the Service Provider from the ModuleServiceProvider of this package and call in the `boot` method `registerDoctrineEntityManager`:

```php
use HomeDesignShops\LaravelDdd\BaseModuleServiceProvider as ServiceProvider;

class MyServiceProvider extends ServiceProvider {
    public function boot() {
        $this->registerDoctrineEntityManager();
    }
}
```

## Usage

### Creating your first structure
```bash
php artisan ddd:new {Name}
```

Use `--force` to overwrite the structure.

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email kevin@homedesignshops.nl instead of using the issue tracker.

## Credits

- [Kevin Koenen](https://github.com/homedesignshops)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.