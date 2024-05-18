<?php

namespace Renfordt\Colors;

use InvalidArgumentException;

class HexColor
{
    private string $hexStr;

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
     * Converts a hexadecimal color code to RGB color
     * @return array|int[] Array of red, green, and blue values [0..255]
     * @throws InvalidArgumentException if the provided hex code is invalid
     */
    public function toRGB(): array
    {
        $length = strlen($this->hexStr);

        if ($length === 6) {
            $colorVal = hexdec($this->hexStr);

            return array(
                0xFF & ($colorVal >> 0x10),
                0xFF & ($colorVal >> 0x8),
                0xFF & $colorVal
            );
        }

        return array(
            hexdec(str_repeat(substr($this->hexStr, 0, 1), 2)),
            hexdec(str_repeat(substr($this->hexStr, 1, 1), 2)),
            hexdec(str_repeat(substr($this->hexStr, 2, 1), 2))
        );
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
        $hexStr = str_replace('#', '', $hexStr);
        if (!self::isValidHex($hexStr)) {
            throw new InvalidArgumentException('The format of the hex is invalid.');
        }
        $this->hexStr = $hexStr;
    }

    private static function isValidHex(string $hexString)
    {
        if (strlen($hexString) !== 3
            && strlen($hexString) !== 6
            || preg_match("/^[0-9a-fA-F]+$/", $hexString) !== 1) {
            return false;
        }
        return true;
    }
}