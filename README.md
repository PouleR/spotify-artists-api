# Spotify Artists API PHP

This is a PHP wrapper for the (unofficial) Spotify Artists API.

## Requirements
* PHP ^7.4|^8.0

## Installation
Install it using [Composer](https://getcomposer.org/):

```sh
composer require pouler/spotify-artists-api
```

## Spotify login
You can obtain an access token by using the SpotifyLogin class, this dependency can be installed by using:

```sh
composer require pouler/spotify-login
```

For more information about this project see: https://github.com/PouleR/spotify-login

## Example usage

```php
<?php declare(strict_types=1);

require 'vendor/autoload.php';

$httpClient = new \Symfony\Component\HttpClient\CurlHttpClient();
$apiClient = new \PouleR\SpotifyArtistsAPI\SpotifyArtistsAPIClient($httpClient);
$spotifyApi = new \PouleR\SpotifyArtistsAPI\SpotifyArtistsAPI($apiClient);

$spotifyApi->setAccessToken('token');
$upcoming = $spotifyApi->getUpcomingReleases('artistId');

print_r($upcoming);

$realtime = $spotifyApi->getRealTimeStatistics('artistId', 'trackId');

print_r($realtime);
```
