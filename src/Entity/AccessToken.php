<?php declare(strict_types=1);

namespace PouleR\SpotifyArtistsAPI\Entity;

/**
 * Class AccessToken
 */
class AccessToken
{
    /**
     * @var string
     */
    private $accessToken = '';

    /**
     * @var int
     */
    private $expiresIn = 0;

    /**
     * @var string
     */
    private $refreshToken = '';

    /**
     * @var string
     */
    private $username = '';

    /**
     * @return string
     */
    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    /**
     * @param string $accessToken
     *
     * @return AccessToken
     */
    public function setAccessToken(string $accessToken)
    {
        $this->accessToken = $accessToken;

        return $this;
    }

    /**
     * @return int
     */
    public function getExpiresIn(): int
    {
        return $this->expiresIn;
    }

    /**
     * @param int $expiresIn
     *
     * @return AccessToken
     */
    public function setExpiresIn(int $expiresIn): AccessToken
    {
        $this->expiresIn = $expiresIn;

        return $this;
    }

    /**
     * @return string
     */
    public function getRefreshToken(): string
    {
        return $this->refreshToken;
    }

    /**
     * @param string $refreshToken
     *
     * @return AccessToken
     */
    public function setRefreshToken(string $refreshToken): AccessToken
    {
        $this->refreshToken = $refreshToken;

        return $this;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     *
     * @return AccessToken
     */
    public function setUsername(string $username): AccessToken
    {
        $this->username = $username;

        return $this;
    }
}
