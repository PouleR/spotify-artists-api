<?php declare(strict_types=1);

namespace PouleR\SpotifyArtistsAPI\Entity;

/**
 * Class EngagementStatistic
 */
class EngagementStatistic
{
    /**
     * @var int
     */
    private $listeners;

    /**
     * @var int
     */
    private $streams;

    /**
     * @var float
     */
    private $streamsByListener;

    /**
     * @var int
     */
    private $playlistAdds;

    /**
     * @var int
     */
    private $saves;

    /**
     * @var float
     */
    private $intentRate;

    /**
     * @return int
     */
    public function getListeners(): int
    {
        return $this->listeners;
    }

    /**
     * @param int $listeners
     *
     * @return EngagementStatistic
     */
    public function setListeners(int $listeners): EngagementStatistic
    {
        $this->listeners = $listeners;

        return $this;
    }

    /**
     * @return int
     */
    public function getStreams(): int
    {
        return $this->streams;
    }

    /**
     * @param int $streams
     *
     * @return EngagementStatistic
     */
    public function setStreams(int $streams): EngagementStatistic
    {
        $this->streams = $streams;

        return $this;
    }

    /**
     * @return float
     */
    public function getStreamsByListener(): float
    {
        return $this->streamsByListener;
    }

    /**
     * @param float $streamsByListener
     *
     * @return EngagementStatistic
     */
    public function setStreamsByListener(float $streamsByListener): EngagementStatistic
    {
        $this->streamsByListener = $streamsByListener;

        return $this;
    }

    /**
     * @return int
     */
    public function getPlaylistAdds(): int
    {
        return $this->playlistAdds;
    }

    /**
     * @param int $playlistAdds
     *
     * @return EngagementStatistic
     */
    public function setPlaylistAdds(int $playlistAdds): EngagementStatistic
    {
        $this->playlistAdds = $playlistAdds;

        return $this;
    }

    /**
     * @return int
     */
    public function getSaves(): int
    {
        return $this->saves;
    }

    /**
     * @param int $saves
     *
     * @return EngagementStatistic
     */
    public function setSaves(int $saves): EngagementStatistic
    {
        $this->saves = $saves;

        return $this;
    }

    /**
     * @return float
     */
    public function getIntentRate(): float
    {
        return $this->intentRate;
    }

    /**
     * @param float $intentRate
     *
     * @return EngagementStatistic
     */
    public function setIntentRate(float $intentRate): EngagementStatistic
    {
        $this->intentRate = $intentRate;

        return $this;
    }
}
