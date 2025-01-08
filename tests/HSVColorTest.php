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

#[CoversClass(HSVColor::class)]
#[UsesClass(RGBColor::class)]
#[UsesClass(HexColor::class)]
#[UsesClass(HSLColor::class)]
class HSVColorTest extends TestCase
{
    public static function provideHSVData(): array
    {
        return [
            'white' => [[0, 0, 1], [255, 255, 255], 'ffffff'],
            'black' => [[0, 0, 0], [0, 0, 0], '000000'],
            'Mountain Meadow' => [[157, 0.91, 0.76], [17, 194, 126], '11c27e'],
            'Sienna' => [[18, 0.51, 0.55], [140, 90, 69], '8c5a45'],
            'Dark Slate Grey' => [[210, 0.40, 0.33], [50, 67, 84], '324354'],
            'fuchsia' => [[300, 1.0, 1.0], [255, 0, 255], 'ff00ff'],
        ];
    }

    /**
     * @covers       \Renfordt\Colors\HSLColor::create
     */
    #[DataProvider('provideHSVData')]
    public function testCreate(array $hsv, array $rgb, string $hex): void
    {
        list($hue, $saturation, $value) = $hsv;
        $hsvColor = HSVColor::create($hsv);

        $this->assertInstanceOf(HSVColor::class, $hsvColor);
        $this->assertEquals($hue, $hsvColor->getHue());
        $this->assertEquals($saturation, $hsvColor->getSaturation());
        $this->assertEquals($value, $hsvColor->getValue());
    }

    #[DataProvider('provideHSVData')]
    public function testMake(array $hsv, array $rgb, string $hex): void
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
    public function testToRGB(array $hsv, array $rgb, string $hex): void
    {
        $hsvColor = HSVColor::create($hsv);
        $rgbColor = $hsvColor->toRGB();

        $this->assertInstanceOf(RGBColor::class, $rgbColor);
        $this->assertEquals($rgb, $rgbColor->getRGB());
    }

    /**
     * @covers       \Renfordt\Colors\HSVColor::toHex
     */
    #[DataProvider('provideHSVData')]
    public function testToHex(array $hsv, array $rgb, string $hex): void
    {
        $hsvColor = HSVColor::create($hsv);
        $hexColor = $hsvColor->toHex();

        $this->assertInstanceOf(HexColor::class, $hexColor);
        $this->assertEquals($hex, $hexColor->getHexStr(false));
    }

    /**
     * @covers       \Renfordt\Colors\HSVColor::getHSV
     */
    #[DataProvider('provideHSVData')]
    public function testGetHSV(array $hsv, array $rgb, string $hex): void
    {
        $hsvColor = HSVColor::create($hsv);
        $retrievedHSV = $hsvColor->getHSV();

        $this->assertIsArray($retrievedHSV);
        $this->assertEquals($hsv[0], $retrievedHSV[0]);
        $this->assertEquals($hsv[1], $retrievedHSV[1]);
        $this->assertEquals($hsv[2], $retrievedHSV[2]);
    }
}
