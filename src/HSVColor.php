<?php

namespace Renfordt\Colors;

use Renfordt\Colors\Traits\HueBasedTrait;

class HSVColor
{
    use HueBasedTrait;

    /** @var int $hue The hue component of the HSV color (0-360) */
    private int $hue;
    /** @var float $saturation The saturation component of the HSV color (0.0-1.0) */
    private float $saturation;
    /** @var float $value The value component of the HSV color (0.0-1.0) */
    private float $value;

    /**
     * Creates a new instance of the HSVColor class based on provided HSV values.
     *
     * @param  array  $hsv  An array containing the hue, saturation, and value components in that order.
     * @return HSVColor          The newly created HSVColor object.
     */
    public static function create(array $hsv): HSVColor
    {
        list($hue, $saturation, $value) = $hsv;
        $hsvColor = new HSVColor();
        $hsvColor->setHue($hue);
        $hsvColor->setSaturation($saturation);
        $hsvColor->setValue($value);
        return $hsvColor;
    }

    /**
     * Creates an instance of HSVColor from an array of HSV values.
     *
     * This method initializes an HSVColor object using an array of HSV (Hue, Saturation, Value) values
     * and returns the created HSVColor instance.
     *
     * @param  array  $hsv  The array of HSV values used to create the HSVColor.
     * @return HSVColor The created HSVColor instance.
     * @deprecated 1.0.1 Use ::create method
     */
    public static function make(array $hsv): HSVColor
    {
        return self::create($hsv);
    }

    /**
     * Converts the color to its hexadecimal representation.
     *
     * This method converts the color to its hexadecimal representation by first converting it to the
     * RGB color model and then converting the RGB color to hexadecimal. The returned hexadecimal
     * color value is an instance of the HexColor class.
     *
     * @return HexColor The hexadecimal representation of the color.
     */
    public function toHex(): HexColor
    {
        return $this->toRGB()->toHex();
    }

    /**
     * Returns the RGB color representation of the HSV color.
     *
     * @return RGBColor The RGB color representation.
     */
    public function toRGB(): RGBColor
    {
        $chroma = $this->value * $this->saturation;
        $hueNormalized = $this->hue / 60;
        $hMod2 = $hueNormalized - 2 * floor($hueNormalized / 2);
        $secondMax = $chroma * (1 - abs($hMod2 - 1));

        list($red, $green, $blue) = self::calculateRGBRange($hueNormalized, $chroma, $secondMax);

        return self::finalizeRGBCalculation($red, $green, $blue, $this->value, $chroma);
    }

    /**
     * Returns the hue value of the color.
     *
     * @return int The hue value of the color.
     */
    public function getHue(): int
    {
        return $this->hue;
    }

    /**
     * Set the hue of the object, clamped between 0 and 360 degrees.
     *
     * @param  int  $hue  The hue value to set.
     *
     * @return void
     */
    public function setHue(int $hue): void
    {
        $this->hue = clamp($hue, 0, 360);
    }

    /**
     * Get the saturation of the object.
     *
     * @return float The saturation value of the object.
     */
    public function getSaturation(): float
    {
        return $this->saturation;
    }

    /**
     * Set the saturation of the object, clamped between 0.0 and 1.0.
     *
     * @param  float  $saturation  The saturation value to set.
     *
     * @return void
     */
    public function setSaturation(float $saturation): void
    {
        $this->saturation = clamp($saturation, 0.0, 1.0);
    }

    /**
     * Get the value component of the HSV color.
     *
     * @return float The value component of the HSV color.
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * Sets the value component of the HSV color.
     *
     * @param  float  $value  The value to be assigned.
     * @return void
     */
    public function setValue(float $value): void
    {
        $this->value = clamp($value, 0.0, 1.0);
    }

    /**
     * Retrieves the HSV color components.
     *
     * @return array The HSV color components as an array, where:
     *               - The first element is the hue component.
     *               - The second element is the saturation component.
     *               - The third element is the value component.
     */
    public function getHSV(): array
    {
        return [$this->hue, $this->saturation, $this->value];
    }
}
