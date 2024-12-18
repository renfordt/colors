<?php

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use Renfordt\Colors\HexColor;
use Renfordt\Colors\HSLColor;
use Renfordt\Colors\RGBColor;

class HSLColorTest extends TestCase
{
    public static function provideHSLData(): array
    {
        return [
            'white' => [[0, 0, 1], [255, 255, 255], 'ffffff'],
            'black' => [[0, 0, 0], [0, 0, 0], '000000'],
            'Mountain Meadow' => [[157, 0.84, 0.42], [17, 197, 128], '11c580'],
            'Sienna' => [[18, 0.34, 0.41], [140, 90, 69], '8c5a45'],
            'Dark Slate Grey' => [[210, 0.25, 0.27], [52, 69, 86], '344556'],
            'fuchsia' => [[300, 1, 0.5], [255, 0, 255], 'ff00ff'],
        ];
    }

    public static function provideInvalidHSLData(): array
    {
        return [
            'invalid hue +' => [[700, 0.25, 0.27], [360, 0.25, 0.27]],
            'invalid saturation +' => [[45, 2, 0.5], [45, 1.0, 0.5]],
            'invalid lightness +' => [[157, 0.84, 1.42], [157, 0.84, 1.0]],
            'invalid hue -' => [[-700, 0.25, 0.27], [0, 0.25, 0.27]],
            'invalid saturation -' => [[45, -2, 0.5], [45, 0.0, 0.5]],
            'invalid lightness -' => [[157, 0.84, -1.42], [157, 0.84, 0.0]],
        ];
    }

    /**
     * @covers       \Renfordt\Colors\HSLColor::create
     */
    #[DataProvider('provideHSLData')]
    public function testCreate($hsl, $rgb, $hex): void
    {
        list($hue, $saturation, $lightness) = $hsl;
        $hslColor = HSLColor::create($hsl);

        $this->assertInstanceOf(HSLColor::class, $hslColor);
        $this->assertEquals($hslColor->getHue(), $hue);
        $this->assertEquals($hslColor->getSaturation(), $saturation);
        $this->assertEquals($hslColor->getLightness(), $lightness);
    }

    #[DataProvider('provideHSLData')]
    public function testMake($hsl, $rgb, $hex): void
    {
        list($hue, $saturation, $lightness) = $hsl;
        $hslColor = HSLColor::make($hsl);

        $this->assertInstanceOf(HSLColor::class, $hslColor);
        $this->assertEquals($hslColor->getHue(), $hue);
        $this->assertEquals($hslColor->getSaturation(), $saturation);
        $this->assertEquals($hslColor->getLightness(), $lightness);
    }

    /**
     * @param  mixed  $hsl  The input HSL color value
     * @param  array  $expected  The expected values for hue, saturation, and lightness
     * @covers       \Renfordt\Colors\HSLColor::create
     */
    #[DataProvider('provideInvalidHSLData')]
    public function testCreate_with_invalid_inputs($hsl, $expected): void
    {
        list($hue, $saturation, $lightness) = $expected;
        $hslColor = HSLColor::create($hsl);

        $this->assertInstanceOf(HSLColor::class, $hslColor);
        $this->assertEquals($hue, $hslColor->getHue());
        $this->assertEquals($saturation, $hslColor->getSaturation());
        $this->assertEquals($lightness, $hslColor->getLightness());
    }

    /**
     * @covers       \Renfordt\Colors\HSLColor::toRGB
     */
    #[DataProvider('provideHSLData')]
    public function testToRGB($hsl, $expectedRgb, $hex): void
    {
        list($hue, $saturation, $lightness) = $hsl;
        $hslColor = HSLColor::create($hsl);
        $rgbColor = $hslColor->toRGB();

        $this->assertInstanceOf(RGBColor::class, $rgbColor);
        $this->assertEquals($expectedRgb, $rgbColor->getRGB());
    }

    /**
     * @covers       \Renfordt\Colors\HSLColor::brighten
     */
    #[DataProvider('provideHSLData')]
    public function testBrighten(array $hsl): void
    {
        list($hue, $saturation, $lightness) = $hsl;
        $hslColor = HSLColor::create($hsl);

        $hslColor->brighten(30);
        $this->assertEquals(min(($lightness + 0.30), 1.0), $hslColor->getLightness());

        $hslColor->brighten(70);
        $this->assertEquals(1.0, $hslColor->getLightness());
    }

    /**
     * @covers       \Renfordt\Colors\HSLColor::darken
     */
    #[DataProvider('provideHSLData')]
    public function testDarken(array $hsl): void
    {
        list($hue, $saturation, $lightness) = $hsl;
        $hslColor = HSLColor::create($hsl);

        $hslColor->darken(30);
        $this->assertEquals(max(($lightness - 0.30), 0.0), $hslColor->getLightness());

        $hslColor->darken(70);
        $this->assertEquals(0.0, $hslColor->getLightness());
    }
    /**
     * @covers       \Renfordt\Colors\HSLColor::getHSL
     */
    #[DataProvider('provideHSLData')]
    public function testGetHSL($hsl, $rgb, $hex): void
    {
        list($hue, $saturation, $lightness) = $hsl;
        $hslColor = HSLColor::create($hsl);
        $result = $hslColor->getHSL();
        $this->assertIsArray($result);
        $this->assertCount(3, $result);
        $this->assertEquals($result, [$hue, $saturation, $lightness]);
    }

    /**
     * @covers       \Renfordt\Colors\HSLColor::toHex
     */
    #[DataProvider('provideHSLData')]
    public function testToHex($hsl, $rgb, $expectedHex): void
    {
        $hslColor = HSLColor::create($hsl);
        $hexColor = $hslColor->toHex();

        $this->assertInstanceOf(HexColor::class, $hexColor);
        $this->assertEquals($expectedHex, $hexColor->getHexStr(false));
    }
}
