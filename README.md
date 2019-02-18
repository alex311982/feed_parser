## Feeder test task

* cp .env.dist .env
* Скопировать данные из письма по ключам АПИ Твиттера
* docker run --rm -v $(pwd):/app prooph/composer:7.2 install
* docker-compose up -d --build

На разных  вкладках терминала:
* docker-compose exec php_stream php feed_streaming.php
* docker-compose exec php_stream php get_feed.php

Поднятие фронта:

* docker network inspect bridge | grep Gateway | grep -o -E '([0-9]{1,3}\.){3}[0-9]{1,3}'
* В браузере набрать http://{ip}:3131, где ip - результат вывода команды выше