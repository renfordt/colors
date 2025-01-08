<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;
use Renfordt\Colors\HexColor;
use Renfordt\Colors\HSLColor;
use Renfordt\Colors\HSVColor;
use Renfordt\Colors\RGBColor;

#[CoversClass(HexColor::class)]
#[UsesClass(RGBColor::class)]
#[UsesClass(HSLColor::class)]
#[UsesClass(HSVColor::class)]
class HexColorTest extends TestCase
{
    /**
     * Provides data for testing the HexColor::toRGB() method.
     */
    public static function hexToRgbProvider(): array
    {
        return [
            'white' => ['#ffffff', [255, 255, 255]],
            'black' => ['#000000', [0, 0, 0]],
            'Mountain Meadow' => ['#11c380', [17, 195, 128]],
            'Sienna' => ['#8c5a45', [140, 90, 69]],
            'Dark Slate Grey' => ['#345', [51, 68, 85]],
            'fuchsia' => ['#ff00ff', [255, 0, 255]],
        ];
    }

    public function test_toString(): void
    {
        $color = HexColor::create('123abc');
        $this->assertSame('#123abc', (string)$color);
    }

    public function test_toString_with_invalid_hex(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The format of the hex is invalid.');
        $color = new HexColor();
        $color->setHexStr('invalid_hex');
    }

    public static function hexToHSLProvider(): array
    {
        return [
            'white' => ['#ffffff', [0, 0.0, 1.0]],
            'black' => ['#000000', [0, 0.0, 0.0]],
            'Mountain Meadow' => ['#11c380', [157, 0.8396, 0.4157]],
            'Sienna' => ['#8c5a45', [18, 0.3397, 0.4098]],
            'Dark Slate Grey' => ['#345', [210, 0.25, 0.2667]],
            'fuchsia' => ['ff00ff', [300, 1.0, 0.5]],
        ];
    }

    public static function hexToHSVProvider(): array
    {
        return [
            'white' => ['#ffffff', [0, 0.0, 1.0]],
            'black' => ['#000000', [0, 0.0, 0.0]],
            'Mountain Meadow' => ['#11c380', [157, 0.9128, 0.7647]],
            'Sienna' => ['#8c5a45', [18, 0.5071, 0.549]],
            'Dark Slate Grey' => ['#345', [210, 0.40, 0.3333]],
            'fuchsia' => ['ff00ff', [300, 1.0, 1.0]],
        ];
    }

    public function test_valid_hex_string(): void
    {
        $color = new HexColor();
        $color->setHexStr('#123abc');
        $this->assertSame('123abc', $color->getHexStr(false));

        $color->setHexStr('#abc');
        $this->assertSame('abc', $color->getHexStr(false));
    }

    public function testCreate(): void
    {
        $color = HexColor::create('123abc');
        $this->assertInstanceOf(HexColor::class, $color);
        $this->assertSame('123abc', $color->getHexStr(false));
    }

    public function testMake(): void
    {
        $color = HexColor::make('123abc');
        $this->assertInstanceOf(HexColor::class, $color);
        $this->assertSame('123abc', $color->getHexStr(false));
    }

    public function testCreateWithInvalidHex(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The format of the hex is invalid.');
        HexColor::create('ghijk');
    }

    public function testMakeWithInvalidHexLength(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The format of the hex is invalid.');
        HexColor::create('abcd');
    }

    public function testMakeWithEmptyString(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The format of the hex is invalid.');
        HexColor::create('');
    }

    public function testMakeWithWhiteSpaceString(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The format of the hex is invalid.');
        HexColor::create(' ');
    }

    public function testMakeWithHashedHex(): void
    {
        $color = HexColor::create('#123abc');
        $this->assertInstanceOf(HexColor::class, $color);
        $this->assertSame('123abc', $color->getHexStr(false));
    }

    #[DataProvider('hexToRgbProvider')]
    public function test_toRGB(string $hex, array $expected): void
    {
        $color = new HexColor();
        $color->setHexStr($hex);
        $this->assertSame($expected, $color->toRGB()->getRGB());

    }

    public function test_withHash_returns_hashed_hex_string(): void
    {
        $color = new HexColor();
        $color->setHexStr('#fff');
        $this->assertSame('#fff', $color->getHexStr(true));
    }

    public function test_toRGB_with_invalid_hex(): void
    {
        $color = new HexColor();
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The format of the hex is invalid.');
        $color->setHexStr('ghijk');
        $color->toRGB();
    }

    public function test_toRGB_with_invalid_hex_length(): void
    {
        $color = new HexColor();
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The format of the hex is invalid.');
        $color->setHexStr('abcd');
        $color->toRGB();
    }

    #[DataProvider('hexToHSLProvider')]
    public function test_toHSL(string $hex, array $expected): void
    {
        $color = HexColor::create($hex);
        $this->assertSame($expected, $color->toHSL()->getHSL());
    }

    #[DataProvider('hexToHSVProvider')]
    public function test_toHSV(string $hex, array $expected): void
    {
        $color = HexColor::create($hex);
        $this->assertSame($expected, $color->toHSV()->getHSV());
    }
}
