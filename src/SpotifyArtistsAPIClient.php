<?php declare(strict_types=1);

namespace PouleR\SpotifyArtistsAPI;

use PouleR\SpotifyArtistsAPI\Exception\SpotifyArtistsAPIException;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

/**
 * Class SpotifyArtistsAPIClient
  */
class SpotifyArtistsAPIClient
{
    private const ARTISTS_API_URL = 'https://generic.wg.spotify.com/s4x-insights-api/v1/artist/';
    protected HttpClientInterface $httpClient;
    protected string $accessToken = '';

    /**
     * @param HttpClientInterface $httpClient
     */
    public function __construct(HttpClientInterface $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @param string $accessToken
     */
    public function setAccessToken(string $accessToken): void
    {
        $this->accessToken = $accessToken;
    }

    /**
     * @param string                                      $method
     * @param string                                      $service
     * @param string|null                                 $baseUrl
     * @param array                                       $headers
     * @param array|string|resource|\Traversable|\Closure $body
     *
     * @return object
     *
     * @throws SpotifyArtistsAPIException
     */
    public function apiRequest(string $method, string $service, string $baseUrl = null, array $headers = [], $body = null)
    {
        $requestUrl = sprintf('%s%s', empty($baseUrl) ? self::ARTISTS_API_URL : $baseUrl, $service);

        try {
            $headers = array_merge($headers, $this->getDefaultHeaders());
            $response = $this->httpClient->request($method, $requestUrl, ['headers' => $headers, 'body' => $body]);

            return json_decode($response->getContent(), true);
        } catch (ServerExceptionInterface | ClientExceptionInterface | RedirectionExceptionInterface | TransportExceptionInterface | \Exception $exception) {
            throw new SpotifyArtistsAPIException(
                'API request: (' . $service . '), ' . $exception->getMessage(),
                $exception->getCode()
            );
        }
    }

    /**
     * @return string[]
     */
    private function getDefaultHeaders(): array
    {
        return [
            'Authorization' => 'Bearer ' . $this->accessToken,
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];
    }
}
