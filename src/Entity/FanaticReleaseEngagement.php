<?php declare(strict_types=1);

namespace PouleR\SpotifyArtistsAPI\Entity;

use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

/**
 * Class FanaticReleaseEngagement
 */
class FanaticReleaseEngagement
{
    private ?string $albumId = null;
    private ?string $artistId = null;
    private ?int $followersBeforeRelease = null;

    private ?EngagementMetric $mostRecentMetrics = null;

    /** @var array EngagementMetric */
    private array $metricTimeline = [];

    /**
     * @return string|null
     */
    public function getAlbumId(): ?string
    {
        return $this->albumId;
    }

    /**
     * @param string|null $albumId
     *
     * @return FanaticReleaseEngagement
     */
    public function setAlbumId(?string $albumId): FanaticReleaseEngagement
    {
        $this->albumId = $albumId;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getArtistId(): ?string
    {
        return $this->artistId;
    }

    /**
     * @param string|null $artistId
     *
     * @return FanaticReleaseEngagement
     */
    public function setArtistId(?string $artistId): FanaticReleaseEngagement
    {
        $this->artistId = $artistId;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getFollowersBeforeRelease(): ?int
    {
        return $this->followersBeforeRelease;
    }

    /**
     * @param int|null $followersBeforeRelease
     *
     * @return FanaticReleaseEngagement
     */
    public function setFollowersBeforeRelease(?int $followersBeforeRelease): FanaticReleaseEngagement
    {
        $this->followersBeforeRelease = $followersBeforeRelease;

        return $this;
    }

    /**
     * @return EngagementMetric|null
     */
    public function getMostRecentMetrics(): ?EngagementMetric
    {
        return $this->mostRecentMetrics;
    }

    /**
     * @param array $mostRecentMetrics
     *
     * @return FanaticReleaseEngagement
     */
    public function setMostRecentMetrics(array $mostRecentMetrics): FanaticReleaseEngagement
    {
        $normalizer = new ObjectNormalizer(null, new CamelCaseToSnakeCaseNameConverter());
        $this->mostRecentMetrics = $normalizer->denormalize($mostRecentMetrics, EngagementMetric::class);

        return $this;
    }

    /**
     * @return EngagementMetric[]
     */
    public function getMetricTimeline(): array
    {
        return $this->metricTimeline;
    }

    /**
     * @param array $metricTimeline
     *
     * @return FanaticReleaseEngagement
     */
    public function setMetricTimeline(array $metricTimeline): FanaticReleaseEngagement
    {
        $normalizer = new ObjectNormalizer(null, new CamelCaseToSnakeCaseNameConverter());

        foreach ($metricTimeline as $metric) {
            $this->metricTimeline[] = $normalizer->denormalize($metric, EngagementMetric::class);
        }

        return $this;
    }
}
