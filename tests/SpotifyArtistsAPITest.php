<?php declare(strict_types=1);

namespace PouleR\SpotifyArtistsAPI\Tests;

use PHPUnit\Framework\MockObject\MockObject;
use PouleR\SpotifyArtistsAPI\SpotifyArtistsAPI;
use PouleR\SpotifyArtistsAPI\SpotifyArtistsAPIClient;
use PHPUnit\Framework\TestCase;

/**
 * Class SpotifyArtistsAPITest
 */
class SpotifyArtistsAPITest extends TestCase
{
    private SpotifyArtistsAPIClient|MockObject $apiClient;
    private SpotifyArtistsAPI $artistsAPI;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->apiClient = $this->createMock(SpotifyArtistsAPIClient::class);
        $this->artistsAPI = new SpotifyArtistsAPI($this->apiClient);
        $this->artistsAPI->setAccessToken('access.token');
    }

    /**
     * @return void
     */
    public function testRealTimeStatistics(): void
    {
        $this->apiClient->expects(self::once())
            ->method('apiRequest')
            ->with('GET', 'artist/recording/track/realtime')
            ->willReturn([]);

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
