# PeepSea

## Description
PeepSea is a simple "say what you see" picture and word game.

To create a PeepSea you must provide a collection of images (in order) that represent a word, phrase, saying, song lyric or any other sentence. It is then down to your friends (the Guessers) to figure out the text that your PeepSea represents.

## Setup
- `composer install`
- For a local sqlite DB: `touch database/peepsea.sqlite3` from the project root.
- Copy `.env.example` to `.env` and make any necessary updates.
- Serve the `public/index.php` file via your web-server
    - Use PHP's built in web-server: `php -S localhost:8888 -t public public/index.php`

## Usage

### Create a PeepSea
Submit a `POST` request to `/peepsea`  e.g.:

```
curl --request POST \
  --url http://localhost:8888/peepsea \
  --header 'content-type: multipart/form-data;' \
  --form 'answer=The Answer To The PeepSea' \
  --form 'images[]=image1.png' \
  --form 'images[]=image2.png'
```
### Submit a Guess for a PeepSea
Submit a `POST` request to `/peepsea/ID/guess` e.g.:

TODO: give curl example