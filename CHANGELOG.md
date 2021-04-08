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
