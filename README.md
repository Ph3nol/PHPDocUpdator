# PHPDocUpdator

[![Continuous Integration status](https://secure.travis-ci.org/Ph3nol/PHPDocUpdator.png)](http://travis-ci.org/Ph3nol/PHPDocUpdator)

## What is it?

PHPDocUpdator was created to make easy PHPDoc comments updates from CLI.

## Dependencies

PHPDocUpdator uses some dependency packages managed with [Composer](http://getcomposer.org):

* [Symfony Console component](http://packagist.org/packages/symfony/console)
* [Symfony YAML component](http://packagist.org/packages/symfony/yaml)
* [Symfony Finder component](http://packagist.org/packages/symfony/finder)
* [Symfony Filesystem component](http://packagist.org/packages/symfony/filesystem)
* [phpDocumentor Reflection DocBlock](http://packagist.org/packages/phpdocumentor/reflection-docblock)
* [Fabien Potencier's PHP CS Fixer](http://packagist.org/packages/fabpot/php-cs-fixer)

## Installation

```
git clone git@github.com:Ph3nol/PHPDocUpdator.git PHPDocUpdator
cd PHPDocUpdator
curl -s http://getcomposer.org/installer | php
php composer.phar install
cp config/config.yml.default config/config.yml
```

## Usage

Edit `config/config.yml` file, following this example:

```yaml
debug: false
phpdoc:
    author: "Cédric Dugat <ph3@slynett.com>"
    version: "1.0"
include:
    - "path/to/the/folder/1"
    - "path/to/the/folder/2"
    - "path/to/the/folder/3":
        phpdoc: { package: "Test", version: "1.01" }
exclude:
    - "path/to/the/folder/to/exclude"
```

Declare all needed parameters (available soon) and use `update` command to apply PHPDoc comments improvements:

```shell
./bin/phpdu update --config=/path/to/config.yml
```

Or not set `config` option for a config file suggestion:

```shell
./bin/phpdu update
```

-----

To be continued.
