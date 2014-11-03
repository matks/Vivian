Vivian
======

[![Latest Stable Version](https://poser.pugx.org/matks/vivian/v/stable.svg)](https://packagist.org/packages/matks/vivian)
[![Total Downloads](https://poser.pugx.org/matks/vivian/downloads.svg)](https://packagist.org/packages/matks/vivian)
[![Latest Unstable Version](https://poser.pugx.org/matks/vivian/v/unstable.svg)](https://packagist.org/packages/matks/vivian)
[![License](https://poser.pugx.org/matks/vivian/license.svg)](https://packagist.org/packages/matks/vivian)

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

## Usage

The class Matks\Vivian\Tools is able to use all implemented styles, for example:
```php
use Matks\Vivian\Tools as Output;

echo Output::bold('... done.') . PHP_EOL;

if ($success) {
	echo Output::green('Success');
	echo PHP_EOL;
} else {
	echo Output::red('Failure !');
	echo PHP_EOL;
	echo Output::s_list1($errors);
}
```

See the examples in tests/Console:
```bash
php tests/Console/test-color
php tests/Console/test-border
php tests/Console/test-structure
php tests/Console/test-style
php tests/Console/test-figlet
```