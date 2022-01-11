<?php declare(strict_types=1);

namespace PouleR\SpotifyArtistsAPI\Tests\Entity;

use PHPUnit\Framework\TestCase;
use PouleR\SpotifyArtistsAPI\Entity\RealTimeStatistics;

/**
 * Class RealTimeStatisticsTest
 */
class RealTimeStatisticsTest extends TestCase
{
    private RealTimeStatistics $realTimeStatistics;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->realTimeStatistics = new RealTimeStatistics();
        $this->realTimeStatistics
            ->setTotalStreams(50000)
            ->setWebsocketUrl('wss://socket.url');
    }

    /**
     * @return void
     */
    public function testTotalStreams(): void
    {
        self::assertEquals(50000, $this->realTimeStatistics->getTotalStreams());
    }

    /**
     * @return void
     */
    public function testWebsocketUrl(): void
    {
        self::assertEquals('wss://socket.url', $this->realTimeStatistics->getWebsocketUrl());
    }
}
