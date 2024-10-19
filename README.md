# renfordt/colors

`renfordt/colors` is a PHP package that provides several classes for handling different color types, including Hex, HSL, HSV, RAL, and RGB. These color types can be easily converted into each other using this package.

## Installation

You can install this package using Composer. Run the following command:

```bash
composer require renfordt/colors
```

## Requirements

- PHP 8.1 or higher
- Composer

## Usage

### Initializing Colors

You can initialize colors in multiple formats using the `create` method:

```php
use Renfordt\Colors\Hex;
use Renfordt\Colors\HSL;
use Renfordt\Colors\HSV;
use Renfordt\Colors\RAL;
use Renfordt\Colors\RGB;

// HEX Color
$hexColor = Hex::create('#ffffff');

// HSL Color
$hslColor = HSL::create(360, 100, 50);

// HSV Color
$hsvColor = HSV::create(360, 100, 100);

// RAL Color
$ralColor = RAL::create(9010);

// RGB Color
$rgbColor = RGB::create(255, 255, 255);
```

### Converting Colors

You can convert colors from one type to another easily:

```php
// Convert Hex to RGB
$rgbColor = $hexColor->toRGB();

// Convert RGB to HSL
$hslColor = $rgbColor->toHSL();

// Convert HSL to HSV
$hsvColor = $hslColor->toHSV();

// Convert HSV to RAL (this might require a predefined mapping)
$ralColor = $hsvColor->toRAL();
```

### Available Methods

Each color class offers a set of methods to manipulate and retrieve color values.

- **Hex**
  - `toRGB()`
  - `toHSL()`
  - `toHSV()`
  - `toRAL()`

- **HSL**
  - `toHex()`
  - `toRGB()`
  - `toHSV()`
  - `toRAL()`

- **HSV**
  - `toHex()`
  - `toRGB()`
  - `toHSL()`
  - `toRAL()`

- **RAL**
  - `toHex()`
  - `toRGB()`
  - `toHSL()`
  - `toHSV()`

- **RGB**
  - `toHex()`
  - `toHSL()`
  - `toHSV()`
  - `toRAL()`

## Contributing

Contributions are welcome! Please open an issue or submit a pull request on GitHub.

## License

This package is open-sourced software licensed under the MIT license.