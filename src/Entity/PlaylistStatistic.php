<?php declare(strict_types=1);

namespace PouleR\SpotifyArtistsAPI\Entity;

use DateTime;

/**
 * Class PlaylistStatistic
 */
class PlaylistStatistic
{
    private string $author = '';
    private DateTime $dateAdded;
    private int $followers = 0;
    private int $listeners = 0;
    private int $numTracks = 0;
    private int $streams = 0;
    private string $thumbnailUrl = '';
    private string $title = '';
    private string $uri = '';

    /**
     * @var RecordingStatistic[]
     */
    private array $trackStats = [];

    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * @param string $author
     *
     * @return PlaylistStatistic
     */
    public function setAuthor(string $author): PlaylistStatistic
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return DateTime
     */
    public function getDateAdded(): DateTime
    {
        return $this->dateAdded;
    }

    /**
     * @param DateTime $dateAdded
     *
     * @return PlaylistStatistic
     */
    public function setDateAdded(DateTime $dateAdded): PlaylistStatistic
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }

    /**
     * @return int
     */
    public function getFollowers(): int
    {
        return $this->followers;
    }

    /**
     * @param int $followers
     *
     * @return PlaylistStatistic
     */
    public function setFollowers(int $followers): PlaylistStatistic
    {
        $this->followers = $followers;

        return $this;
    }

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
     * @return PlaylistStatistic
     */
    public function setListeners(int $listeners): PlaylistStatistic
    {
        $this->listeners = $listeners;

        return $this;
    }

    /**
     * @return int
     */
    public function getNumTracks(): int
    {
        return $this->numTracks;
    }

    /**
     * @param int $numTracks
     *
     * @return PlaylistStatistic
     */
    public function setNumTracks(int $numTracks): PlaylistStatistic
    {
        $this->numTracks = $numTracks;

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
     * @return PlaylistStatistic
     */
    public function setStreams(int $streams): PlaylistStatistic
    {
        $this->streams = $streams;

        return $this;
    }

    /**
     * @return string
     */
    public function getThumbnailUrl(): string
    {
        return $this->thumbnailUrl;
    }

    /**
     * @param string $thumbnailUrl
     *
     * @return PlaylistStatistic
     */
    public function setThumbnailUrl(string $thumbnailUrl): PlaylistStatistic
    {
        $this->thumbnailUrl = $thumbnailUrl;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return PlaylistStatistic
     */
    public function setTitle(string $title): PlaylistStatistic
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * @param string $uri
     *
     * @return PlaylistStatistic
     */
    public function setUri(string $uri): PlaylistStatistic
    {
        $this->uri = $uri;
        return $this;
    }

    /**
     * @return RecordingStatistic[]
     */
    public function getTrackStats(): array
    {
        return $this->trackStats;
    }

    /**
     * @param RecordingStatistic[] $trackStats
     *
     * @return PlaylistStatistic
     */
    public function setTrackStats(array $trackStats): PlaylistStatistic
    {
        $this->trackStats = $trackStats;

        return $this;
    }
}
