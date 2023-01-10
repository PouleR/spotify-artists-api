<?php declare(strict_types=1);

namespace PouleR\SpotifyArtistsAPI\Tests\Entity;

use PHPUnit\Framework\TestCase;
use PouleR\SpotifyArtistsAPI\Entity\FanaticReleaseEngagement;

/**
 * Class FanaticReleaseEngagementTest
 */
class FanaticReleaseEngagementTest extends TestCase
{
    private FanaticReleaseEngagement $fanaticReleaseEngagement;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->fanaticReleaseEngagement = new FanaticReleaseEngagement();

        $metrics = [
            'date' => '2023-01-01',
            'day' => 6,
            'followersStreamers' => 12,
        ];

        $this->fanaticReleaseEngagement
            ->setArtistId('12345')
            ->setAlbumId('67890')
            ->setFollowersBeforeRelease(100)
            ->setMetricTimeline([$metrics, $metrics])
            ->setMostRecentMetrics($metrics)
        ;
    }

    /**
     * @return void
     */
    public function testArtistId(): void
    {
        self::assertSame('12345', $this->fanaticReleaseEngagement->getArtistId());
    }

    /**
     * @return void
     */
    public function testAlbumId(): void
    {
        self::assertSame('67890', $this->fanaticReleaseEngagement->getAlbumId());
    }

    /**
     * @return void
     */
    public function testFollowersBeforeRelease(): void
    {
        self::assertSame(100, $this->fanaticReleaseEngagement->getFollowersBeforeRelease());
    }

    /**
     * @return void
     */
    public function testMetricTimeline(): void
    {
        $metricTimeline = $this->fanaticReleaseEngagement->getMetricTimeline();
        self::assertCount(2, $metricTimeline);

        self::assertSame(12, $metricTimeline[0]->getFollowersStreamers());
        self::assertSame(6, $metricTimeline[1]->getDay());
    }

    /**
     * @return void
     */
    public function testMostRecentMetrics(): void
    {
        $mostRecent = $this->fanaticReleaseEngagement->getMostRecentMetrics();
        self::assertEquals(new \DateTime('2023-01-01'), $mostRecent->getDate());
        self::assertSame(6, $mostRecent->getDay());
        self::assertSame(12, $mostRecent->getFollowersStreamers());
    }
}
