<?php declare(strict_types=1);

namespace PouleR\SpotifyArtistsAPI\Entity;

/**
 * Class RealTimeStatistics
 */
class RealTimeStatistics
{
    private int $totalStreams = 0;
    private ?string $websocketUrl = null;

    /**
     * @return int
     */
    public function getTotalStreams(): int
    {
        return $this->totalStreams;
    }

    /**
     * @param int $totalStreams
     * @return RealTimeStatistics
     */
    public function setTotalStreams(int $totalStreams): RealTimeStatistics
    {
        $this->totalStreams = $totalStreams;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getWebsocketUrl(): ?string
    {
        return $this->websocketUrl;
    }

    /**
     * @param string|null $websocketUrl
     *
     * @return RealTimeStatistics
     */
    public function setWebsocketUrl(?string $websocketUrl): RealTimeStatistics
    {
        $this->websocketUrl = $websocketUrl;

        return $this;
    }
}
