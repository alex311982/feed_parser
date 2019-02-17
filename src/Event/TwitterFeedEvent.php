<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 15.02.19
 * Time: 18:03
 */

namespace Feeder\Event;

use Feeder\Entity\Tweet;
use Symfony\Component\EventDispatcher\Event;

final class TwitterFeedEvent extends Event
{
    protected $twitterFeed;

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
