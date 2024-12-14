<?php

namespace Renfordt\Colors;

use Renfordt\Colors\Traits\HueBasedTrait;

class HSLColor
{
    use HueBasedTrait;

    /** @var int $hue The hue component of the HSL color (0-359) */
    private int $hue;
    /** @var float $saturation The saturation component of the HSL color (0.0-1.0) */
    private float $saturation;
    /** @var float $lightness The lightness component of the HSL color (0.0-1.0) */
    private float $lightness;

    /**
     * Create a new HSLColor instance from an array of HSL values.
     *
     * @param  array{0:int, 1:float, 2:float}  $hsl  An array containing the HSL values [hue, saturation, lightness].
     * @return HSLColor  The newly created HSLColor instance.
     */
    public static function create(array $hsl): HSLColor
    {
        list($hue, $saturation, $lightness) = $hsl;
        $hslColor = new HSLColor();
        $hslColor->setHue($hue);
        $hslColor->setSaturation($saturation);
        $hslColor->setLightness($lightness);
        return $hslColor;
    }

    /**
     * Creates a new HSLColor object from an array of HSL values.
     *
     * @param  array{0:int, 1:float, 2:float}  $hsl  An array containing the hue, saturation, and lightness values.
     * @return HSLColor The created HSLColor object.
     * @deprecated 1.0.1 Use ::create method
     */
    public static function make(array $hsl): HSLColor
    {
        return self::create($hsl);
    }

    /**
     * Get the hue value of the color.
     *
     * @return int The hue value of the color.
     */
    public function getHue(): int
    {
        return $this->hue;
    }

    /**
     * Set the hue value of the color.
     *
     * @param  int  $hue  The hue value to be set (0-360).
     * @return void
     */
    public function setHue(int $hue): void
    {
        $this->hue = clamp($hue, 0, 360);
    }

    /**
     * Get the saturation value of the color.
     *
     * @return float The saturation value of the color.
     */
    public function getSaturation(): float
    {
        return $this->saturation;
    }

    /**
     * Set the saturation value of the color.
     *
     * @param  float  $saturation  The saturation value to be set (0.0-1.0).
     * @return void
     */
    public function setSaturation(float $saturation): void
    {
        $this->saturation = clamp($saturation, 0.0, 1.0);
    }

    /**
     * Get the lightness value of the color.
     *
     * @return float The lightness value of the color.
     */
    public function getLightness(): float
    {
        return $this->lightness;
    }

    /**
     * Set the lightness value of the color.
     *
     * @param  float  $lightness  The new lightness value for the color (0.0-1.0).
     * @return void
     */
    public function setLightness(float $lightness): void
    {
        $this->lightness = clamp($lightness, 0.0, 1.0);
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
     * @param  int  $amount  The amount to brighten the color by as a percentage (default: 10).
     * @return void
     */
    public function brighten(int $amount = 10): void
    {
        $this->setLightness($this->lightness + $amount / 100);
    }

    /**
     * Darken the color by reducing its lightness value.
     *
     * @param  int  $amount  The amount by which to darken the color (0-100).
     * @return void
     */
    public function darken(int $amount = 10): void
    {
        $this->setLightness($this->lightness - $amount / 100);
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
     * @throws Exception If RGB calculation is not possible.
     */
    public function toRGB(): RGBColor
    {
        $chroma = (1 - abs(2 * $this->lightness - 1)) * $this->saturation;
        $hueNormalized = $this->hue / 60;
        $hMod2 = $hueNormalized - 2 * floor($hueNormalized / 2);
        $intermediateValue = $chroma * (1 - abs($hMod2 - 1));

        list($red, $green, $blue) = self::calculateRGBRange($hueNormalized, $chroma, $intermediateValue);

        if (!isset($red) || !isset($green) || !isset($blue)) {
            throw new Exception('RGB calculation not possible. Check inputs!');
        }

        return self::finalizeRGBCalculation($red, $green, $blue, $this->lightness, $chroma, true);
    }
}
