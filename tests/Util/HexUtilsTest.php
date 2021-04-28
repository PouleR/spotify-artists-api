<?php

namespace PouleR\SpotifyArtistsAPI\Tests\Util;

use PHPUnit\Framework\TestCase;
use PouleR\SpotifyArtistsAPI\Util\HexUtils;

/**
 * Class HexUtilsTest
 */
class HexUtilsTest extends TestCase
{
    /**
     *
     */
    public function testByteArray2Hex(): void
    {
        $byteArray = [0xFF, 0xAE, 0x00, 0x56, 0x3E, 0x9D];
        self::assertEquals('ffae00563e9d', HexUtils::byteArray2Hex($byteArray));
    }

    /**
     *
     */
    public function testHex2ByteArray(): void
    {
        $byteArray = HexUtils::hex2ByteArray('33314567AE');
        self::assertEquals([0x33, 0x31, 0x45, 0x67, 0xAE], $byteArray);
    }
}
