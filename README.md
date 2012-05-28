# PHPDocUpdator

## What is it?

PHPDocUpdator was created to make easy PHPDoc comments updates from CLI.

## Installation

```
git clone git@github.com:Ph3nol/PHPDocUpdator.git PHPDocUpdator
cd PHPDocUpdator
curl -s http://getcomposer.org/installer | php
php composer.phar install
```

## Usage

Create config.yml file into main PHPDocUpdator directory or specific one.
Declare all needed parameters (available soon) and use `update` command to apply PHPDoc comments improvements:

```
./bin/phpdu update --config=/path/to/config.yml
```

To be continued.
