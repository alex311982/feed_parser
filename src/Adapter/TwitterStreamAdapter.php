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
use Feeder\Service\UserTwitterStream;

class TwitterStreamAdapter implements FeedAdapterInterface
{
    /**
     * @var UserTwitterStream
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
