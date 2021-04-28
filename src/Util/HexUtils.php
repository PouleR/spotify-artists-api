<?php declare(strict_types=1);

namespace PouleR\SpotifyArtistsAPI\Util;

/**
 * Class HexUtils
 */
class HexUtils
{
    /**
     * @param string $hexString
     *
     * @return array
     */
    public static function hex2ByteArray(string $hexString): array
    {
        $string = hex2bin($hexString);
        $unpacked = unpack('C*', $string);

        return array_splice($unpacked, 0, count($unpacked));
    }

    /**
     * @param array $byteArray
     *
     * @return string
     */
    public static function byteArray2Hex(array $byteArray): string
    {
        $chars = array_map("chr", $byteArray);
        $bin = join($chars);

        return bin2hex($bin);
    }
}
