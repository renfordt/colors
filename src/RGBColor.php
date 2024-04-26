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

    public static function make(array $rgb): RGBColor
    {
        $rgbColor = new RGBColor();
        $rgbColor->setRGB($rgb);
        return $rgbColor;
    }

    /**
     * Set the RGB color components.
     *
     * @param  array  $rgb  An array containing the red, green, and blue components of the RGB color.
     *                    The red component should be at index 0, green at index 1, and blue at index 2.
     * @return void
     * @throws InvalidArgumentException If the $rgb array does not contain exactly 3 elements.
     */
    public function setRGB(array $rgb): void
    {
        list($red, $green, $blue) = $rgb;
        $this->red = clamp($red, 0, 255);
        $this->green = clamp($green, 0, 255);
        $this->blue = clamp($blue, 0, 255);
    }

    /**
     * Convert RGB color to HSL color space.
     *
     * @return array An array containing the HSL color values (hue, saturation, lightness).
     */
    public function toHSL(): array
    {
        list($maxRGB, $minRGB, $chroma, $value, $hue) = $this->calculateCVH();

        if ($chroma == 0) {
            return array(0, 0, $value);
        }

        $lightness = ($maxRGB + $minRGB) / 2;
        $saturation = $chroma / (1 - abs(2 * $value - $chroma - 1));


        return array(round($hue), round($saturation, 2), round($lightness, 2));
    }

    /**
     * Calculate the components Chroma, Value, and Hue based on RGB color.
     *
     * @return array An array containing the calculated values (maxRGB, minRGB, chroma, value, hue).
     */
    public function calculateCVH(): array
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
     * Convert RGB color to HSV color space.
     *
     * @param  int  $red  The red component of the RGB color (0-255).
     * @param  int  $green  The green component of the RGB color (0-255).
     * @param  int  $blue  The blue component of the RGB color (0-255).
     * @return array An array containing the HSV color values (hue, saturation, value).
     */
    public function toHSV(): array
    {
        list($maxRGB, $minRGB, $chroma, $value, $hue) = $this->calculateCVH();

        if ($chroma == 0) {
            return array(0, 0, $value);
        }
        $saturation = $chroma / $maxRGB * 100;

        return array($hue, $saturation, $value);
    }

    /**
     * Convert RGB color to hexadecimal color representation.
     *
     * @param  int  $red  The red component of the RGB color (0-255).
     * @param  int  $green  The green component of the RGB color (0-255).
     * @param  int  $blue  The blue component of the RGB color (0-255).
     * @return string The hexadecimal representation of the RGB color.
     */
    public function toHex(): string
    {
        $hexRed = str_pad(dechex($this->red), 2, "0", STR_PAD_LEFT);
        $hexGreen = str_pad(dechex($this->green), 2, "0", STR_PAD_LEFT);
        $hexBlue = str_pad(dechex($this->blue), 2, "0", STR_PAD_LEFT);
        return $hexRed.$hexGreen.$hexBlue;
    }
}