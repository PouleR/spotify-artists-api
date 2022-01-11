<?php declare(strict_types=1);

namespace PouleR\SpotifyArtistsAPI\Tests\Entity;

use PHPUnit\Framework\TestCase;
use PouleR\SpotifyArtistsAPI\Entity\PlaylistStatistics;

/**
 * Class PlaylistStatisticsTest
 */
class PlaylistStatisticsTest extends TestCase
{
    private PlaylistStatistics $playlistStatistics;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->playlistStatistics = new PlaylistStatistics();

        $playlistStatistic = new \stdClass();
        $playlistStatistic->author = 'unittest';
        $playlistStatistic->title = 'title';
        $playlistStatistic->streams = 1000;

        $this->playlistStatistics
            ->setData([$playlistStatistic])
            ->setPlaylistOverall(100);
    }

    /**
     * @return void
     */
    public function testData(): void
    {
        $data = $this->playlistStatistics->getData();
        self::assertCount(1, $data);
        self::assertEquals('unittest', $data[0]->getAuthor());
        self::assertEquals('title', $data[0]->getTitle());
        self::assertEquals(1000, $data[0]->getStreams());
    }

    /**
     * @return void
     */
    public function testPlaylistOverall(): void
    {
        self::assertEquals(100, $this->playlistStatistics->getPlaylistOverall());
    }
}
