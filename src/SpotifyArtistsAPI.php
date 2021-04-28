<?php declare(strict_types=1);

namespace PouleR\SpotifyArtistsAPI;

use Google\Protobuf\Duration;
use PouleR\SpotifyArtistsAPI\Entity\AccessToken;
use PouleR\SpotifyArtistsAPI\Entity\RealTimeStatistics;
use PouleR\SpotifyArtistsAPI\Entity\RecordingStatistic;
use PouleR\SpotifyArtistsAPI\Entity\UpcomingRelease;
use PouleR\SpotifyArtistsAPI\Exception\SpotifyArtistsAPIException;
use PouleR\SpotifyArtistsAPI\Util\HexUtils;
use Psr\Log\LoggerInterface;
use Psr\Log\NullLogger;
use Spotify\Login5\V3\Challenge;
use Spotify\Login5\V3\Challenges\HashcashSolution;
use Spotify\Login5\V3\ChallengeSolution;
use Spotify\Login5\V3\ChallengeSolutions;
use Spotify\Login5\V3\ClientInfo;
use Spotify\Login5\V3\Credentials\Password;
use Spotify\Login5\V3\Credentials\StoredCredential;
use Spotify\Login5\V3\LoginRequest;
use Spotify\Login5\V3\LoginResponse;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

/**
 * Class SpotifyArtistsAPI
 */
class SpotifyArtistsAPI
{
    /**
     * @var string
     */
    private $clientId = '';

    /**
     * @var string
     */
    private $deviceId = '';

    /**
     * @var SpotifyArtistsAPIClient
     */
    protected $client;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var ObjectNormalizer
     */
    protected $normalizer;

    /**
     * @param SpotifyArtistsAPIClient $client
     * @param LoggerInterface|null    $logger
     */
    public function __construct(SpotifyArtistsAPIClient $client, LoggerInterface $logger = null)
    {
        $this->client = $client;
        $this->logger = $logger;

        if (!$this->logger) {
            $this->logger = new NullLogger();
        }

        $this->normalizer = new ObjectNormalizer(null, new CamelCaseToSnakeCaseNameConverter());
    }

    /**
     * @param string $clientId
     */
    public function setClientId(string $clientId): void
    {
        $this->clientId = $clientId;
    }

    /**
     * @param string $deviceId
     */
    public function setDeviceId(string $deviceId): void
    {
        $this->deviceId = $deviceId;
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
        } catch (\Exception | \Throwable $exception) {
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

            foreach ($response['upcoming_releases'] as $upcoming) {
                if (!$upcoming['release']) {
                    continue;
                }

                $upcomingReleases[] = $this->normalizer->denormalize($upcoming['release'], UpcomingRelease::class);
            }
        } catch (\Exception | \Throwable $exception) {
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

        $recordingStats = [];
        try {
            $path = sprintf('%s/recordings?aggregation-level=recording&time-filter=%s', $artistId, $timeFilter);
            $response = $this->client->apiRequest(
                'GET',
                $path,
                'https://generic.wg.spotify.com/s4x-insights-api/v2/artist/'
            );

            foreach ($response['recordingStats'] as $recording) {
                if (!$recording) {
                    continue;
                }

                $recordingStats[] = $this->normalizer->denormalize($recording, RecordingStatistic::class);
            }
        } catch (\Exception | \Throwable $exception) {
            $this->logError(__FUNCTION__, $exception);
        }


        return $recordingStats;
    }

    /**
     * @param string $username
     * @param string $refreshToken
     *
     * @return AccessToken
     *
     * @throws SpotifyArtistsAPIException
     */
    public function refreshToken(string $username, string $refreshToken): AccessToken
    {
        $clientInfo = new ClientInfo();
        $clientInfo->setClientId($this->clientId);
        $clientInfo->setDeviceId($this->deviceId);

        $storedCredential = new StoredCredential();
        $storedCredential->setUsername($username);
        $storedCredential->setData($refreshToken);

        $loginRequest = new LoginRequest();
        $loginRequest->setClientInfo($clientInfo);
        $loginRequest->setStoredCredential($storedCredential);

        $loginResponse = $this->client->loginRequest($loginRequest);

        return $this->createAccessToken($loginResponse->getOk());
    }

    /**
     * @param string $username
     * @param string $password
     *
     * @return AccessToken
     *
     * @throws SpotifyArtistsAPIException
     */
    public function login(string $username, string $password): AccessToken
    {
        $clientInfo = new ClientInfo();
        $clientInfo->setClientId($this->clientId);
        $clientInfo->setDeviceId($this->deviceId);

        $spotifyPassword = new Password();
        $spotifyPassword->setId($username);
        $spotifyPassword->setPassword($password);
        $spotifyPassword->setPadding(hex2bin('151515151515151515151515151515151515151515'));

        $loginRequest = new LoginRequest();
        $loginRequest->setClientInfo($clientInfo);
        $loginRequest->setPassword($spotifyPassword);

        // Log in and get the loginContext and hashCash
        $loginResponse = $this->client->loginRequest($loginRequest);
        $challengeSolutions = $this->solveHashCashChallenge($loginResponse);

        $loginRequest->setLoginContext($loginResponse->getLoginContext());
        $loginRequest->setChallengeSolutions($challengeSolutions);

        // Send challengeSolutions and get access token
        $loginResponse = $this->client->loginRequest($loginRequest);

        return $this->createAccessToken($loginResponse->getOk());
    }

    /**
     * @param LoginResponse $loginResponse
     *
     * @return ChallengeSolutions
     *
     * @throws \Exception
     */
    private function solveHashCashChallenge(LoginResponse $loginResponse): ChallengeSolutions
    {
        /** @var Challenge $hashCashChallenge */
        $hashCashChallenge = $loginResponse->getChallenges()->getChallenges()[0];
        $hashCash = $hashCashChallenge->getHashcash();

        $spotifyLogin = new SpotifyLogin();
        $solvedChallenge = $spotifyLogin->solveChallenge(
            $loginResponse->getLoginContext(),
            $hashCash->getPrefix(),
            $hashCash->getLength()
        );

        $hashCashSolution = new HashcashSolution();
        $hashCashSolution->setSuffix(hex2bin(HexUtils::byteArray2Hex($solvedChallenge->getSuffix())));

        $duration = new Duration();
        $duration
            ->setNanos(($solvedChallenge->getDuration() % 1000000000))
            ->setSeconds((int)($solvedChallenge->getDuration() / 1000000000));
        $hashCashSolution->setDuration($duration);

        $challengeSolution = new ChallengeSolution();
        $challengeSolution->setHashcash($hashCashSolution);

        $challengeSolutions = new ChallengeSolutions();
        $challengeSolutions->setSolutions([$challengeSolution]);

        return $challengeSolutions;
    }

    /**
     * @param string     $method
     * @param \Exception $exception
     */
    private function logError(string $method, \Exception $exception)
    {
        $this->logger->error('Error during API Request', [
            'method' => $method,
            'message' => $exception->getMessage(),
            'code' => $exception->getCode(),
        ]);
    }

    /**
     * @param \Spotify\Login5\V3\LoginOk|null $okResponse
     * @return AccessToken
     */
    private function createAccessToken(?\Spotify\Login5\V3\LoginOk $okResponse): AccessToken
    {
        $spotifyAccessToken = new AccessToken();

        return $spotifyAccessToken
            ->setAccessToken($okResponse->getAccessToken())
            ->setExpiresIn($okResponse->getAccessTokenExpiresIn())
            ->setRefreshToken($okResponse->getStoredCredential())
            ->setUsername($okResponse->getUsername());
    }
}
