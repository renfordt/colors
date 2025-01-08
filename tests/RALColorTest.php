<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\UsesClass;
use Renfordt\Colors\HSLColor;
use Renfordt\Colors\HSVColor;
use Renfordt\Colors\RALColor;
use Renfordt\Colors\HexColor;
use PHPUnit\Framework\TestCase;
use Renfordt\Colors\RGBColor;

#[CoversClass(RALColor::class)]
#[UsesClass(HexColor::class)]
#[UsesClass(HSVColor::class)]
#[UsesClass(RGBColor::class)]
#[UsesClass(HSLColor::class)]
class RALColorTest extends TestCase
{
    /**
     * The RALStrValues method is a dataProvider for the testToHexValid_RALStr and
     * testToRGBValid_RALStr tests.
     */
    public static function RALStrValues(): array
    {
        return [
            ['1000', '#C5BB8A'],
            ['1001', '#C6B286'],
            ['1002', '#C7AE72'],
            ['1003', '#E6B019'],
            ['1004', '#D2A40E'],
            ['1005', '#BC9611'],
            ['1006', '#CF9804'],
            ['1007', '#D49300'],
            ['1011', '#A38454'],
            ['1012', '#CFB539'],
            ['1026', '#FFFF00'],
            ['4001', '#7C5B80'],
            ['4002', '#823A4B'],
            ['4003', '#B65A88'],
            ['4004', '#5F1837'],
            ['9001', '#E5E1D4'],
            ['9002', '#D4D5CD'],
            ['9003', '#EBECEA'],
            ['9004', '#2F3133'],
            ['9005', '#131516'],
        ];
    }

    /**
     * The findClosestColorValues method is a dataProvider for the testFindClosestColor test.
     */
    public static function findClosestColorValues(): array
    {
        return [
            [HexColor::create('#333333'), '#2F3133'],
            [HexColor::create('#666666'), '#68675F'],
            [HexColor::create('#999999'), '#969799'],
            [HexColor::create('#CCCCCC'), '#C6CBC6'],
            [HexColor::create('#FFFFFF'), '#EFF0EB']
        ];
    }

    /**
     * The testToHexValid_RALStr tests the toHex method for valid input.
     *
     */
    #[DataProvider('RALStrValues')]
    public function testToHexValid_RALStr(string $RALStr, string $expected): void
    {
        $RALColor = RALColor::create($RALStr);
        $actual = $RALColor->toHex();
        $this->assertEquals($expected, $actual);
    }

    /**
     * The testToHexValid_RALStr tests the toHex method for valid input.
     *
     */
    #[DataProvider('RALStrValues')]
    public function testToHexValid_RALStrWithMake(string $RALStr, string $expected): void
    {
        $RALColor = RALColor::make($RALStr);
        $actual = $RALColor->toHex();
        $this->assertEquals($expected, $actual);
    }

    /**
     * Tests for the toRGB method in the RALColor class.
     *
     * This test validates that the conversion from RALColor to
     * RGBColor is correct for valid RALColor input.
     *
     */
    #[DataProvider('RALStrValues')]
    public function testToRGBValid_RALStr(string $RALStr, string $expectedHex): void
    {
        $RALColor = RALColor::create($RALStr);
        $expectedRGB = HexColor::create($expectedHex)->toRGB();
        $actualRGB = $RALColor->toRGB();
        $this->assertEquals($expectedRGB, $actualRGB);
    }

    /**
     * The testFindClosestColor tests the findClosestColor method for valid input.
     *
     */
    #[DataProvider('findClosestColorValues')]
    public function testFindClosestColor(HexColor $hexColor, string $expected): void
    {
        $RALColor = new RALColor();
        $actual = $RALColor->findClosestColor($hexColor);
        $this->assertEquals($expected, $actual->toHex());
    }

    /**
     * Add test for the setRAL method in the RALColor class.
     *
     * This test is validing the RAL string for the RALColor instance.
     */
    public function testSetRAL_Valid_RALStr(): void
    {
        $RALColor = new RALColor();
        $RALColor->setRAL(1000);
        $expected = '#C5BB8A';
        $actual = $RALColor->toHex()->getHexStr();
        $this->assertEquals($expected, $actual);
    }

    /**
     * Tests for the toHSL method in the RALColor class.
     *
     * This test validates that the conversion from RALColor to
     * HSLColor is correct for valid RALColor input.
     *
     */
    #[DataProvider('RALStrValues')]
    public function testToHSLValid_RALStr(string $RALStr, string $expectedHex): void
    {
        $RALColor = RALColor::create($RALStr);
        $expectedHSL = HexColor::create($expectedHex)->toHSL();
        $actualHSL = $RALColor->toHSL();
        $this->assertEquals($expectedHSL, $actualHSL);
    }

    /**
     * Tests for the toHSV method in the RALColor class.
     *
     * This test validates that the conversion from RALColor to
     * HSVColor is correct for valid RALColor input.
     *
     */
    #[DataProvider('RALStrValues')]
    public function testToHSVValid_RALStr(string $RALStr, string $expectedHex): void
    {
        $RALColor = RALColor::create($RALStr);
        $expectedHSV = HexColor::create($expectedHex)->toHSV();
        $actualHSV = $RALColor->toHSV();
        $this->assertEquals($expectedHSV, $actualHSV);
    }
}
