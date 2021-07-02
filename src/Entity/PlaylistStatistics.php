<?php declare(strict_types=1);

namespace PouleR\SpotifyArtistsAPI\Entity;

use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;

/**
 * Class PlaylistStatistics
 */
class PlaylistStatistics
{
    /**
     * @var PlaylistStatistic[]
     */
    private array $data = [];
    private int $playlistOverall = 0;

    /**
     * @return PlaylistStatistic[]
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param PlaylistStatistic[] $data
     *
     * @return PlaylistStatistics
     */
    public function setData(array $data): PlaylistStatistics
    {
        $normalizer = new ObjectNormalizer(null, new CamelCaseToSnakeCaseNameConverter());

        foreach ($data as $playlistStatistic) {
            $this->data[] = $normalizer->denormalize($playlistStatistic, PlaylistStatistic::class);
        }

        return $this;
    }

    /**
     * @return int
     */
    public function getPlaylistOverall(): int
    {
        return $this->playlistOverall;
    }

    /**
     * @param int $playlistOverall
     *
     * @return PlaylistStatistics
     */
    public function setPlaylistOverall(int $playlistOverall): PlaylistStatistics
    {
        $this->playlistOverall = $playlistOverall;

        return $this;
    }
}
