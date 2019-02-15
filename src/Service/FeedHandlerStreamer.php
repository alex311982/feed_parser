<?php

namespace Feeder\Service;


use Feeder\Contract\FeedHandlerInterface;

class FeedHandlerStreamer implements FeedHandlerInterface
{
    public function handle(?string $feed)
    {
        echo $feed;
    }
}
