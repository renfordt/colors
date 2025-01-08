<?php

declare(strict_types=1);

namespace Traits;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;
use Renfordt\Colors\RGBColor;
use Renfordt\Colors\Traits\HueBasedTrait;

#[CoversClass(HueBasedTrait::class)]
#[UsesClass(RGBColor::class)]
class HueBasedTraitTest extends TestCase
{
    use HueBasedTrait {
        calculateRGBRange as public traitCalculateRGBRange;
    }

    /**
     * @dataProvider calculateRGBRangeDataProvider
     */
    public function testCalculateRGBRange(float $hueNormalized, float $chroma, float $secondMax, array $expected): void
    {
        $result = $this->traitCalculateRGBRange($hueNormalized, $chroma, $secondMax);
        $this->assertSame($expected, $result);
    }

    public static function calculateRGBRangeDataProvider(): array
    {
        return [
            'Red Region' => [0.5, 1.0, 0.5, [1.0, 0.5, 0.0]],
            'Yellow Region' => [1.5, 1.0, 0.5, [0.5, 1.0, 0.0]],
            'Green Region' => [2.5, 1.0, 0.5, [0.0, 1.0, 0.5]],
            'Cyan Region' => [3.5, 1.0, 0.5, [0.0, 0.5, 1.0]],
            'Blue Region' => [4.5, 1.0, 0.5, [0.5, 0.0, 1.0]],
            'Magenta Region' => [5.5, 1.0, 0.5, [1.0, 0.0, 0.5]],
            'Out of Bounds' => [6.5, 1.0, 0.5, [0.0, 0.0, 0.0]],
        ];
    }
}
