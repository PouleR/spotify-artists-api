<?php declare(strict_types=1);

namespace PouleR\SpotifyArtistsAPI\Entity;

/**
 * Class EngagementMetric
 */
class EngagementMetric
{
    private ?\DateTime $date = null;
    private ?int $day = null;
    private ?int $followersStreamers = null;

    /**
     * @return \DateTime|null
     */
    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    /**
     * @param string|null $date
     *
     * @return EngagementMetric
     */
    public function setDate(?string $date): EngagementMetric
    {
        $this->date = new \DateTime($date);

        return $this;
    }

    /**
     * @return int|null
     */
    public function getDay(): ?int
    {
        return $this->day;
    }

    /**
     * @param int|null $day
     *
     * @return EngagementMetric
     */
    public function setDay(?int $day): EngagementMetric
    {
        $this->day = $day;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getFollowersStreamers(): ?int
    {
        return $this->followersStreamers;
    }

    /**
     * @param int|null $followersStreamers
     *
     * @return EngagementMetric
     */
    public function setFollowersStreamers(?int $followersStreamers): EngagementMetric
    {
        $this->followersStreamers = $followersStreamers;

        return $this;
    }
}
