<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use Renfordt\Colors\RGBColor;

class RGBColorTest extends TestCase
{
    /**
     * Test the make method of the RGBColor class.
     * @dataProvider makeProvider
     */
    public function testMake(): void
    {
        // Testing out-of-bounds color values
        $result = RGBColor::make([300, 300, 300]);
        $this->assertNotEmpty($result->toHex());
        $this->assertEquals('ffffff', $result->toHex());

        // Testing RGB maximum value
        $result = RGBColor::make([255, 255, 255]);
        $this->assertNotEmpty($result->toHex());
        $this->assertEquals('ffffff', $result->toHex());

        // Testing RGB minimum value
        $result = RGBColor::make([0, 0, 0]);
        $this->assertNotEmpty($result->toHex());
        $this->assertEquals('000000', $result->toHex());

        // Testing valid RGB color values
        $result = RGBColor::make([120, 255, 64]);
        $this->assertNotEmpty($result->toHex());
        $this->assertEquals('78ff40', $result->toHex());

        // Testing negative color values to be clamped to zero
        $result = RGBColor::make([-20, -20, -20]);
        $this->assertNotEmpty($result->toHex());
        $this->assertEquals('000000', $result->toHex());
    }

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
}