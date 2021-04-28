<?php declare(strict_types=1);

namespace PouleR\SpotifyArtistsAPI\Entity;

/**
 * Class RecordingStatistic
 */
class RecordingStatistic
{
    /**
     * @var string
     */
    private $canonicalTrackGid = '';

    /**
     * @var int
     */
    private $numStreams = 0;

    /**
     * @var int
     */
    private $numCanvasViews = 0;

    /**
     * @var int
     */
    private $numListeners = 0;

    /**
     * @var int
     */
    private $numSavers = 0;

    /**
     * @var bool
     */
    private $hasLimitedRights = false;

    /**
     * @var bool
     */
    private $isDisabled = false;

    /**
     * @var string
     */
    private $pictureUri = '';

    /**
     * @var \DateTime
     */
    private $releaseDate;

    private $showSplitRightsBadge = false;

    private $trackName = '';

    private $trackUri = '';

    private $trend = 0;

    /**
     * @return string
     */
    public function getCanonicalTrackGid(): string
    {
        return $this->canonicalTrackGid;
    }

    /**
     * @param string $canonicalTrackGid
     *
     * @return RecordingStatistic
     */
    public function setCanonicalTrackGid(string $canonicalTrackGid): RecordingStatistic
    {
        $this->canonicalTrackGid = $canonicalTrackGid;

        return $this;
    }

    /**
     * @return int
     */
    public function getNumStreams(): int
    {
        return $this->numStreams;
    }

    /**
     * @param int $numStreams
     *
     * @return RecordingStatistic
     */
    public function setNumStreams(int $numStreams): RecordingStatistic
    {
        $this->numStreams = $numStreams;

        return $this;
    }

    /**
     * @return string
     */
    public function getPictureUri(): string
    {
        return $this->pictureUri;
    }

    /**
     * @param string $pictureUri
     *
     * @return RecordingStatistic
     */
    public function setPictureUri(string $pictureUri): RecordingStatistic
    {
        $this->pictureUri = $pictureUri;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getReleaseDate(): \DateTime
    {
        return $this->releaseDate;
    }

    /**
     * @param string $releaseDate
     *
     * @return RecordingStatistic
     *
     * @throws \Exception
     */
    public function setReleaseDate(string $releaseDate): RecordingStatistic
    {
        $this->releaseDate = new \DateTime($releaseDate);

        return $this;
    }

    /**
     * @return int
     */
    public function getNumCanvasViews(): int
    {
        return $this->numCanvasViews;
    }

    /**
     * @param int $numCanvasViews
     *
     * @return RecordingStatistic
     */
    public function setNumCanvasViews(int $numCanvasViews): RecordingStatistic
    {
        $this->numCanvasViews = $numCanvasViews;

        return $this;
    }

    /**
     * @return int
     */
    public function getNumListeners(): int
    {
        return $this->numListeners;
    }

    /**
     * @param int $numListeners
     *
     * @return RecordingStatistic
     */
    public function setNumListeners(int $numListeners): RecordingStatistic
    {
        $this->numListeners = $numListeners;

        return $this;
    }

    /**
     * @return int
     */
    public function getNumSavers(): int
    {
        return $this->numSavers;
    }

    /**
     * @param int $numSavers
     *
     * @return RecordingStatistic
     */
    public function setNumSavers(int $numSavers): RecordingStatistic
    {
        $this->numSavers = $numSavers;

        return $this;
    }

    /**
     * @return bool
     */
    public function isHasLimitedRights(): bool
    {
        return $this->hasLimitedRights;
    }

    /**
     * @param bool $hasLimitedRights
     *
     * @return RecordingStatistic
     */
    public function setHasLimitedRights(bool $hasLimitedRights): RecordingStatistic
    {
        $this->hasLimitedRights = $hasLimitedRights;

        return $this;
    }

    /**
     * @return bool
     */
    public function isDisabled(): bool
    {
        return $this->isDisabled;
    }

    /**
     * @param bool $isDisabled
     *
     * @return RecordingStatistic
     */
    public function setIsDisabled(bool $isDisabled): RecordingStatistic
    {
        $this->isDisabled = $isDisabled;

        return $this;
    }

    /**
     * @return bool
     */
    public function isShowSplitRightsBadge(): bool
    {
        return $this->showSplitRightsBadge;
    }

    /**
     * @param bool $showSplitRightsBadge
     *
     * @return RecordingStatistic
     */
    public function setShowSplitRightsBadge(bool $showSplitRightsBadge): RecordingStatistic
    {
        $this->showSplitRightsBadge = $showSplitRightsBadge;

        return $this;
    }

    /**
     * @return string
     */
    public function getTrackName(): string
    {
        return $this->trackName;
    }

    /**
     * @param string $trackName
     *
     * @return RecordingStatistic
     */
    public function setTrackName(string $trackName): RecordingStatistic
    {
        $this->trackName = $trackName;

        return $this;
    }

    /**
     * @return string
     */
    public function getTrackUri(): string
    {
        return $this->trackUri;
    }

    /**
     * @param string $trackUri
     *
     * @return RecordingStatistic
     */
    public function setTrackUri(string $trackUri): RecordingStatistic
    {
        $this->trackUri = $trackUri;

        return $this;
    }

    /**
     * @return int
     */
    public function getTrend(): int
    {
        return $this->trend;
    }

    /**
     * @param int $trend
     *
     * @return RecordingStatistic
     */
    public function setTrend(int $trend): RecordingStatistic
    {
        $this->trend = $trend;

        return $this;
    }
}
