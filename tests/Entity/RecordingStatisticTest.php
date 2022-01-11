<?php declare(strict_types=1);

namespace PouleR\SpotifyArtistsAPI\Tests\Entity;

use PHPUnit\Framework\TestCase;
use PouleR\SpotifyArtistsAPI\Entity\RecordingStatistic;

/**
 * Class RecordingStatisticTest
 */
class RecordingStatisticTest extends TestCase
{
    private RecordingStatistic $recordingStatistic;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->recordingStatistic = new RecordingStatistic();
        $this->recordingStatistic
            ->setReleaseDate('2022-02-01')
            ->setCanonicalTrackGid('track.gid')
            ->setHasLimitedRights(true)
            ->setIsDisabled(false)
            ->setNumCanvasViews(100)
            ->setNumListeners(50)
            ->setNumSavers(10)
            ->setNumStreams(1000)
            ->setPictureUri('picture.uri')
            ->setShowSplitRightsBadge(true)
            ->setTrackName('unittest')
            ->setTrackUri('track.uri')
            ->setTrend(1);
    }

    /**
     * @return void
     */
    public function testReleaseDate(): void
    {
        self::assertInstanceOf(\DateTime::class, $this->recordingStatistic->getReleaseDate());
        self::assertEquals(new \DateTime('2022-02-01'), $this->recordingStatistic->getReleaseDate());
    }

    /**
     * @return void
     */
    public function testCanonicalTrackGid(): void
    {
        self::assertEquals('track.gid', $this->recordingStatistic->getCanonicalTrackGid());
    }

    /**
     * @return void
     */
    public function testHasLimitedRights(): void
    {
        self::assertTrue($this->recordingStatistic->isHasLimitedRights());
    }

    /**
     * @return void
     */
    public function testDisabled(): void
    {
        self::assertFalse($this->recordingStatistic->isDisabled());
    }

    /**
     * @return void
     */
    public function testNumCanvasViews(): void
    {
        self::assertEquals(100, $this->recordingStatistic->getNumCanvasViews());
    }

    /**
     * @return void
     */
    public function testNumListeners(): void
    {
        self::assertEquals(50, $this->recordingStatistic->getNumListeners());
    }

    /**
     * @return void
     */
    public function testNumSavers(): void
    {
        self::assertEquals(10, $this->recordingStatistic->getNumSavers());
    }

    /**
     * @return void
     */
    public function testNumStreams(): void
    {
        self::assertEquals(1000, $this->recordingStatistic->getNumStreams());
    }

    /**
     * @return void
     */
    public function testPictureUri(): void
    {
        self::assertEquals('picture.uri', $this->recordingStatistic->getPictureUri());
    }

    /**
     * @return void
     */
    public function testShowSplitRightsBadge(): void
    {
        self::assertTrue($this->recordingStatistic->isShowSplitRightsBadge());
    }

    /**
     * @return void
     */
    public function testTrackName(): void
    {
        self::assertEquals('unittest', $this->recordingStatistic->getTrackName());
    }

    /**
     * @return void
     */
    public function testTrackUri(): void
    {
        self::assertEquals('track.uri', $this->recordingStatistic->getTrackUri());
    }

    /**
     * @return void
     */
    public function testTrend(): void
    {
        self::assertEquals(1, $this->recordingStatistic->getTrend());
    }
}
