<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 15.02.19
 * Time: 11:32
 */

namespace Feeder\Service;


use Feeder\Contract\TwitterStreamInterface;
use Feeder\Event\TwitterFeedEvent;
use WebSocket\Client;

class MockUserTwitterStream implements TwitterStreamInterface
{
    public function getFeedFromStream()
    {
        $client = new Client("ws://127.0.0.1:3535");

        for($i=0; $i<20; $i++) {
            $client->send("Hello {$i}!");
            sleep(2);
        }
    }
}
