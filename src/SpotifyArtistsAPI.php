<?php declare(strict_types=1);

namespace PouleR\SpotifyArtistsAPI;

use Exception;
use PouleR\SpotifyArtistsAPI\Entity\EngagementStatistic;
use PouleR\SpotifyArtistsAPI\Entity\PlaylistStatistics;
use PouleR\SpotifyArtistsAPI\Entity\RealTimeStatistics;
use PouleR\SpotifyArtistsAPI\Entity\RecordingStatistic;
use PouleR\SpotifyArtistsAPI\Entity\UpcomingRelease;
use PouleR\SpotifyArtistsAPI\Exception\SpotifyArtistsAPIException;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Throwable;

/**
 * Class SpotifyArtistsAPI
 */
class SpotifyArtistsAPI
{
    protected SpotifyArtistsAPIClient $client;
    protected ?LoggerInterface $logger = null;
    protected ObjectNormalizer $normalizer;

    /**
     * @param SpotifyArtistsAPIClient $client
     * @param LoggerInterface|null    $logger
     */
    public function __construct(SpotifyArtistsAPIClient $client, LoggerInterface $logger = null)
    {
        $this->client = $client;
        $this->logger = $logger;

        if (!$logger) {
            $this->logger = new NullLogger();
        }

        $this->normalizer = new ObjectNormalizer(null, new CamelCaseToSnakeCaseNameConverter());
    }

    /**
     * @param string $accessToken
     */
    public function setAccessToken(string $accessToken): void
    {
        $this->client->setAccessToken($accessToken);
    }

    /**
     * @param string $artistId
     * @param string $trackId
     *
     * @return RealTimeStatistics|null
     */
    public function getRealTimeStatistics(string $artistId, string $trackId): ?RealTimeStatistics
    {
        try {
            $url = sprintf('%s/recording/%s/realtime', $artistId, $trackId);
            $response = $this->client->apiRequest('GET', $url);

            return $this->normalizer->denormalize($response, RealTimeStatistics::class);
        } catch (Exception | Throwable $exception) {
            $this->logError(__FUNCTION__, $exception);
        }

        return null;
    }

    /**
     * @param string $artistId
     *
     * @return UpcomingRelease[]
     */
    public function getUpcomingReleases(string $artistId): array
    {
        $upcomingReleases = [];

        try {
            $path = sprintf('%s/catalog', $artistId);
            $response = $this->client->apiRequest(
                'GET',
                $path,
                'https://generic.wg.spotify.com/upcoming-view-service/v1/artist/'
            );

            if (!array_key_exists('upcoming_releases', $response)) {
                return [];
            }

            foreach ($response['upcoming_releases'] as $upcoming) {
                if (!$upcoming['release']) {
                    continue;
                }

                $upcomingReleases[] = $this->normalizer->denormalize($upcoming['release'], UpcomingRelease::class);
            }
        } catch (Exception | Throwable $exception) {
            $this->logError(__FUNCTION__, $exception);
        }

        return $upcomingReleases;
    }

    /**
     * @param string $artistId
     * @param string $timeFilter
     *
     * @return RecordingStatistic[]
     *
     * @throws SpotifyArtistsAPIException
     */
    public function getRecordingStatistics(string $artistId, string $timeFilter = 'all'): array
    {
        $recordingStats = [];
        $this->validateTimeFilter($timeFilter);

        try {
            $path = sprintf('%s/recordings?aggregation-level=recording&time-filter=%s', $artistId, $timeFilter);
            $response = $this->client->apiRequest(
                'GET',
                $path,
                'https://generic.wg.spotify.com/s4x-insights-api/v2/artist/'
            );

            if (!array_key_exists('recordingStats', $response)) {
                return [];
            }

            foreach ($response['recordingStats'] as $recording) {
                if (!$recording) {
                    continue;
                }

                $recordingStats[] = $this->normalizer->denormalize($recording, RecordingStatistic::class);
            }
        } catch (Exception | Throwable $exception) {
            $this->logError(__FUNCTION__, $exception);
        }

        return $recordingStats;
    }

    /**
     * @param string $artistId
     * @param string $countryCode
     * @param string $timeFilter
     *
     * @return EngagementStatistic|null
     */
    public function getEngagementStatistics(string $artistId, string $countryCode = '', string $timeFilter = '28day'): ?EngagementStatistic
    {
        try {
            $path = sprintf('%s/stats?time-filter=%s', $artistId, $timeFilter);
            if (!empty($countryCode)) {
                $path .= sprintf('&country=%s', $countryCode);
            }

            $response = $this->client->apiRequest('GET', $path);

            return $this->normalizer->denormalize($response, EngagementStatistic::class);
        } catch (Exception | Throwable $exception) {
            $this->logError(__FUNCTION__, $exception);
        }

        return null;
    }

    /**
     * @param string $artistId
     * @param string $playlistType
     * @param string $timeFilter
     *
     * @return null|PlaylistStatistics
     *
     * @throws SpotifyArtistsAPIException
     */
    public function getPlaylistStatistics(string $artistId, string $playlistType, string $timeFilter = '7day'): ?PlaylistStatistics
    {
        $allowedPlaylistTypes = [
            'personalized', // Algorithmic
            'curated', // Editorial
            'listener',
        ];

        if (!in_array($playlistType, $allowedPlaylistTypes)) {
            throw new SpotifyArtistsAPIException('Invalid playlist type given: ' . $playlistType);
        }

        $this->validateTimeFilter($timeFilter);

        try {
            $path = sprintf('%s/playlists/%s?time-filter=%s', $artistId, $playlistType, $timeFilter);
            $response = $this->client->apiRequest('GET', $path);

            return $this->normalizer->denormalize($response, PlaylistStatistics::class);
        } catch (Exception | Throwable $exception) {
            $this->logError(__FUNCTION__, $exception);
        }

        return null;
    }

    /**
     * @param string $artistId
     * @param string $trackId
     * @param string $timeFilter
     *
     * @return PlaylistStatistics|null
     *
     * @throws SpotifyArtistsAPIException
     */
    public function getRecentPlaylistAdditions(string $artistId, string $trackId, string $timeFilter = '7day'): ?PlaylistStatistics
    {
        $this->validateTimeFilter($timeFilter);

        try {
            $path = sprintf('%s/recording/%s/recent-playlists?time-filter=%s&aggregation-level=recording', $artistId, $trackId, $timeFilter);
            $response = $this->client->apiRequest('GET', $path);

            return $this->normalizer->denormalize($response, PlaylistStatistics::class);
        } catch (Exception | Throwable $exception) {
            $this->logError(__FUNCTION__, $exception);
        }

        return null;
    }

    /**
     * @param string $artistId
     * @param string $trackId
     * @param string $timeFilter
     *
     * @return PlaylistStatistics|null
     *
     * @throws SpotifyArtistsAPIException
     */
    public function getTopPlaylists(string $artistId, string $trackId, string $timeFilter = '28day'): ?PlaylistStatistics
    {
        $this->validateTimeFilter($timeFilter);

        try {
            $path = sprintf('%s/recording/%s/top-playlists?time-filter=%s&aggregation-level=recording', $artistId, $trackId, $timeFilter);
            $response = $this->client->apiRequest('GET', $path);

            return $this->normalizer->denormalize($response, PlaylistStatistics::class);
        } catch (Exception | Throwable $exception) {
            $this->logError(__FUNCTION__, $exception);
        }

        return null;
    }

    /**
     * @param string $artistId
     *
     * @return string
     */
    public function getRealtimeArtistListenersUrl(string $artistId): string
    {
        return sprintf('wss://artistinsights-realtime3.spotify.com/ws/artist/listeners/%s', $artistId);
    }

    /**
     * @param string     $method
     * @param Throwable $exception
     */
    private function logError(string $method, Throwable $exception)
    {
        $this->logger->error('Error during API Request', [
            'method' => $method,
            'message' => $exception->getMessage(),
            'code' => $exception->getCode(),
        ]);
    }

    /**
     * @param string $timeFilter
     *
     * @throws SpotifyArtistsAPIException
     */
    private function validateTimeFilter(string $timeFilter): void
    {
        $allowedTimeFilters = [
            '1day',
            '7day',
            '28day',
            'last5years',
            'all'
        ];

        if (!in_array($timeFilter, $allowedTimeFilters)) {
            throw new SpotifyArtistsAPIException('Invalid time filter given: ' . $timeFilter);
        }
    }
}
