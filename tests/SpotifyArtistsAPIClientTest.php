<?php

namespace PouleR\SpotifyArtistsAPI\Tests;

use PHPUnit\Framework\MockObject\MockObject;
use PouleR\SpotifyArtistsAPI\Exception\SpotifyArtistsAPIException;
use PouleR\SpotifyArtistsAPI\SpotifyArtistsAPIClient;
use PHPUnit\Framework\TestCase;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;

/**
 * Class SpotifyArtistsAPIClientTest
 */
class SpotifyArtistsAPIClientTest extends TestCase
{
    /**
     * @var MockObject|HttpClientInterface
     */
    private $httpClient;
    private SpotifyArtistsAPIClient $apiClient;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->httpClient = $this->createMock(HttpClientInterface::class);
        $this->apiClient = new SpotifyArtistsAPIClient($this->httpClient);
        $this->apiClient->setAccessToken('access.token');
    }

    /**
     * @return void
     */
    public function testAPIRequest(): void
    {
        $response = $this->createMock(ResponseInterface::class);
        $response->expects(self::once())
            ->method('getContent')
            ->willReturn(json_encode(['unit' => 'test']));

        $this->httpClient->expects(self::once())
            ->method('request')
            ->with(
                'GET',
                'https://generic.wg.spotify.com/s4x-insights-api/v1/artist/unittest', [
                    'headers' => [
                        'Authorization' => 'Bearer access.token',
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                    ],
                    'body' => null
            ])
            ->willReturn($response);

         $response = $this->apiClient->apiRequest('GET', 'unittest');
         self::assertEquals(['unit' => 'test'], $response);
    }

    /**
     * @return void
     */
    public function testAPIRequestException(): void
    {
        $this->httpClient->expects(self::once())
            ->method('request')
            ->willThrowException(new \Exception('Something has gone wrong', 500));

        $this->expectException(SpotifyArtistsAPIException::class);
        $this->expectExceptionMessage('API request: (testing123), Something has gone wrong');
        $this->expectExceptionCode(500);

        $this->apiClient->apiRequest('GET', 'testing123');
    }
}
