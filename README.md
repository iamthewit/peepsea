# PeepSea

## Description
PeepSea is a simple "say what you see" picture and word game.

To create a PeepSea you must provide a collection of images (in order) that represent a word, phrase, saying, song lyric or any other sentence. It is then down to your friends (the Guessers) to figure out the text that your PeepSea represents.

## Setup
- `composer install`
- For a local sqlite DB: `touch database/peepsea.sqlite3` from the project root.
- Copy `.env.example` to `.env` and make any necessary updates.

## Usage

### Create a PeepSea
Submit a `POST` request to `/peepsea` such as:

TODO: give curl example

### Submit a Guess for a PeepSea
Submit a `POST` request to `/peepsea/ID/guess`

TODO: give curl example