<?php

namespace Feeder\Service;


use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;

/**
 * Class FeedServer
 * @package Feeder\Service
 */
class FeedServer implements MessageComponentInterface {

    /**
     * @var \SplObjectStorage
     */
    protected $clients;

    /**
     * FeedServer constructor.
     */
    public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    /**
     * @param ConnectionInterface $conn
     */
    public function onOpen(ConnectionInterface $conn) {
        $this->clients->attach($conn);
    }

    /**
     * @param ConnectionInterface $from
     * @param string $msg
     */
    public function onMessage(ConnectionInterface $from, $msg) {
        foreach ($this->clients as $client) {
            if ($from != $client) {
                $client->send($msg);
            }
        }
    }

    /**
     * @param ConnectionInterface $conn
     */
    public function onClose(ConnectionInterface $conn) {
        $this->clients->detach($conn);
    }

    /**
     * @param ConnectionInterface $conn
     * @param \Exception $e
     */
    public function onError(ConnectionInterface $conn, \Exception $e) {
        $conn->close();
    }
}
