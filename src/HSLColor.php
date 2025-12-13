<?php

declare(strict_types=1);

namespace Renfordt\Colors;

use Renfordt\Colors\Traits\HueBasedTrait;

class HSLColor
{
    use HueBasedTrait;

    /**
     * The hue component of the HSL color (0-360)
     * Automatically clamped to valid range on assignment
     */
    public int $hue {
        get => $this->hue;
        set {
            $this->hue = (int)clamp($value, 0, 360);
        }
    }

    /**
     * The saturation component of the HSL color (0.0-1.0)
     * Automatically clamped to valid range on assignment
     */
    public float $saturation {
        get => $this->saturation;
        set {
            $this->saturation = (float)clamp($value, 0.0, 1.0);
        }
    }

    /**
     * The lightness component of the HSL color (0.0-1.0)
     * Automatically clamped to valid range on assignment
     */
    public float $lightness {
        get => $this->lightness;
        set {
            $this->lightness = (float)clamp($value, 0.0, 1.0);
        }
    }

    /**
     * Creates a new HSLColor object from an array of HSL values.
     *
     * @param array{0:int, 1:float, 2:float} $hsl An array containing the hue, saturation, and lightness values.
     * @return HSLColor The created HSLColor object.
     */
    public static function make(array $hsl): HSLColor
    {
        return self::create($hsl);
    }

    /**
     * Create a new HSLColor instance from an array of HSL values.
     *
     * @param array{0:int, 1:float, 2:float} $hsl An array containing the HSL values [hue, saturation, lightness].
     * @return HSLColor  The newly created HSLColor instance.
     */
    public static function create(array $hsl): HSLColor
    {
        [$hue, $saturation, $lightness] = $hsl;
        $hslColor = new HSLColor();
        $hslColor->hue = $hue;
        $hslColor->saturation = $saturation;
        $hslColor->lightness = $lightness;
        return $hslColor;
    }

    /**
     * Get the HSL (Hue, Saturation, Lightness) values of the color.
     *
     * @return array{0:int, 1:float, 2:float} The HSL values as an array with three elements: [hue, saturation, lightness].
     */
    public function getHSL(): array
    {
        return [$this->hue, $this->saturation, $this->lightness];
    }

    /**
     * Brighten the color by a specified amount.
     *
     * @param int $amount The amount to brighten the color by as a percentage (default: 10).
     */
    public function brighten(int $amount = 10): void
    {
        $this->lightness += $amount / 100;
    }

    /**
     * Darken the color by reducing its lightness value.
     *
     * @param int $amount The amount by which to darken the color (0-100).
     */
    public function darken(int $amount = 10): void
    {
        $this->lightness -= $amount / 100;
    }

    /**
     * Converts the current color object to hexadecimal representation.
     *
     * @return HexColor The hexadecimal representation of the current color.
     */
    public function toHex(): HexColor
    {
        return $this->toRGB()->toHex();
    }

    /**
     * Convert HSL color to RGB color space.
     *
     * @return RGBColor An array containing the RGB color values (red, green, blue).
     */
    public function toRGB(): RGBColor
    {
        $chroma = (1 - abs(2 * $this->lightness - 1)) * $this->saturation;
        $hueNormalized = $this->hue / 60;
        $hMod2 = $hueNormalized - 2 * floor($hueNormalized / 2);
        $intermediateValue = $chroma * (1 - abs($hMod2 - 1));

        [$red, $green, $blue] = self::calculateRGBRange($hueNormalized, $chroma, $intermediateValue);

        return self::finalizeRGBCalculation($red, $green, $blue, $this->lightness, $chroma, true);
    }
}
