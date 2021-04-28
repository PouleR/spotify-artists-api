<?php

namespace PouleR\SpotifyArtistsAPI\Tests;

use PHPUnit\Framework\TestCase;
use PouleR\SpotifyArtistsAPI\Exception\SpotifyArtistsAPIException;
use PouleR\SpotifyArtistsAPI\SpotifyLogin;

/**
 * Class SpotifyLoginTest
 */
class SpotifyLoginTest extends TestCase
{
    /**
     * @var SpotifyLogin
     */
    private $spotifyLogin;

    /**
     *
     */
    public function setUp(): void
    {
        $this->spotifyLogin = new SpotifyLogin();
    }

    /**
     *
     */
    public function testSolveChallenge(): void
    {
        $loginContext = hex2bin('0300c798435c4b0beb91e3b1db591d0a7f2e32816744a007af41cc7c8043b9295e1ed8a13cc323e4af2d0a3c42463b7a358ed116c33695989e0bfade0dab9c6bc6f7f928df5d49069e8ca4c04c34034669fc97e93da1ca17a7c11b2ffbb9b85f2265b10f6c83f7ef672240cb535eb122265da9b6f8d1a55af522fcbb40efc4eb753756ea38a63aff95d3228219afb0ab887075ac2fe941f7920fd19d32226052fe0956c71f0cb63ba702dd72d50d769920cd99ec6a45e00c85af5287b5d0031d6be4072efe71c59dffa5baa4077cd2eab4f22143eff18c31c69b8647e7f517468c84ed9548943fb1ba6b750ef63cdf9ce0a0fd07cb22d19484f4baa8ee6fa35fc573d9');
        $hashCashPrefix = hex2bin('48859603d6c16c3202292df155501c55');

        $result = $this->spotifyLogin->solveChallenge($loginContext, $hashCashPrefix, 10);

        $suffix = [0x7f, 0x7e, 0x55, 0x8b, 0xd1, 0x0c, 0x37, 0xd2, 0x00, 0x00, 0x00, 0x00, 0x00, 0x00, 0x02, 0xc7];
        self::assertEquals($suffix, $result->getSuffix());
        self::assertEquals(711, $result->getIterations());
        self::assertGreaterThan(0, $result->getDuration());
    }

    /**
     *
     */
    public function testSolveChallengeException(): void
    {
        $this->expectException(SpotifyArtistsAPIException::class);
        $this->spotifyLogin->solveChallenge(hex2bin('0000'), hex2bin('0000'), 8);
    }
}
