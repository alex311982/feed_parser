<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 13.02.19
 * Time: 19:53
 */

namespace Feeder\Adapter;


use Feeder\Contract\FeedAdapterInterface;
use Feeder\Contract\TwitterStreamInterface;

/**
 * Class TwitterStreamAdapter
 * @package Feeder\Adapter
 */
class TwitterStreamAdapter implements FeedAdapterInterface
{
    /**
     * @var string
     */
    protected $twitterStream;

    public function __construct(TwitterStreamInterface $twitterStream, EventDispatcherInterface $eventDispatcher)
    {
        $this->twitterStream = $twitterStream;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function getFeed()
    {
        $this->twitterStream->getFeedFromStream();
    }
}
