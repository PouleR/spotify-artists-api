<?php declare(strict_types=1);

namespace PouleR\SpotifyArtistsAPI\Entity;

use DateTime;

/**
 * Class UpcomingRelease
 */
class UpcomingRelease
{
    private string $id = '';
    private string $imageUrl = '';
    private string $name = '';
    private int $numTracks = 0;
    private ?DateTime $releaseDate = null;
    private string $releaseType = '';
    private bool $submissionOnRelease = false;

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @param string $id
     *
     * @return UpcomingRelease
     */
    public function setId(string $id): UpcomingRelease
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }

    /**
     * @param string $imageUrl
     *
     * @return UpcomingRelease
     */
    public function setImageUrl(string $imageUrl): UpcomingRelease
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return UpcomingRelease
     */
    public function setName(string $name): UpcomingRelease
    {
        $this->name = $name;

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
     * @return UpcomingRelease
     */
    public function setNumTracks(int $numTracks): UpcomingRelease
    {
        $this->numTracks = $numTracks;

        return $this;
    }

    /**
     * @return null|DateTime
     */
    public function getReleaseDate(): ?DateTime
    {
        return $this->releaseDate;
    }

    /**
     * @param string $releaseDate
     *
     * @return UpcomingRelease
     *
     * @throws \Exception
     */
    public function setReleaseDate(string $releaseDate): UpcomingRelease
    {
        $this->releaseDate = new DateTime($releaseDate);

        return $this;
    }

    /**
     * @return string
     */
    public function getReleaseType(): string
    {
        return $this->releaseType;
    }

    /**
     * @param string $releaseType
     *
     * @return UpcomingRelease
     */
    public function setReleaseType(string $releaseType): UpcomingRelease
    {
        $this->releaseType = $releaseType;

        return $this;
    }

    /**
     * @return bool
     */
    public function isSubmissionOnRelease(): bool
    {
        return $this->submissionOnRelease;
    }

    /**
     * @param bool $submissionOnRelease
     *
     * @return UpcomingRelease
     */
    public function setSubmissionOnRelease(bool $submissionOnRelease): UpcomingRelease
    {
        $this->submissionOnRelease = $submissionOnRelease;

        return $this;
    }
}
