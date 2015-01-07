Vivian
======

[![Latest Stable Version](https://poser.pugx.org/matks/vivian/v/stable.svg)](https://packagist.org/packages/matks/vivian)
[![Build Status](https://travis-ci.org/matks/Vivian.png)](https://travis-ci.org/matks/Vivian)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/matks/Vivian/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/matks/Vivian/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/matks/Vivian/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/matks/Vivian/?branch=master)
[![Latest Unstable Version](https://poser.pugx.org/matks/vivian/v/unstable.svg)](https://packagist.org/packages/matks/vivian)
[![License](https://poser.pugx.org/matks/vivian/license.svg)](https://packagist.org/packages/matks/vivian)

Tools to provide a pretty console output in ANSI/VT100 terminals

<img src="https://cloud.githubusercontent.com/assets/3830050/5061655/3202b658-6da0-11e4-8211-dce2fef12fc6.png" width="400px"/>

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
php tests/Console/test-style
php tests/Console/test-border
php tests/Console/test-mixed
php tests/Console/test-structure
php tests/Console/test-figlet
```
or
```bash
bash tests/Console/test-all.sh
```

### Elements

For advanced displays, build the Elements you need:

#### Text Element

```php
use Matks\Vivian\Color;
use Matks\Vivian\Style;
use Matks\Vivian\Output;

$textElement = new Output\TextElement('Hello world !');

$boldStyle             = new Style\Style(Style\StyleManager::BASH_BOLD);
$greenColor            = new Color\TextColor(Color\TextColorManager::BASH_FOREGROUND_GREEN);
$cyanBackgroundColor   = new Color\BackgroundColor(Color\BackgroundColorManager::BASH_BACKGROUND_CYAN);

$textElement->setTextColor($greenColor)
            ->setBackgroundColor($cyanBackgroundColor)
            ->addStyle($boldStyle)
;

echo $textElement->render();
```

#### Bordered Element

```php
use Matks\Vivian\Border;
use Matks\Vivian\Color;
use Matks\Vivian\Output;

$yellowColor = new Color\TextColor(Color\TextColorManager::BASH_FOREGROUND_YELLOW);
$border      = new Border\Border(Border\Border::TYPE_FRAME);

$borderedElement = new Output\BorderedElement('Hello world !', $border);
$borderedElement->setTextColor($yellowColor);

echo $borderedElement->render();
```

#### Structured Elements

```php
use Matks\Vivian\Color;
use Matks\Vivian\Output;
use Matks\Vivian\Style;
use Matks\Vivian\Structure;

$greenColor     = new Color\TextColor(Color\TextColorManager::BASH_FOREGROUND_GREEN);
$redColor       = new Color\TextColor(Color\TextColorManager::BASH_FOREGROUND_RED);
$blinkingStyle  = new Style\Style(Style\StyleManager::BASH_BLINK);

$textElement1 = new Output\TextElement('Hello');
$textElement2 = new Output\TextElement('world');
$textElement3 = new Output\TextElement('!');
$textElement1->setTextColor($greenColor);
$textElement2->setTextColor($redColor);
$textElement3->addStyle($blinkingStyle);

$elements = array(
    $textElement1,
    $textElement2,
    $textElement3
);

$structure  = new Structure\Structure(Structure\Structure::TYPE_LIST, '#', '  ');
$structuredElements = new Output\StructuredElements($elements, $structure);
echo $structuredElements->render();
```

## More about ANSI/VT100 terminal control

http://www.termsys.demon.co.uk/vtansi.htm

## License

Vivian is licensed under the MIT License - see the LICENSE file for details