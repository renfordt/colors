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
        if (0 <= $hueNormalized && $hueNormalized < 1) {
            return [$chroma, $secondMax, 0];
        } elseif (1 <= $hueNormalized && $hueNormalized < 2) {
            return [$secondMax, $chroma, 0];
        } elseif (2 <= $hueNormalized && $hueNormalized < 3) {
            return [0, $chroma, $secondMax];
        } elseif (3 <= $hueNormalized && $hueNormalized < 4) {
            return [0, $secondMax, $chroma];
        } elseif (4 <= $hueNormalized && $hueNormalized < 5) {
            return [$secondMax, 0, $chroma];
        } elseif (5 <= $hueNormalized && $hueNormalized < 6) {
            return [$chroma, 0, $secondMax];
        } else {
            return [];
        }
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
        $m = $isLightness ? $value - $chroma / 2 : $value - $chroma;

        $rgb = array_map(fn($color) => intval(round(($color + $m) * 255)), [$red, $green, $blue]);

        return RGBColor::make($rgb);
    }
}