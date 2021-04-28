# Spotify Artists API PHP

This is a PHP wrapper for the (unofficial) Spotify Artists API.

## Requirements
* PHP ^7.3|^8.0

## Installation
Install it using [Composer](https://getcomposer.org/):

```sh
composer require pouler/spotify-artists-api
```

## Compiling .proto files
- Originally taken from this repository: https://github.com/librespot-org/librespot-java/tree/dev/lib/src/main/proto/spotify/login5/v3
- Make sure you have the protoc compiler installed
- The .proto files are used for generating the PHP classes

`protoc --php_out=./generated --proto_path=./proto \ 
proto/spotify/login5/v3/login5.proto \
  proto/spotify/login5/v3/user_info.proto \
  proto/spotify/login5/v3/client_info.proto \
  proto/spotify/login5/v3/challenges/code.proto \
  proto/spotify/login5/v3/challenges/hashcash.proto \
  proto/spotify/login5/v3/credentials/credentials.proto \
  proto/spotify/login5/v3/identifiers/identifiers.proto`

## Example usage
```php
<?php declare(strict_types=1);

use PouleR\SpotifyArtistsAPI\SpotifyArtistsAPIClient;

require 'vendor/autoload.php';

$httpClient = new \Symfony\Component\HttpClient\CurlHttpClient();
$client = new \PouleR\SpotifyArtistsAPI\SpotifyArtistsAPIClient($httpClient);
$spotifyApi = new \PouleR\SpotifyArtistsAPI\SpotifyArtistsAPI($client);

$spotifyApi->setClientId('clientId');
$spotifyApi->setDeviceId('deviceId');

// Log in and get the access token
$token = $spotifyApi->login('email@address.com','password');
$spotifyApi->setAccessToken($token->getAccessToken());
$upcoming = $spotifyApi->getUpcomingReleases('artistId');

print_r($upcoming);

// Use the current token to get a new one
$newToken = $spotifyApi->refreshToken($token->getUsername(), $token->getRefreshToken());
$spotifyApi->setAccessToken($newToken->getAccessToken());

$realtime = $spotifyApi->getRealTimeStatistics('artistId', 'trackId');

print_r($realtime);
```
