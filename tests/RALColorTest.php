<?php

namespace Renfordt\Colors\Tests;

use Renfordt\Colors\RALColor;
use Renfordt\Colors\HexColor;
use PHPUnit\Framework\TestCase;

/**
 * RALColorTest tests the functionality of the RALColor class, exclusive to the toHex method.
 */
class RALColorTest extends TestCase
{
    /**
     * The testToHexValid_RALStr tests the toHex method for valid input.
     *
     * @dataProvider RALStrValues
     */
    public function testToHexValid_RALStr($RALStr, $expected)
    {
        $RALColor = RALColor::make($RALStr);
        $actual = $RALColor->toHex();
        $this->assertEquals($expected, $actual);
    }

    /**
     * The RALStrValues method is a dataProvider for the testToHexValid_RALStr test.
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
     * The testFindClosestColor tests the findClosestColor method for valid input.
     *
     * @dataProvider findClosestColorValues
     */
    public function testFindClosestColor(HexColor $hexColor, $expected)
    {
        $RALColor = new RALColor();
        $actual = $RALColor->findClosestColor($hexColor);
        $this->assertEquals($expected, $actual->getHexStr());
    }

    /**
     * The findClosestColorValues method is a dataProvider for the testFindClosestColor test.
     */
    public static function findClosestColorValues(): array
    {
        return [
            [HexColor::make('#333333'), '#25282A'],
            [HexColor::make('#666666'), '#767779'],
            [HexColor::make('#999999'), '#818382'],
            [HexColor::make('#CCCCCC'), '#C6CBC6'],
            [HexColor::make('#FFFFFF'), '#EEEEEE']
        ];
    }
    /**
     * Add test for the setRAL method in the RALColor class.
     *
     * This test is validing the RAL string for the RALColor instance.
     */
    public function testSetRAL_Valid_RALStr(): void
    {
        $RALColor = new RALColor();
        $RALColor->setRAL('1000');
        $expected = '#C5BB8A';
        $actual = $RALColor->toHex()->getHexStr();
        $this->assertEquals($expected, $actual);
    }
}
