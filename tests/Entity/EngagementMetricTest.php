<?php declare(strict_types=1);

namespace PouleR\SpotifyArtistsAPI\Tests\Entity;

use PouleR\SpotifyArtistsAPI\Entity\EngagementMetric;
use PHPUnit\Framework\TestCase;

/**
 * Class EngagementMetricTest
 */
class EngagementMetricTest extends TestCase
{
    private EngagementMetric $engagementMetric;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->engagementMetric = new EngagementMetric();
        $this->engagementMetric
            ->setDay(4)
            ->setDate('2023-01-01')
            ->setFollowersStreamers(500);
    }

    /**
     * @return void
     */
    public function testDay(): void
    {
        self::assertSame(4, $this->engagementMetric->getDay());
    }

    /**
     * @return void
     */
    public function testDate(): void
    {
        self::assertEquals(new \DateTime('2023-01-01'), $this->engagementMetric->getDate());
    }

    /**
     * @return void
     */
    public function testFollowersStreamers(): void
    {
        self::assertSame(500, $this->engagementMetric->getFollowersStreamers());
    }
}
