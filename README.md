## Feeder test task

The project contains code for getting messages from Twitter`s accounts and display them within browser`s page in real time .

Steps to run project on local environment.

* cp .env.dist .env
* setup Twitter`s API keys in .env
* docker run --rm -v $(pwd):/app prooph/composer:7.2 install
* docker-compose up -d --build

Run 2 tasks in different terminals:
* docker-compose exec php_stream php feed_streaming.php
* docker-compose exec php_stream php get_feed.php

Run front:

* Get Docker`s local host IP: 
docker network inspect bridge | grep Gateway | grep -o -E '([0-9]{1,3}\.){3}[0-9]{1,3}'
* In browser navigate to url http://{IP}:3131, where {IP} is a result of running previous command
