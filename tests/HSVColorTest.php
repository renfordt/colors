<?php

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Renfordt\Colors\HexColor;
use Renfordt\Colors\HSVColor;
use Renfordt\Colors\RGBColor;

/**
 * Class HSVColorTest
 *
 * Test Suite to verify functionality of the HSVColor class' make function.
 */
class HSVColorTest extends TestCase
{
    public static function provideHSVData(): array
    {
        return [
            'white' => [[0, 0, 1], [255, 255, 255], 'ffffff'],
            'black' => [[0, 0, 0], [0, 0, 0], '000000'],
            'Mountain Meadow' => [[157, 0.91, 0.76], [17, 194, 126], '11c380'],
            'Sienna' => [[18, 0.51, 0.55], [140, 90, 69], '8c5a45'],
            'Dark Slate Grey' => [[210, 0.40, 0.33], [50, 67, 84], '334455'],
            'fuchsia' => [[300, 1.0, 1.0], [255, 0, 255], 'ff00ff'],
        ];
    }

    /**
     * @covers       \Renfordt\Colors\HSLColor::make
     */
    #[DataProvider('provideHSVData')]
    public function testMake($hsv, $rgb, $hex): void
    {
        list($hue, $saturation, $value) = $hsv;
        $hsvColor = HSVColor::make($hsv);

        $this->assertInstanceOf(HSVColor::class, $hsvColor);
        $this->assertEquals($hue, $hsvColor->getHue());
        $this->assertEquals($saturation, $hsvColor->getSaturation());
        $this->assertEquals($value, $hsvColor->getValue());
    }

    /**
     * @covers       \Renfordt\Colors\HSVColor::toRGB
     */
    #[DataProvider('provideHSVData')]
    public function testToRGB($hsv, $rgb, $hex): void
    {
        $hsvColor = HSVColor::make($hsv);
        $rgbColor = $hsvColor->toRGB();

        $this->assertInstanceOf(RGBColor::class, $rgbColor);
        $this->assertEquals($rgb, $rgbColor->getRGB());
    }

    /**
     * @covers       \Renfordt\Colors\HSVColor::toHex
     */
    #[DataProvider('provideHSVData')]
    public function testToHex($hsv, $rgb, $hex): void
    {
        $hsvColor = HSVColor::make($hsv);
        $hexColor = $hsvColor->toHex();

        $this->assertInstanceOf(HexColor::class, $hexColor);
        $this->assertEquals($hex, $hexColor->getHexStr(false));
    }
}
