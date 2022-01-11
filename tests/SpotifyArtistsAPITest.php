<?php declare(strict_types=1);

namespace PouleR\SpotifyArtistsAPI\Tests;

use PHPUnit\Framework\MockObject\MockObject;
use PouleR\SpotifyArtistsAPI\SpotifyArtistsAPI;
use PouleR\SpotifyArtistsAPI\SpotifyArtistsAPIClient;
use PHPUnit\Framework\TestCase;
use PouleR\SpotifyLogin\Exception\SpotifyLoginException;
use PouleR\SpotifyLogin\SpotifyLogin;

/**
 * Class SpotifyArtistsAPITest
 */
class SpotifyArtistsAPITest extends TestCase
{
    /**
     * @var MockObject|SpotifyArtistsAPIClient
     */
    private $apiClient;

    /**
     * @var MockObject|SpotifyLogin
     */
    private $spotifyLogin;
    private SpotifyArtistsAPI $artistsAPI;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->apiClient = $this->createMock(SpotifyArtistsAPIClient::class);
        $this->spotifyLogin = $this->createMock(SpotifyLogin::class);
        $this->artistsAPI = new SpotifyArtistsAPI($this->apiClient, $this->spotifyLogin);
        $this->artistsAPI->setAccessToken('access.token');
    }

    /**
     * @return void
     */
    public function testClientId(): void
    {
        $this->spotifyLogin->expects(self::once())
            ->method('setClientId')
            ->with('client.id');

        $this->artistsAPI->setClientId('client.id');
    }

    /**
     * @return void
     */
    public function testDeviceId(): void
    {
        $this->spotifyLogin->expects(self::once())
            ->method('setDeviceId')
            ->with('device.id');

        $this->artistsAPI->setDeviceId('device.id');
    }

    /**
     * @return void
     *
     * @throws SpotifyLoginException
     */
    public function testLogin(): void
    {
        $this->spotifyLogin->expects(self::once())
            ->method('login')
            ->with('username', 'password');

        $this->artistsAPI->login('username', 'password');
    }

    /**
     * @return void
     *
     * @throws SpotifyLoginException
     */
    public function testRefreshToken(): void
    {
        $this->spotifyLogin->expects(self::once())
            ->method('refreshToken')
            ->with('username', 'refresh');

        $this->artistsAPI->refreshToken('username', 'refresh');
    }

    /**
     * @return void
     */
    public function testRealTimeStatistics(): void
    {
        $this->apiClient->expects(self::once())
            ->method('apiRequest')
            ->with('GET', 'artist/recording/track/realtime')
            ->willReturn(new \stdClass());

        $this->artistsAPI->getRealTimeStatistics('artist', 'track');
    }


    /**
     * @return void
     */
    public function testUpcomingReleases(): void
    {
        $response = [];
        $response['upcoming_releases'] = [
            ['release' => new \stdClass()],
            ['release' => new \stdClass()],
        ];

        $this->apiClient->expects(self::once())
            ->method('apiRequest')
            ->with('GET', 'artistId/catalog', 'https://generic.wg.spotify.com/upcoming-view-service/v1/artist/')
            ->willReturn($response);

        self::assertCount(2, $this->artistsAPI->getUpcomingReleases('artistId'));
    }
}
