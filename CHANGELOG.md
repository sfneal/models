# Changelog

All notable changes to `models` will be documented in this file

## 0.1.0 - 2020-08-13
- initial release


## 0.1.1 - 2020-08-13
- add snfeal/builder & laravel/framework requirements


## 0.1.2 - 2020-08-26
- update documentation


## 0.2.0 - 2020-09-08
- fix composer.json to allow for use of laravel/framework:8.0


## 0.2.1 - 2020-09-23
- add timestamp & diffForHumans attribute accessors for 'updated_at' & 'created_at' attributes


## 0.3.0 - 2020-10-07
- add support for php 7.0-7.1
- bump sfneal/builders min version requirement


## 0.4.0 - 2020-12-11
- add support for php8


## 0.4.1 - 2021-01-18
- add 'created_date' & 'updated_date' attributes to AbstractModel


## 0.5.0 - 2021-01-25
- cut support for php7.0.
- add sfneal/redis-helpers to composer package requirements.
- fix issue with use of redisDelete helper function in InvalidateModelCache trait
- fix sfneal/builders min version syntax.


## 0.5.1 - 2021-01-25
- fix min sfneal/redis-helpers composer version syntax


## 0.6.0 - 2021-01-27
- add orchestra/testbench to composer dev requirements
- make People model & PeopleFactory for testing AbstractModel functionality
- add improved test suite
- fix issues with hasAttribute method incorrectly determining attributes are missing
- cut support for php7.2 & below
- bump min laravel/framework version to support non-conventional Factory namespace
- bump min sfneal/redis-helpers to initial production release (1.0)
- add sfneal/laravel-helpers to composer requirements


## 1.0.0 - 2021-01-28
- bump min sfneal/builders version to 1.0
- bump min orchestra/testbench version to 6.7 to avoid mocker/mockery issues
- initial production release


## 1.0.1 - 2021-02-29
- cut laravel/framework dep as its satisfied by sfneal/builders requirement of illuminate/database


## 1.1.0 - 2021-02-02
- bump min sfneal/redis-helpers version


## 1.2.0 - 2021-03-10
- add `getCreatedTimeAttribute()` & `getUpdatedTimeAttribute()` methods to AbstractModel for accessing `created_time` & `update_time` attributes


## 1.2.1 - 2021-03-10
- fix AbstractModel's $timestampFormat property to use 'Y-m-d' instead of date format instead of 'm/d/Y'


## 1.3.0 - 2021-03-24
- make `ResolveModelName` action with tests for retrieving a model's name for use in logging 
- add composer requiring of sfneal/string-helpers (min version 1.1.4) to support use of `camelCaseSplit()` method


## 1.4.0 - 2021-03-31
- add sfneal/actions (^2.0) to composer requirements
- refactor `AbstractAction` extension to `Action`


## 2.0.0 - 2021-04-06
- cut 'Abstract' prefix from class names


## 2.0.1 - 2021-04-07
- fix issue with import of `Illuminate\Auth\Authenticatable` trait in `Authenticatable`


## 2.1.0 - 2021-04-07
- refactor `Authenticatable` class to `AuthModel`


## 2.2.0 - 2021-04-08
- merge sfneal/builders package into sfneal/models package without breaking namespaces
- cut `Sfneal\Models\Traits\InvalidateModelCache` trait & moved methods to `CacheableAll`


## 2.3.0 - 2021-06-10
- fix issue with `ResolveModelName` action throwing exception when giving a class string instead of an object


## 2.3.1 - 2021-07-15
- refactor test classes into `Unit` & `Feature` directories
- refactor test assets to 'tests/Assets' directory


## 2.3.2 - 2021-07-15
- optimize test classes extensions to avoid execution unneeded database seeding
- add builder feature tests that test the functionality of builder traits using the `PeopleBuilder` test asset
- add use of dataProviders in test classes with repeated calls using different datasets


## 2.4.0 - 2021-07-15
- fix issues with trait & interface declarations in `ModelWithPublicStatus` model
- make `ModelWithPublicStatusTest` for testing public status traits & interfaces


## 2.4.1 - 2021-07-27
- fix issues with `Model::hasAttribute()` method incorrectly returning true
- optimize return type hinting in various `Model` methods
- add test methods to `ModelTest` that test all remaining `Model` methods & properties


## 2.5.0 - 2021-07-27
- refactor `Model` class's `updated_for_humans` & `created_for_humans` attributes to `updated_diff_for_humans` & `created_diff_for_humans`
- add 'created_for_humans' & 'updated_for_humans' attribute accessors to `Model` that display timestamps in a human-readable format ("F j, Y, g:i a" => "March 10, 2001, 5:16 pm")


## 2.5.1 - 2021-07-27
- fix issue with `Model::getDatetimeForHumans()` $stringToTime parameter type hinting


## 2.6.0 - 2021-07-28
- make `SoftDeletesIgnored` trait for preventing the `SoftDeletesScope` from being applied to models (useful when `Sfneal\Models\Model` is needed but not soft deleting)


## 2.6.1 - 2021-07-28
- add `SoftDeletesIgnoredTest` for testing `SoftDeletesIgnored` trait

 
## 2.6.2 - 2021-09-01
- fix use of '#' cache key id suffix delimiter with ':'
- add sfneal/array-helpers to composer dev requirements


## 2.6.3 - 2021-09-01
- add support for sfneal/redis-helpers v2.0


## 2.7.0 - 2021-09-02
- cut `CityStateAccessors` trait as it belongs in sfneal/address


## 2.8.0 - 2021-09-07
- fix issues with use of `QueryBuilder::concatColumns()` method when using a 'Sqlite' database connection (added support for Sqlite concat syntax)
- fix issues with use of `QueryBuilder::ifStatement()` method when using a 'Sqlite' database connection (added support for Sqlite concat syntax)


## 2.8.1 - 2021-09-07
- fix issue use of 'IFF' Sqlite function `QueryBuilder::ifStatement()` by replacing with use of 'CASE'


## 2.8.2 - 2022-03-03
- bump composer dependency constraints
- add use of GitHub actions/workflows

 
## 2.9.0 - 2022-04-25
- add `HasCompositePrimaryKey` trait for use in pivot models with composite primary keys


## 2.10.0 - 2022-08-08
- add a $boolean param to `QueryBuilder::whereLike()`


## 3.0.0 - 2024-03-30
- remove support for PHP 7
- add support for PHP 8.2 & 8.3
- bump test suite frameworks to latest usable versions


## 3.0.1 - 2024-04-15
- fix issue with `Model::wasDeleted()` method


## 4.0.0 - 2024-05-01
- add support for Laravel v11
- due to changes to Laravel v11, access to magic attributes (like 'created_date') can only be called from their underlying methods
- refactored `get{Attribute}Attribute()` accessor methods to `{attribute}()` (e.g. `getCreatedDateAttribute()` changed to `createdDate()`)
