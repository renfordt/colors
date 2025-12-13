<?php

declare(strict_types=1);

namespace Renfordt\Colors;

use Renfordt\Colors\Traits\HueBasedTrait;

class HSVColor
{
    use HueBasedTrait;

    /**
     * The hue component of the HSV color (0-360)
     * Automatically clamped to valid range on assignment
     */
    public int $hue {
        get => $this->hue;
        set {
            $this->hue = (int)clamp($value, 0, 360);
        }
    }

    /**
     * The saturation component of the HSV color (0.0-1.0)
     * Automatically clamped to valid range on assignment
     */
    public float $saturation {
        get => $this->saturation;
        set {
            $this->saturation = (float)clamp($value, 0.0, 1.0);
        }
    }

    /**
     * The value component of the HSV color (0.0-1.0)
     * Automatically clamped to valid range on assignment
     */
    public float $value {
        get => $this->value;
        set {
            $this->value = (float)clamp($value, 0.0, 1.0);
        }
    }

    /**
     * Creates an instance of HSVColor from an array of HSV values.
     *
     * This method initializes an HSVColor object using an array of HSV (Hue, Saturation, Value) values
     * and returns the created HSVColor instance.
     *
     * @param array{0:int, 1:float, 2:float} $hsv The array of HSV values used to create the HSVColor.
     * @return HSVColor The created HSVColor instance.
     */
    public static function make(array $hsv): HSVColor
    {
        return self::create($hsv);
    }

    /**
     * Creates a new instance of the HSVColor class based on provided HSV values.
     *
     * @param array{0:int, 1:float, 2:float} $hsv An array containing the hue, saturation, and value components in that order.
     * @return HSVColor          The newly created HSVColor object.
     */
    public static function create(array $hsv): HSVColor
    {
        [$hue, $saturation, $value] = $hsv;
        $hsvColor = new HSVColor();
        $hsvColor->hue = $hue;
        $hsvColor->saturation = $saturation;
        $hsvColor->value = $value;
        return $hsvColor;
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

        [$red, $green, $blue] = self::calculateRGBRange($hueNormalized, $chroma, $secondMax);

        return self::finalizeRGBCalculation($red, $green, $blue, $this->value, $chroma);
    }

    /**
     * Retrieves the HSV color components.
     *
     * @return array{0:int, 1:float, 2:float} The HSV color components as an array, where:
     *               - The first element is the hue component.
     *               - The second element is the saturation component.
     *               - The third element is the value component.
     */
    public function getHSV(): array
    {
        return [$this->hue, $this->saturation, $this->value];
    }
}
