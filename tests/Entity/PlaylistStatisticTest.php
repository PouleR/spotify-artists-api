<?php declare(strict_types=1);

namespace PouleR\SpotifyArtistsAPI\Tests\Entity;

use PHPUnit\Framework\TestCase;
use PouleR\SpotifyArtistsAPI\Entity\PlaylistStatistic;

/**
 * Class PlaylistStatisticTest
 */
class PlaylistStatisticTest extends TestCase
{
    private PlaylistStatistic $playlistStatistic;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->playlistStatistic = new PlaylistStatistic();
        $recordingStats = new \stdClass();
        $recordingStats->trackUri = 'track.uri';

        $this->playlistStatistic
            ->setNumTracks(200)
            ->setStreams(1000)
            ->setListeners(10)
            ->setAuthor('unittest')
            ->setDateAdded('2022-02-03')
            ->setFollowers(100)
            ->setIsAlgotorial(true)
            ->setThumbnailUrl('https://thumb.url')
            ->setTitle('title')
            ->setTrackStats([$recordingStats])
            ->setUri('uri');
    }

    /**
     * @return void
     */
    public function testNumTracks(): void
    {
        self::assertEquals(200, $this->playlistStatistic->getNumTracks());
    }

    /**
     * @return void
     */
    public function testStreams(): void
    {
        self::assertEquals(1000, $this->playlistStatistic->getStreams());
    }

    /**
     * @return void
     */
    public function testListeners(): void
    {
        self::assertEquals(10, $this->playlistStatistic->getListeners());
    }

    /**
     * @return void
     */
    public function testAuthor(): void
    {
        self::assertEquals('unittest', $this->playlistStatistic->getAuthor());
    }

    /**
     * @return void
     */
    public function testDateAdded(): void
    {
        self::assertEquals(new \DateTime('2022-02-03'), $this->playlistStatistic->getDateAdded());
    }

    /**
     * @return void
     */
    public function testFollowers(): void
    {
        self::assertEquals(100, $this->playlistStatistic->getFollowers());
    }

    /**
     * @return void
     */
    public function testIsAlgotorial(): void
    {
        self::assertTrue($this->playlistStatistic->getIsAlgotorial());
    }

    /**
     * @return void
     */
    public function testThumbnailUrl(): void
    {
        self::assertEquals('https://thumb.url', $this->playlistStatistic->getThumbnailUrl());
    }

    /**
     * @return void
     */
    public function testTrackStats(): void
    {
        $stats = $this->playlistStatistic->getTrackStats();
        self::assertCount(1, $stats);
        self::assertEquals('track.uri', $stats[0]->getTrackUri());
    }

    /**
     * @return void
     */
    public function testUri(): void
    {
        self::assertEquals('uri', $this->playlistStatistic->getUri());
    }
}
