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
     * Convert HSV color to RGB color space.
     *
     * @return RGBColor An array containing the RGB color values (red, green, blue).
     * @throws InvalidArgumentException if any of the parameters exceed their intended ranges.
     * @throws Exception if RGB calculation is not possible.
     */
    public function toRGB(): RGBColor
    {
        $this->validateParameters();

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

    private function validateParameters(): void
    {
        if ($this->hue < 0 || $this->hue > 360 ||
            $this->saturation < 0 || $this->saturation > 1 ||
            $this->value < 0 || $this->value > 1) {
            throw new InvalidArgumentException('Parameters exceed their intended ranges.');
        }
    }
}