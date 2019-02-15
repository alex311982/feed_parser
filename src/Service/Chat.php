<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 14.02.19
 * Time: 16:26
 */

namespace Feeder\Service;


use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;

/**
 * chat.php
 * Send any incoming messages to all connected clients (except sender)
 */
class Chat implements MessageComponentInterface {
    protected $clients;

    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    public function onOpen(ConnectionInterface $conn) {
        echo 'CONNECTED';
        $this->clients->attach($conn);
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        echo 'MESSAGE';
        foreach ($this->clients as $client) {
            echo 'SEND';
            if ($from != $client) {
                $client->send($msg);
            }
        }
    }

    public function onClose(ConnectionInterface $conn) {
        echo 'CLOSE';
        $this->clients->detach($conn);
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo 'ERROR';
        $conn->close();
    }
}