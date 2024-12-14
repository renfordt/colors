<?php

namespace Renfordt\Colors;

use InvalidArgumentException;

class HexColor
{
    /**
     * @var string $hexStr The hexadecimal string representation
     */
    private string $hexStr;

    public function __toString(): string
    {
        return $this->getHexStr();
    }

    /**
     * Retrieves the hexadecimal string representation of the value.
     *
     * @param  bool  $withHash  (optional) Whether to include '#' in the hexadecimal string. Defaults to true.
     *
     * @return string The hexadecimal string representation of the value. If $withHash is true, the string will
     *                start with '#'. Otherwise, it will not include '#'.
     */
    public function getHexStr(bool $withHash = true): string
    {
        return $withHash ? '#'.$this->hexStr : $this->hexStr;
    }

    /**
     * Sets the hexadecimal string representation of the value.
     *
     * @param  string  $hexStr  The hexadecimal string to set.
     *
     * @return void
     * @throws InvalidArgumentException if the format of the hex is invalid.
     *
     */
    public function setHexStr(string $hexStr): void
    {
        $hexStr = HexColor::removeHash($hexStr);
        if (!self::isValidHex($hexStr)) {
            throw new InvalidArgumentException('The format of the hex is invalid.');
        }
        $this->hexStr = $hexStr;
    }

    /**
     * Removes the '#' character from the hexadecimal string.
     *
     * @param  string  $hexStr  The hexadecimal string.
     *
     * @return string The hexadecimal string without the '#' character.
     */
    private static function removeHash(string $hexStr): string
    {
        return str_replace('#', '', $hexStr);
    }

    /**
     * Checks if a given string is a valid hexadecimal color code.
     *
     * @param  string  $hexString  The string to check if it is a valid hexadecimal color code.
     *
     * @return bool Returns true if the given string is a valid hexadecimal color code, otherwise returns false.
     */
    private static function isValidHex(string $hexString): bool
    {
        if (strlen($hexString) !== 3
            && strlen($hexString) !== 6
            || preg_match("/^[0-9a-fA-F]+$/", $hexString) !== 1) {
            return false;
        }
        return true;
    }

    /**
     * Convert the color to HSL representation.
     *
     * @param  int  $precision  The number of decimal places to round the result values to (default: 4).
     * @return HSLColor The HSL representation of the color.
     */
    public function toHSL(int $precision = 4): HSLColor
    {
        return $this->toRGB()->toHSL($precision);
    }

    /**
     * Converts the hexadecimal string representation to RGB color.
     *
     * @return RGBColor The RGB color representation of the hex string.
     * @throws InvalidArgumentException if the length of hex string is not 6 or 3 characters.
     *
     */
    public function toRGB(): RGBColor
    {
        $length = strlen($this->hexStr);

        if ($length === 6) {
            $colorVal = hexdec($this->hexStr);

            $color = array(
                0xFF & ($colorVal >> 0x10),
                0xFF & ($colorVal >> 0x8),
                0xFF & $colorVal
            );
        } else {
            $color = array(
                (int) hexdec(str_repeat(substr($this->hexStr, 0, 1), 2)),
                (int) hexdec(str_repeat(substr($this->hexStr, 1, 1), 2)),
                (int) hexdec(str_repeat(substr($this->hexStr, 2, 1), 2))
            );
        }

        return RGBColor::create($color);
    }

    /**
     * Creates a new instance of the HexColor class with the specified hexadecimal string.
     *
     * @param  string  $hexStr  The hexadecimal string representing the color. It must be a valid hexadecimal color code without the '#'.
     *
     * @return HexColor The newly created instance of the HexColor class with the specified hexadecimal string.
     */
    public static function create(string $hexStr): HexColor
    {
        $hexColor = new HexColor();
        $hexColor->setHexStr($hexStr);
        return $hexColor;
    }

    /**
     * Create a new HexColor instance from a hexadecimal color string.
     *
     * @param  string  $hexStr  The hexadecimal color string.
     * @return HexColor A new HexColor instance.
     * @deprecated 1.0.1 Use ::create method
     */
    public static function make(string $hexStr): HexColor
    {
        return self::create($hexStr);
    }

    /**
     * Convert the color to HSV representation.
     *
     * @param  int  $precision  The number of decimal places to round the result values to (default: 4).
     * @return HSVColor The HSV representation of the color.
     */
    public function toHSV(int $precision = 4): HSVColor
    {
        return $this->toRGB()->toHSV($precision);
    }
}
