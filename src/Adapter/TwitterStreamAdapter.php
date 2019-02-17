<?php

namespace Feeder\Adapter;


use Feeder\Contract\{FeedAdapterInterface, TwitterStreamInterface};

/**
 * Class TwitterStreamAdapter
 * @package Feeder\Adapter
 */
class TwitterStreamAdapter implements FeedAdapterInterface
{
    /**
     * @var TwitterStreamInterface
     */
    protected $twitterStream;

    public function __construct(TwitterStreamInterface $twitterStream)
    {
        $this->twitterStream = $twitterStream;
    }

    public function getFeed()
    {
        $this->twitterStream->getFeedFromStream();
    }
}
