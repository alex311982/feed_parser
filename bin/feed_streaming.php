<?php

use Feeder\Service\FeedServer;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;

error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    require __DIR__.'/../bootstrap.php';

    $feedStreamServer = $container->get('feed.stream_server');

    $server = IoServer::factory(
        new HttpServer(
            new WsServer(
                $feedStreamServer
            )
        ),
        3535
    );

    $server->run();
} catch (\Exception $e) {
    echo $e->getMessage();
    echo PHP_EOL;
}
