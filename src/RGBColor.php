<?php

namespace Renfordt\Colors;

class RGBColor
{
    /** @var int $red The red component of the RGB color (0-255) */
    private int $red;
    /** @var int $green The green component of the RGB color (0-255) */
    private int $green;
    /** @var int $blue The blue component of the RGB color (0-255) */
    private int $blue;

    /**
     * Get the RGB components of the color.
     *
     * @return array An array containing the red, green, and blue components of the color.
     */
    public function getRGB(): array
    {
        return array($this->red, $this->green, $this->blue);
    }

    /**
     * Converts the RGB color values to a HSL (Hue, Saturation, Lightness) color representation.
     *
     * @return HSLColor The HSL color representation.
     */
    public function toHSL(int $precision = 2): HSLColor
    {
        list($maxRGB, $minRGB, $chroma, $value, $hue) = $this->calculateCVH();

        if ($chroma == 0) {
            return HSLColor::make([0, 0, $value]);
        }

        $lightness = ($maxRGB + $minRGB) / 2;
        $saturation = $chroma / (1 - abs(2 * $value - $chroma - 1));


        return HSLColor::make([
            round($hue),
            round($saturation, $precision),
            round($lightness, $precision)
        ]);
    }

    /**
     * Calculate the components Chroma, Value, and Hue based on RGB color.
     *
     * @return array An array containing the calculated values (maxRGB, minRGB, chroma, value, hue).
     */
    private function calculateCVH(): array
    {
        $normalizedRed = $this->red / 255;
        $normalizedGreen = $this->green / 255;
        $normalizedBlue = $this->blue / 255;

        $maxRGB = max($normalizedRed, $normalizedGreen, $normalizedBlue);
        $minRGB = min($normalizedRed, $normalizedGreen, $normalizedBlue);
        $chroma = $maxRGB - $minRGB;
        $value = $maxRGB; // also called brightness
        if ($chroma == 0) {
            $hue = 0;
        } elseif ($maxRGB == $normalizedRed) {
            $hue = 60 * (($normalizedGreen - $normalizedBlue) / $chroma);
        } elseif ($maxRGB == $normalizedGreen) {
            $hue = 60 * (2 + ($normalizedBlue - $normalizedRed) / $chroma);
        } else {
            $hue = 60 * (4 + ($normalizedRed - $normalizedGreen) / $chroma);
        }

        if ($hue < 0) {
            $hue += 360;
        }
        return array($maxRGB, $minRGB, $chroma, $value, $hue);
    }

    /**
     * Creates a new RGBColor object from an array of RGB color values.
     *
     * @param  array  $rgb  An array of RGB color values [red, green, blue].
     * @return RGBColor The new RGBColor object.
     */
    public static function make(array $rgb): RGBColor
    {
        $rgbColor = new RGBColor();
        $rgbColor->setRGB($rgb);
        return $rgbColor;
    }

    /**
     * Sets the RGB color values.
     *
     * @param  array  $rgb  An array containing the RGB color values.
     *      The array should have three elements, representing the red, green, and blue values, respectively.
     *      Each value should be an integer between 0 and 255.
     * @return void
     */
    public function setRGB(array $rgb): void
    {
        list($red, $green, $blue) = $rgb;
        $this->red = clamp($red, 0, 255);
        $this->green = clamp($green, 0, 255);
        $this->blue = clamp($blue, 0, 255);
    }

    /**
     * Converts the RGB color values to the HSV (Hue, Saturation, Value) color representation.
     *
     * @return HSVColor The HSV color representation.
     */
    public function toHSV(int $precision = 2): HSVColor
    {
        list($maxRGB, $minRGB, $chroma, $value, $hue) = $this->calculateCVH();

        if ($chroma == 0) {
            return HSVColor::make([0, 0, $value]);
        }
        $saturation = $chroma / $maxRGB;

        return HSVColor::make([
            round($hue),
            round($saturation, $precision),
            round($value, $precision),
        ]);
    }

    /**
     * Converts the RGB color values to a hexadecimal color representation.
     *
     * @return HexColor The hexadecimal color representation.
     */
    public function toHex(): HexColor
    {
        $hexRed = str_pad(dechex($this->red), 2, "0", STR_PAD_LEFT);
        $hexGreen = str_pad(dechex($this->green), 2, "0", STR_PAD_LEFT);
        $hexBlue = str_pad(dechex($this->blue), 2, "0", STR_PAD_LEFT);
        return HexColor::make($hexRed.$hexGreen.$hexBlue);
    }
}