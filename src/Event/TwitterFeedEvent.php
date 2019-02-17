<?php

namespace Feeder\Event;

use Feeder\Entity\Tweet;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class TwitterFeedEvent
 * @package Feeder\Event
 */
final class TwitterFeedEvent extends Event
{
    /**
     * @var Tweet|null
     */
    protected $twitterFeed;

    /**
     * TwitterFeedEvent constructor.
     * @param Tweet|null $feed
     */
    public function __construct(?Tweet $feed)
    {
        $this->twitterFeed = $feed;
    }

    /**
     * @return Tweet|null
     */
    public function getTwitterFeed(): ?Tweet
    {
        return $this->twitterFeed;
    }
}
