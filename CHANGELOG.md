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
- initial production release
- bump min sfneal/builders version to 1.0
- bump min orchestra/testbench version to 6.7 to avoid mocker/mockery issues
