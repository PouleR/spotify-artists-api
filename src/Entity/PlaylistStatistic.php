<?php declare(strict_types=1);

namespace PouleR\SpotifyArtistsAPI\Entity;

use DateTime;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

/**
 * Class PlaylistStatistic
 */
class PlaylistStatistic
{
    private string $author = '';
    private ?DateTime $dateAdded = null;
    private ?int $followers = null;
    private ?int $listeners = null;
    private ?int $numTracks = null;
    private ?int $streams = null;
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
     * @return DateTime|null
     */
    public function getDateAdded(): ?DateTime
    {
        return $this->dateAdded;
    }

    /**
     * @param string $dateAdded
     *
     * @return PlaylistStatistic
     *
     * @throws \Exception
     */
    public function setDateAdded(string $dateAdded): PlaylistStatistic
    {
        $this->dateAdded = new DateTime($dateAdded);

        return $this;
    }

    /**
     * @return int|null
     */
    public function getFollowers(): ?int
    {
        return $this->followers;
    }

    /**
     * @param int|null $followers
     *
     * @return PlaylistStatistic
     */
    public function setFollowers(?int $followers): PlaylistStatistic
    {
        $this->followers = $followers;

        return $this;
    }

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
     * @return PlaylistStatistic
     */
    public function setListeners(?int $listeners): PlaylistStatistic
    {
        $this->listeners = $listeners;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getNumTracks(): ?int
    {
        return $this->numTracks;
    }

    /**
     * @param int|null $numTracks
     *
     * @return PlaylistStatistic
     */
    public function setNumTracks(?int $numTracks): PlaylistStatistic
    {
        $this->numTracks = $numTracks;

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
     * @return PlaylistStatistic
     */
    public function setStreams(?int $streams): PlaylistStatistic
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
        $normalizer = new ObjectNormalizer(null, new CamelCaseToSnakeCaseNameConverter());

        foreach ($trackStats as $recordingStatistic) {
            $this->trackStats[] = $normalizer->denormalize($recordingStatistic, RecordingStatistic::class);
        }

        return $this;
    }
}
