<?php declare(strict_types=1);

namespace PouleR\SpotifyArtistsAPI\Entity;

/**
 * Class SolvedLoginChallenge
 */
class SolvedLoginChallenge
{
    /**
     * @var array
     */
    private $suffix;

    /**
     * @var int
     */
    private $iterations;

    /**
     * @var int
     */
    private $duration = 0;

    /**
     * SolvedLoginChallenge constructor.
     *
     * @param array $suffix
     * @param int   $iterations
     */
    public function __construct(array $suffix, int $iterations)
    {
        $this->suffix = $suffix;
        $this->iterations = $iterations;
    }

    /**
     * @return array
     */
    public function getSuffix(): array
    {
        return $this->suffix;
    }

    /**
     * @return int
     */
    public function getIterations(): int
    {
        return $this->iterations;
    }

    /**
     * @return int
     */
    public function getDuration(): int
    {
        return $this->duration;
    }

    /**
     * Duration of the calculation in nanoseconds
     *
     * @param int $duration
     */
    public function setDuration(int $duration): void
    {
        $this->duration = $duration;
    }
}
