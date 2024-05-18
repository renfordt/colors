<?php

namespace Renfordt\Colors;

use InvalidArgumentException;

class HexColor
{
    /**
     * @var string $hexStr The hexadecimal string representation
     */
    private string $hexStr;

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
                hexdec(str_repeat(substr($this->hexStr, 0, 1), 2)),
                hexdec(str_repeat(substr($this->hexStr, 1, 1), 2)),
                hexdec(str_repeat(substr($this->hexStr, 2, 1), 2))
            );
        }

        return RGBColor::make($color);
    }

    /**
     * Creates a new instance of the HexColor class with the specified hexadecimal string.
     *
     * @param  string  $hexStr  The hexadecimal string representing the color. It must be a valid hexadecimal color code without the '#'.
     *
     * @return HexColor The newly created instance of the HexColor class with the specified hexadecimal string.
     */
    public static function make(string $hexStr): HexColor
    {
        $hexColor = new HexColor();
        $hexColor->setHexStr($hexStr);
        return $hexColor;
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
}