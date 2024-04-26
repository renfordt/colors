<?php

namespace Renfordt\Colors\Tests;

use PHPUnit\Framework\TestCase;
use Renfordt\Colors\HexColor;
use InvalidArgumentException;

/**
 * @covers \Renfordt\Colors\HexColor
 */
class HexColorTest extends TestCase
{

    /**
     * @covers \Renfordt\Colors\HexColor::setHexStr
     */
    public function test_valid_hex_string()
    {
        $color = new HexColor();
        $color->setHexStr('#123abc');
        $this->assertSame('123abc', $color->getHexStr(false));
    }

    /**
     * @covers \Renfordt\Colors\HexColor::setHexStr
     */
    public function test_invalid_hex_string_throws_exception()
    {
        $color = new HexColor();
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The format of the hex is invalid.');
        $color->setHexStr('1234');
    }

    /**
     * @covers \Renfordt\Colors\HexColor::setHexStr
     * @covers \Renfordt\Colors\HexColor::getHexStr
     */
    public function test_withHash_returns_hashed_hex_string()
    {
        $color = new HexColor();
        $color->setHexStr('#fff');
        $this->assertSame('#fff', $color->getHexStr(true));
    }
}