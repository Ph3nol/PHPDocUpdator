# PHPDocUpdator

## What is it?

PHPDocUpdator was created to make easy PHPDoc comments updates from CLI.

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
    - path/to/include/1
    - path/to/include/2
    - path/to/include/3
    - [ "path/to/include/with/phpdoc/parameters", phpdoc: { package: 'Example', version: 'Example' } ]
exclude:
    - path/to/exclude/1
    - path/to/exclude/2
```

Declare all needed parameters (available soon) and use `update` command to apply PHPDoc comments improvements:

```shell
./bin/phpdu update --config=/path/to/config.yml
```

To be continued.
