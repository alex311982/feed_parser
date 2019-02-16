<?php

namespace Feeder\Service;


use Feeder\Event\TwitterFeedEvent;
use WebSocket\Client;

class FeedHandlerStreamer
{
    public function onFeedUpdate(TwitterFeedEvent $event)
    {
        $feed = $event->getTwitterFeed();

        $client = new Client("ws://127.0.0.1:3535");
        $client->send($feed);
    }
}
