<?php

namespace Renfordt\Colors\Traits;

use Renfordt\Colors\RGBColor;

trait HueBasedTrait
{
    /**
     * Calculate the RGB range based on the normalized hue value.
     *
     * @param  float  $hueNormalized  The normalized hue value (0-6).
     * @param  float  $chroma  The chroma value (0 - 360).
     * @param  float  $secondMax  The second maximum value.
     * @return array An array containing the RGB color values.
     */
    private static function calculateRGBRange(float $hueNormalized, float $chroma, float $secondMax): array
    {
        $rgbMap = [
            [[$chroma, $secondMax, 0], 1],
            [[$secondMax, $chroma, 0], 2],
            [[0, $chroma, $secondMax], 3],
            [[0, $secondMax, $chroma], 4],
            [[$secondMax, 0, $chroma], 5],
            [[$chroma, 0, $secondMax], 6],
        ];

        foreach ($rgbMap as $rgb) {
            if ($hueNormalized < $rgb[1]) {
                return $rgb[0];
            }
        }

        return [];
    }

    /**
     * Finalize the RGB color calculation based on the given parameters.
     *
     * @param  float  $red  The red component of the RGB color (0-255).
     * @param  float  $green  The green component of the RGB color (0-255).
     * @param  float  $blue  The blue component of the RGB color (0-255).
     * @param  float  $value  The value or lightness component of the RGB color (0-1).
     * @param  float  $chroma  The chroma component of the RGB color (0-1).
     * @param  bool  $isLightness  Flag indicating if the calculation is for lightness.
     * @return RGBColor An array containing the finalized RGB color values (red, green, blue).
     */
    private static function finalizeRGBCalculation(
        float $red,
        float $green,
        float $blue,
        float $value,
        float $chroma,
        bool $isLightness = false
    ): RGBColor {
        $adjustmentValue = $isLightness ? $value - $chroma / 2 : $value - $chroma;

        $red = self::adjustColorComponent($red, $adjustmentValue);
        $green = self::adjustColorComponent($green, $adjustmentValue);
        $blue = self::adjustColorComponent($blue, $adjustmentValue);

        return RGBColor::create([$red, $green, $blue]);
    }

    private static function adjustColorComponent(float $color, float $adjustmentValue): int
    {
        return intval(round(($color + $adjustmentValue) * 255));
    }
}
