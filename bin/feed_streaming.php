<?php

use Feeder\Service\FeedServer;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;

try {
    require __DIR__.'/../bootstrap.php';

    /** @var FeedServer $feedStreamServer */
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
} catch (\Throwable $e) {
    $container->get('app.logger')->err($e->getCode() . ':' . $e->getFile() . ':' . $e->getLine() . ':' . $e->getMessage());
}
