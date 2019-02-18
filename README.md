## Feeder test task

* cp .env.dist .env
* Скопировать данные из письма по ключам АПИ Твиттера
* docker run --rm -v $(pwd):/app prooph/composer:7.2 install
* docker-compose up -d --build

На разных  вкладках терминала:
* docker-compose exec php_stream php feed_streaming.php
* docker-compose exec php_stream php get_feed.php