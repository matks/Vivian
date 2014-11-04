Vivian
======

[![Latest Stable Version](https://poser.pugx.org/matks/vivian/v/stable.svg)](https://packagist.org/packages/matks/vivian)
[![Build Status](https://travis-ci.org/matks/Vivian.png)](https://travis-ci.org/matks/Vivian)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/matks/Vivian/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/matks/Vivian/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/matks/Vivian/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/matks/Vivian/?branch=master)
[![Latest Unstable Version](https://poser.pugx.org/matks/vivian/v/unstable.svg)](https://packagist.org/packages/matks/vivian)
[![License](https://poser.pugx.org/matks/vivian/license.svg)](https://packagist.org/packages/matks/vivian)

Tools to provide a pretty console output in ANSI/VT100 terminals

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

### Tool

For simple styles, the class Matks\Vivian\Tools provide a useful call interface, for example:
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
php tests/Console/test-background-color
php tests/Console/test-border
php tests/Console/test-structure
php tests/Console/test-style
php tests/Console/test-figlet
```

## More about ANSI/VT100 terminal control

http://www.termsys.demon.co.uk/vtansi.htm