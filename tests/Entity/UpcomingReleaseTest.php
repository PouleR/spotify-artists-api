<?php declare(strict_types=1);

namespace PouleR\SpotifyArtistsAPI\Tests\Entity;

use PHPUnit\Framework\TestCase;
use PouleR\SpotifyArtistsAPI\Entity\UpcomingRelease;

/**
 * Class UpcomingReleaseTest
 */
class UpcomingReleaseTest extends TestCase
{
    private UpcomingRelease $upcomingRelease;

    /**
     * @return void
     */
    public function setUp(): void
    {
        $this->upcomingRelease = new UpcomingRelease();
        $this->upcomingRelease
            ->setId('id')
            ->setImageUrl('https://image.url')
            ->setName('upcoming')
            ->setNumTracks(1)
            ->setReleaseDate('2022-01-01')
            ->setReleaseType('single')
            ->setSubmissionOnRelease(true);
    }

    /**
     * @return void
     */
    public function testId(): void
    {
        self::assertEquals('id', $this->upcomingRelease->getId());
    }

    /**
     * @return void
     */
    public function testImageUrl(): void
    {
        self::assertEquals('https://image.url', $this->upcomingRelease->getImageUrl());
    }

    /**
     * @return void
     */
    public function testName(): void
    {
        self::assertEquals('upcoming', $this->upcomingRelease->getName());
    }

    /**
     * @return void
     */
    public function testNumTracks(): void
    {
        self::assertEquals(1, $this->upcomingRelease->getNumTracks());
    }

    /**
     * @return void
     */
    public function testReleaseDate(): void
    {
        self::assertInstanceOf(\DateTime::class, $this->upcomingRelease->getReleaseDate());
        self::assertEquals(new \DateTime('2022-01-01'), $this->upcomingRelease->getReleaseDate());
    }

    /**
     * @return void
     */
    public function testReleaseType(): void
    {
        self::assertEquals('single', $this->upcomingRelease->getReleaseType());
    }

    /**
     * @return void
     */
    public function testSubmissionOnRelease(): void
    {
        self::assertTrue($this->upcomingRelease->isSubmissionOnRelease());
    }
}
