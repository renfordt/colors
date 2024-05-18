<?php

declare(strict_types=1);

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

use Renfordt\Colors\RGBColor;

class RGBColorTest extends TestCase
{
    public static function makeProvider(): array
    {
        return [
            'out of limits rgb color' => [
                [300, 300, 300],
                'ffffff'
            ],
            'below limits rgb color' => [
                [-100, -100, -100],
                '000000'
            ],
            'redish color' => [
                [214, 43, 0],
                'd62b00'
            ],
            'greenish color' => [
                [51, 255, 94],
                '33ff5e'
            ],
            'blueish color' => [
                [76, 171, 200],
                '4cabc8'
            ],
        ];
    }

    public static function toHexProvider(): array
    {
        return [
            'black' => [[255, 255, 255], 'ffffff'],
            'white' => [[0, 0, 0], '000000'],
            'Mountain Meadow' => [[17, 195, 128], '11c380'],
            'Sienna' => [[140, 90, 69], '8c5a45'],
            'Dark Slate Grey' => [[51, 68, 85], '334455']
        ];
    }

    /**
     * Test the make method of the RGBColor class.
     */
    #[DataProvider('makeProvider')]
    public function testMake($rgb, $expected): void
    {
        $result = RGBColor::make($rgb);
        $this->assertNotEmpty($result->toHex());
        $this->assertEquals($expected, $result->toHex());
    }

    /**
     * Test the toHex method of the RGBColor class.
     */
    #[DataProvider('toHexProvider')]
    public function testToHex($rgb, $expected): void
    {
        $result = RGBColor::make($rgb);
        $this->assertIsString($result->toHex()->getHexStr());
        $this->assertSame($expected, $result->toHex()->getHexStr());
    }
}
