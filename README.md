# 🎨 renfordt/colors

[![Badge](http://img.shields.io/badge/source-renfordt/colors-blue.svg)](https://github.com/renfordt/colors)
[![Packagist Version](https://img.shields.io/packagist/v/renfordt/colors)](https://packagist.org/packages/renfordt/colors/)
![Packagist PHP Version](https://img.shields.io/packagist/dependency-v/renfordt/colors/php)
![GitHub License](https://img.shields.io/github/license/renfordt/colors)
![GitHub Actions Workflow Status](https://img.shields.io/github/actions/workflow/status/renfordt/colors/tests.yml?logo=github)
[![Code Coverage](https://qlty.sh/gh/renfordt/projects/colors/coverage.svg)](https://qlty.sh/gh/renfordt/projects/colors)
[![Maintainability](https://qlty.sh/gh/renfordt/projects/colors/maintainability.svg)](https://qlty.sh/gh/renfordt/projects/colors)

A modern PHP library for effortless color manipulation and conversion. Convert between **Hex**, **RGB**, **HSL**, **HSV**, and **RAL** color formats with ease.

> 🚀 **Version 2.0** - Now powered by PHP 8.4 property hooks for a cleaner, more intuitive API!

---

## ✨ Features

- 🔄 **Universal Conversion** - Seamlessly convert between all major color formats
- 🎯 **Type-Safe** - Full type declarations with PHPStan level max compliance
- ⚡ **Modern PHP** - Leverages PHP 8.4 property hooks and latest language features
- 🎨 **RAL Support** - Complete RAL color system with closest color matching
- 🔍 **Auto-Validation** - Automatic range clamping ensures valid color values
- 📦 **Zero Dependencies** - Only requires `renfordt/clamp` utility

---

## 📦 Installation

```bash
composer require renfordt/colors
```

### Requirements

- **PHP 8.4** or higher
- **Composer**

---

## 🚀 Quick Start

### Creating Colors

```php
use Renfordt\Colors\{HexColor, RGBColor, HSLColor, HSVColor, RALColor};

// Hex colors - with or without # prefix
$hex = HexColor::create('#FF5733');
$hex = HexColor::create('FF5733');

// RGB colors - values from 0-255
$rgb = RGBColor::create([255, 87, 51]);

// HSL colors - hue: 0-360, saturation/lightness: 0.0-1.0
$hsl = HSLColor::create([9, 1.0, 0.6]);

// HSV colors - hue: 0-360, saturation/value: 0.0-1.0
$hsv = HSVColor::create([9, 0.8, 1.0]);

// RAL colors - standard RAL codes
$ral = RALColor::create(3020);
```

---

## 🎨 Working with Colors (v2.0)

### Direct Property Access

The new property hooks API makes working with colors intuitive and clean:

```php
// RGB - direct component access
$color = RGBColor::create([255, 100, 50]);
echo $color->red;    // 255
echo $color->green;  // 100
echo $color->blue;   // 50

// Modify individual components (automatically clamped)
$color->red = 200;
$color->green = 300;  // Automatically clamped to 255
$color->blue = -10;   // Automatically clamped to 0

// HSL - access hue, saturation, lightness
$hsl = HSLColor::create([180, 0.5, 0.7]);
echo $hsl->hue;        // 180
echo $hsl->saturation; // 0.5
echo $hsl->lightness;  // 0.7

$hsl->lightness = 0.9;  // Adjust lightness

// HSV - access hue, saturation, value
$hsv = HSVColor::create([240, 0.8, 0.6]);
echo $hsv->hue;        // 240
echo $hsv->saturation; // 0.8
echo $hsv->value;      // 0.6

// Hex - get hex value with #
$hex = HexColor::create('FF5733');
echo $hex->hex;  // #FF5733

// RAL - access RAL code
$ral = RALColor::create(3020);
echo $ral->ral;  // 3020
```

### Array Access (Still Available)

For batch operations, array methods remain available:

```php
$rgb = RGBColor::create([255, 100, 50]);
[$r, $g, $b] = $rgb->getRGB();  // [255, 100, 50]

$hsl = HSLColor::create([180, 0.5, 0.7]);
[$h, $s, $l] = $hsl->getHSL();  // [180, 0.5, 0.7]

$hsv = HSVColor::create([240, 0.8, 0.6]);
[$h, $s, $v] = $hsv->getHSV();  // [240, 0.8, 0.6]
```

---

## 🔄 Converting Between Formats

All color formats can be converted to any other format:

```php
$hex = HexColor::create('#FF5733');

// Convert to any format
$rgb = $hex->toRGB();
$hsl = $hex->toHSL();
$hsv = $hex->toHSV();

// Chain conversions
$finalColor = HexColor::create('#FF5733')
    ->toRGB()
    ->toHSL()
    ->toHex();

// Precision control for HSL/HSV
$hsl = $rgb->toHSL(precision: 2);  // Round to 2 decimal places
```

### Conversion Matrix

|         | → Hex | → RGB | → HSL | → HSV |
|---------|:-----:|:-----:|:-----:|:-----:|
| **Hex** |   -   |   ✅   |   ✅   |   ✅   |
| **RGB** |   ✅   |   -   |   ✅   |   ✅   |
| **HSL** |   ✅   |   ✅   |   -   |   ✅   |
| **HSV** |   ✅   |   ✅   |   ✅   |   -   |
| **RAL** |   ✅   |   ✅   |   ✅   |   ✅   |

---

## 🎯 Advanced Features

### Color Utilities (HSL)

```php
$color = HSLColor::create([200, 0.6, 0.5]);

// Brighten by 20% (default: 10%)
$color->brighten(20);

// Darken by 15%
$color->darken(15);

// Access the adjusted lightness
echo $color->lightness;  // Automatically clamped to 0.0-1.0
```

### Hex String Formatting

```php
$hex = HexColor::create('FF5733');

// Get with hash (using property)
echo $hex->hex;  // #FF5733

// Get with/without hash (using method for control)
echo $hex->getHexStr(true);   // #FF5733
echo $hex->getHexStr(false);  // FF5733

// String conversion
echo (string) $hex;  // #FF5733
```

### RAL Color Matching

Find the closest RAL color to any hex value:

```php
$ral = RALColor::create(3020);
$customHex = HexColor::create('#FF5500');

// Find closest RAL color
$closest = $ral->findClosestColor($customHex);
echo $closest->ral;  // Returns the nearest RAL code
```

---

## 📚 API Reference

### RGBColor

```php
// Properties (with automatic validation)
$rgb->red    // int (0-255)
$rgb->green  // int (0-255)
$rgb->blue   // int (0-255)

// Methods
$rgb->getRGB()              // array<int>
$rgb->toHex()               // HexColor
$rgb->toHSL($precision = 4) // HSLColor
$rgb->toHSV($precision = 4) // HSVColor
```

### HexColor

```php
// Properties
$hex->hex  // string (with # prefix)

// Methods
$hex->getHexStr($withHash = true)  // string
$hex->toRGB()                       // RGBColor
$hex->toHSL($precision = 4)         // HSLColor
$hex->toHSV($precision = 4)         // HSVColor
```

### HSLColor

```php
// Properties (with automatic validation)
$hsl->hue         // int (0-360)
$hsl->saturation  // float (0.0-1.0)
$hsl->lightness   // float (0.0-1.0)

// Methods
$hsl->getHSL()              // array{int, float, float}
$hsl->toHex()               // HexColor
$hsl->toRGB()               // RGBColor
$hsl->brighten($amount = 10) // void
$hsl->darken($amount = 10)   // void
```

### HSVColor

```php
// Properties (with automatic validation)
$hsv->hue         // int (0-360)
$hsv->saturation  // float (0.0-1.0)
$hsv->value       // float (0.0-1.0)

// Methods
$hsv->getHSV()  // array{int, float, float}
$hsv->toHex()   // HexColor
$hsv->toRGB()   // RGBColor
```

### RALColor

```php
// Properties
$ral->ral  // int (RAL code)

// Methods
$ral->toHex()                         // HexColor
$ral->toRGB()                         // RGBColor
$ral->toHSL()                         // HSLColor
$ral->toHSV()                         // HSVColor
$ral->findClosestColor(HexColor $hex) // RALColor|null
```

---

## 🔧 Migration from v1.x to v2.0

Version 2.0 introduces **breaking changes** with a cleaner, modern API using property hooks.

### What Changed?

**Removed Methods:**
- ❌ `setRGB()`, `getRed()`, `getGreen()`, `getBlue()`
- ❌ `setHexStr()`
- ❌ `setHue()`, `getHue()`, `setSaturation()`, `getSaturation()`, etc.
- ❌ `toArray()` (use `getRGB()` instead)

**New in v2.0:**
- ✅ Direct property access with automatic validation
- ✅ Property hooks ensure values stay in valid ranges
- ✅ Cleaner, more intuitive API

### Migration Examples

```php
// ❌ Old way (v1.x)
$rgb = RGBColor::create([255, 0, 0]);
$rgb->setRGB([0, 255, 0]);
$red = $rgb->getRed();
$array = $rgb->toArray();

$hsl->setLightness(0.7);
$lightness = $hsl->getLightness();

// ✅ New way (v2.0)
$rgb = RGBColor::create([255, 0, 0]);
$rgb->red = 0;
$rgb->green = 255;
$rgb->blue = 0;
$red = $rgb->red;
$array = $rgb->getRGB();

$hsl->lightness = 0.7;
$lightness = $hsl->lightness;
```

---

## 🧪 Development

### Running Tests

```bash
# Run all tests
composer test

# Individual test suites
composer test:unit      # PHPUnit tests
composer test:types     # PHPStan static analysis
composer test:lint      # Code style check
composer test:refacto   # Rector refactoring check
```

### Code Quality

```bash
# Format code
composer lint

# Apply Rector refactoring
composer refacto
```

---

## 🤝 Contributing

Contributions are welcome! Please:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

Please ensure:
- ✅ All tests pass (`composer test`)
- ✅ Code follows PSR-12 standards
- ✅ PHPStan level max compliance
- ✅ New features include tests

---

## 📄 License

This package is open-sourced software licensed under the [MIT license](LICENSE).

---

## 🙏 Credits

Developed and maintained by [Jannik Renfordt](https://github.com/renfordt).

---

<div align="center">

**[Documentation](https://github.com/renfordt/colors)** • **[Report Bug](https://github.com/renfordt/colors/issues)** • **[Request Feature](https://github.com/renfordt/colors/issues)**

Made with ❤️ using PHP 8.4

</div>
