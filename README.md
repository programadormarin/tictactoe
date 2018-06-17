Tic Tac Toe Game
==========================

[![Build Status](https://travis-ci.org/hmarinjr/tictactoe.svg?branch=master)](https://travis-ci.org/hmarinjr/tictactoe)
[![Maintainability](https://api.codeclimate.com/v1/badges/e75b4c5401873f2f87f0/maintainability)](https://codeclimate.com/github/hmarinjr/tictactoe/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/e75b4c5401873f2f87f0/test_coverage)](https://codeclimate.com/github/hmarinjr/tictactoe/test_coverage)

This is a Tic Tac Toe game built in PHP 7 with Symfony 4!

# Installation 

### Requirements

- PHP 7.2.6
- Docker Compose (for docker usage)

Clone this repository using HTTPS or SSH

```bash
$ git clone git@github.com:hmarinjr/tictactoe.git
```

Install all the backend dependencies using composer

```bash
$ composer install
```

# Run

### Using Docker Compose

If you don't have PHP running in your local machine, user Docker Compose to build this application.

```bash
$ docker-compose up --build -d
```

### Using Symfony Server

If you are using Symfony server component just run it by command: 

```bash
$ bin/console server:run
```

Now just go to `http://localhost:8000` and enjoy!

# Test

To run the tests just access the path of project and run:

```bash
$ bin/phpunit
```

If you are using docker for application and not running PHP on your local machine please run the following commmands:

```bash
$ docker exec -it tictactoe bin/phpunit
```

# Usage

```
POST http://localhost:8000/api/move
{
  "playerUnit" : "X",
  "boardState" : 
  	[
      ["X", "O", ""],
      ["X", "O", "O"],
      ["",  "",  ""]
    ]  
  
}

Response 200 OK
{
    "playerUnit": "X",
    "boardState": [
        ["X", "X", "O"],
        ["X", "O", "O"],
        ["X", "O", "X"]
    ],
    "nextMove": [],
    "winner": {
        "unit": "X",
        "moves": [
            [0, 0],
            [0, 1],
            [0, 2]
        ]
    }
}
```

Using curl:

```bash
curl -X POST \
  http://localhost:8000/api/move \
  -H 'Cache-Control: no-cache' \
  -H 'Content-Type: application/json' \
  -d '{
  "playerUnit" : "X",
  "boardState" : 
  	[
      ["X", "O", ""],
      ["X", "O", "O"],
      ["",  "",  ""]
    ]  
  
}'
```
