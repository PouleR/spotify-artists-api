# Spotify Artists API PHP

This is a PHP wrapper for the (unofficial) Spotify Artists API.

## Requirements
* PHP >=8.1

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
$artistsApi = new \PouleR\SpotifyArtistsAPI\SpotifyArtistsAPI($apiClient);

$loginClient = new \PouleR\SpotifyLogin\SpotifyLoginClient($httpClient);
$spotifyLogin = new \PouleR\SpotifyLogin\SpotifyLogin($loginClient);

$spotifyLogin->setClientId('clientId');
$spotifyLogin->setDeviceId('deviceId');

// Log in and get the access token
$accessToken = $spotifyLogin->login('email@address.com','password');

// Use this token for the artists API
$artistsApi->setAccessToken($accessToken);
$upcoming = $artistsApi->getUpcomingReleases('artistId');

print_r($upcoming);

$realtime = $artistsApi->getRealTimeStatistics('artistId', 'trackId');

print_r($realtime);
```
