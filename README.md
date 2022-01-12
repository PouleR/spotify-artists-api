# Spotify Artists API PHP

This is a PHP wrapper for the (unofficial) Spotify Artists API.

## Requirements
* PHP ^7.4|^8.0

## Installation
Install it using [Composer](https://getcomposer.org/):

```sh
composer require pouler/spotify-artists-api
```

## Example usage
```php
<?php declare(strict_types=1);

require 'vendor/autoload.php';

$httpClient = new \Symfony\Component\HttpClient\CurlHttpClient();
$client = new \PouleR\SpotifyArtistsAPI\SpotifyArtistsAPIClient($httpClient);
$loginClient = new \PouleR\SpotifyLogin\SpotifyLoginClient($httpClient);
$spotifyLogin = new \PouleR\SpotifyLogin\SpotifyLogin($loginClient);
$spotifyApi = new \PouleR\SpotifyArtistsAPI\SpotifyArtistsAPI($client, $spotifyLogin);

$spotifyLogin->setClientId('clientId');
$spotifyLogin->setDeviceId('deviceId');

// Log in and get the access token
$token = $spotifyLogin->login('email@address.com','password');
$spotifyApi->setAccessToken($token->getAccessToken());
$upcoming = $spotifyApi->getUpcomingReleases('artistId');

print_r($upcoming);

// Use the current token to get a new one
$newToken = $spotifyLogin->refreshToken($token->getUsername(), $token->getRefreshToken());
$spotifyApi->setAccessToken($newToken->getAccessToken());

$realtime = $spotifyApi->getRealTimeStatistics('artistId', 'trackId');

print_r($realtime);
```
