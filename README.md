Vivian
======

Tools to provide a pretty console output

## Installation

Install the dependencies with composer
```bash
composer install
```

## Tests

Install the dev dependencies with composer
```bash
composer install --dev
```

Run the unit tests suite with atoum binary.
```bash
vendor/bin/atoum -bf vendor/autoload.php -d tests/Units/
```

## Use

The class Matks\Vivian\Tools is able to use all implemented styles, see the examples in tests/Console:
```bash
php tests/Console/test-color
php tests/Console/test-border
php tests/Console/test-structure
```
