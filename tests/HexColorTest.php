<?php

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Renfordt\Colors\HexColor;
use Renfordt\Colors\RGBColor;

/**
 * @covers \Renfordt\Colors\HexColor
 */
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
            'Dark Slate Grey' => ['#345', [51, 68, 85]]
        ];
    }

    /**
     * @covers \Renfordt\Colors\HexColor::setHexStr
     */
    public function test_valid_hex_string()
    {
        $color = new HexColor();
        $color->setHexStr('#123abc');
        $this->assertSame('123abc', $color->getHexStr(false));

        $color->setHexStr('#abc');
        $this->assertSame('abc', $color->getHexStr(false));
    }

    /**
     * @covers \Renfordt\Colors\HexColor::make
     */
    public function testMake(): void
    {
        $color = HexColor::make('123abc');
        $this->assertInstanceOf(HexColor::class, $color);
        $this->assertSame('123abc', $color->getHexStr(false));
    }

    public function testMakeWithInvalidHex(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The format of the hex is invalid.');
        HexColor::make('ghijk');
    }

    public function testMakeWithInvalidHexLength(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The format of the hex is invalid.');
        HexColor::make('abcd');
    }

    public function testMakeWithEmptyString(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The format of the hex is invalid.');
        HexColor::make('');
    }

    public function testMakeWithWhiteSpaceString(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The format of the hex is invalid.');
        HexColor::make(' ');
    }

    public function testMakeWithHashedHex(): void
    {
        $color = HexColor::make('#123abc');
        $this->assertInstanceOf(HexColor::class, $color);
        $this->assertSame('123abc', $color->getHexStr(false));
    }


    /**
     * @covers       \Renfordt\Colors\HexColor::toRGB
     */
    #[DataProvider('hexToRgbProvider')]
    public function test_toRGB($hex, $expected): void
    {
        $color = new HexColor();
        $color->setHexStr($hex);
        $this->assertSame($expected, $color->toRGB()->getRGB());

    }

    public function test_withHash_returns_hashed_hex_string()
    {
        $color = new HexColor();
        $color->setHexStr('#fff');
        $this->assertSame('#fff', $color->getHexStr(true));
    }


    /**
     * @covers \Renfordt\Colors\HexColor::toRGB
     */
    public function test_toRGB_with_invalid_hex()
    {
        $color = new HexColor();
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The format of the hex is invalid.');
        $color->setHexStr('ghijk');
        $color->toRGB();
    }

    /**
     * @covers \Renfordt\Colors\HexColor::toRGB
     */
    public function test_toRGB_with_invalid_hex_length()
    {
        $color = new HexColor();
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The format of the hex is invalid.');
        $color->setHexStr('abcd');
        $color->toRGB();
    }
}
