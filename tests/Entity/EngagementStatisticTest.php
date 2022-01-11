<?php declare(strict_types=1);

namespace PouleR\SpotifyArtistsAPI\Tests\Entity;

use PouleR\SpotifyArtistsAPI\Entity\EngagementStatistic;
use PHPUnit\Framework\TestCase;

/**
 * Class EngagementStatisticTest
 */
class EngagementStatisticTest extends TestCase
{
    private EngagementStatistic $engagementStatistic;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->engagementStatistic = new EngagementStatistic();
        $this->engagementStatistic
            ->setIntentRate(1.2)
            ->setListeners(500)
            ->setPlaylistAdds(3)
            ->setSaves(2)
            ->setStreams(100000)
            ->setStreamsByListener(5.3);
    }

    /**
     * @return void
     */
    public function testIntentRate(): void
    {
        self::assertEquals(1.2, $this->engagementStatistic->getIntentRate());
    }

    /**
     * @return void
     */
    public function testListeners(): void
    {
        self::assertEquals(500, $this->engagementStatistic->getListeners());
    }

    /**
     * @return void
     */
    public function testPlaylistAdds(): void
    {
        self::assertEquals(3, $this->engagementStatistic->getPlaylistAdds());
    }

    /**
     * @return void
     */
    public function testStreams(): void
    {
        self::assertEquals(100000, $this->engagementStatistic->getStreams());
    }

    /**
     * @return void
     */
    public function testSaves(): void
    {
        self::assertEquals(2, $this->engagementStatistic->getSaves());
    }

    /**
     * @return void
     */
    public function testStreamsByListener(): void
    {
        self::assertEquals(5.3, $this->engagementStatistic->getStreamsByListener());
    }
}
