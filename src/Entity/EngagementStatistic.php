<?php declare(strict_types=1);

namespace PouleR\SpotifyArtistsAPI\Entity;

/**
 * Class EngagementStatistic
 */
class EngagementStatistic
{
    private ?int  $listeners = null;
    private ?int $streams = null;
    private ?float $streamsByListener = null;
    private ?int $playlistAdds = null;
    private ?int $saves = null;
    private ?float $intentRate = null;

    /**
     * @return int|null
     */
    public function getListeners(): ?int
    {
        return $this->listeners;
    }

    /**
     * @param int|null $listeners
     *
     * @return EngagementStatistic
     */
    public function setListeners(?int $listeners): EngagementStatistic
    {
        $this->listeners = $listeners;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getStreams(): ?int
    {
        return $this->streams;
    }

    /**
     * @param int|null $streams
     *
     * @return EngagementStatistic
     */
    public function setStreams(?int $streams): EngagementStatistic
    {
        $this->streams = $streams;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getStreamsByListener(): ?float
    {
        return $this->streamsByListener;
    }

    /**
     * @param float|null $streamsByListener
     *
     * @return EngagementStatistic
     */
    public function setStreamsByListener(?float $streamsByListener): EngagementStatistic
    {
        $this->streamsByListener = $streamsByListener;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getPlaylistAdds(): ?int
    {
        return $this->playlistAdds;
    }

    /**
     * @param int|null $playlistAdds
     *
     * @return EngagementStatistic
     */
    public function setPlaylistAdds(?int $playlistAdds): EngagementStatistic
    {
        $this->playlistAdds = $playlistAdds;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getSaves(): ?int
    {
        return $this->saves;
    }

    /**
     * @param int|null $saves
     *
     * @return EngagementStatistic
     */
    public function setSaves(?int $saves): EngagementStatistic
    {
        $this->saves = $saves;

        return $this;
    }

    /**
     * @return float|null
     */
    public function getIntentRate(): ?float
    {
        return $this->intentRate;
    }

    /**
     * @param float|null $intentRate
     *
     * @return EngagementStatistic
     */
    public function setIntentRate(?float $intentRate): EngagementStatistic
    {
        $this->intentRate = $intentRate;

        return $this;
    }
}
