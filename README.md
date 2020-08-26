# Eloquent Models - extended

[![Latest Version on Packagist](https://img.shields.io/packagist/v/sfneal/models.svg?style=flat-square)](https://packagist.org/packages/sfneal/models)
[![Build Status](https://img.shields.io/travis/sfneal/models/master.svg?style=flat-square)](https://travis-ci.org/sfneal/models)
[![Quality Score](https://img.shields.io/scrutinizer/g/sfneal/models.svg?style=flat-square)](https://scrutinizer-ci.com/g/sfneal/models)
[![Total Downloads](https://img.shields.io/packagist/dt/sfneal/models.svg?style=flat-square)](https://packagist.org/packages/sfneal/models)

Eloquent Model wrapper with extended functionality.

## Installation

You can install the package via composer:

```bash
composer require sfneal/models
```

## Usage

`AbstractModel`, `AbstractPivot`, & `AbstractAuthenticatable` can be used as parent classes the same way Eloquent's `Model`, `Pivot` & `Authenticatable` can be used.  `AbstractModel` uses `Sfneal\Builders\QueryBuilder` as the default Eloquent Query Builder (see [sfneal/builders](https://packagist.org/packages/sfneal/models).

``` php
class YourModel extends AbstractModel
{
    protected $table = 'your_model';
    protected $primaryKey = 'your_model_id';
    
    protected $fillable = [
        'your_model_id',
        //
    ];
} 
```

Models that extend the `AbstractModel` class will have access to a variety of public access to a variety of methods that extends many of `Models` existing functionality's.

 - 'Newness' - methods to detetmine if a Model is new (useful for apps with CMS) or how new a model is
 - 'Changed' - methods to check if a Model was recently created, updated, deleted or unchanged

``` php
// Create a new Model record
$model = YourModel::query()->create($data);

// returns true
$model->wasCreated();

// Update the Model
$model->update([
	'some_attribute' => 'blue'
]);	

// returns false
$model->wasCreated();

// returns true
$model->wasUpdated();
```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email stephen.neal14@gmail.com instead of using the issue tracker.

## Credits

- [Stephen Neal](https://github.com/sfneal)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## PHP Package Boilerplate

This package was generated using the [PHP Package Boilerplate](https://laravelpackageboilerplate.com).
