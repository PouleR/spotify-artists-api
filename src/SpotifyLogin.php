<?php declare(strict_types=1);

namespace PouleR\SpotifyArtistsAPI;

use PouleR\SpotifyArtistsAPI\Entity\SolvedLoginChallenge;
use PouleR\SpotifyArtistsAPI\Exception\SpotifyArtistsAPIException;
use PouleR\SpotifyArtistsAPI\Util\HexUtils;

/**
 * Class SpotifyLogin
 */
class SpotifyLogin
{
    public const LOGIN_URL = 'https://login5.spotify.com/v3/login';
    private const MAX_ITERATIONS = 5000;
    /**
     * @param string $loginContext
     * @param string $hashCashPrefix
     * @param int    $hashCashLength
     *
     * @return SolvedLoginChallenge
     *
     * @throws \Exception
     */
    public function solveChallenge(string $loginContext, string $hashCashPrefix, int $hashCashLength) : SolvedLoginChallenge
    {
         $seed = substr(sha1($loginContext), -16);
         $seed = HexUtils::hex2ByteArray($seed);

         $start = hrtime();
         $solved = $this->solveHashCash($hashCashPrefix, $hashCashLength, $seed);
         $end = hrtime();
         $solved->setDuration($end[1] - $start[1]);

         return $solved;
     }

    /**
     * @param array $trailingData
     *
     * @return bool
     */
    private function checkTenTrailingBits(array $trailingData) : bool
    {
        if ($trailingData[count($trailingData) - 1] != 0) {
            return false;
        }

        return $this->countTrailingZero($trailingData[count($trailingData) - 2]) >= 2;
    }

    /**
     * @param int $x
     *
     * @return int
     */
    private function countTrailingZero(int $x): int
    {
        $count = 0;
        while (($x & 1) == 0) {
            $x = $x >> 1;
            $count++;
        }

        return $count;
    }

    /**
     * @param array $ctr
     * @param int   $index
     */
    private function incrementCtr(array &$ctr, int $index): void
    {
        $ctr[$index]++;
        if ($ctr[$index] > 0xFF && $index != 0) {
            $ctr[$index] = 0;
            $this->incrementCtr($ctr, $index - 1);
        }
    }

    /**
     * @param string $prefix
     * @param int    $length
     * @param array  $random
     *
     * @return SolvedLoginChallenge
     *
     * @throws \Exception
     */
    private function solveHashCash(string $prefix, int $length, array $random) : SolvedLoginChallenge
    {
        if (10 !== $length) {
            throw new SpotifyArtistsAPIException('Invalid hashCash length');
        }

        // Append suffix with zeroes
        $suffix = array_merge($random, [0, 0, 0, 0, 0, 0, 0, 0]);
        $i = 0;
        while (true) {
            $input = (bin2hex($prefix) . HexUtils::byteArray2Hex($suffix));
            $digest = sha1(hex2bin($input));

            if ($this->checkTenTrailingBits(HexUtils::hex2ByteArray($digest))) {
                return new SolvedLoginChallenge($suffix, $i);
            }

            $this->incrementCtr($suffix, count($suffix) - 1);
            $this->incrementCtr($suffix, 7);

            $i++;

            if ($i >= self::MAX_ITERATIONS) {
                throw new SpotifyArtistsAPIException('Too many iterations needed to solve hashCash, try again');
            }
        }
    }
}
