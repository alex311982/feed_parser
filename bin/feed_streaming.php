<?php

use Feeder\Service\Chat;
use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;

error_reporting(E_ALL);
ini_set('display_errors', 1);

try {
    require __DIR__.'/../bootstrap.php';

    $chat = $container->get('chat');

    $server = IoServer::factory(
        new HttpServer(
            new WsServer(
                $chat
            )
        ),
        3535
    );

    $server->run();
} catch (\Exception $e) {
    echo $e->getMessage();
    echo PHP_EOL;
}
