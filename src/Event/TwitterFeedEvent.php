<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 15.02.19
 * Time: 18:03
 */

namespace Feeder\Event;

use Symfony\Component\EventDispatcher\Event;

final class TwitterFeedEvent extends Event
{
    protected $twitterFeed;

    public function __construct(?string $feed)
    {
        $this->twitterFeed = $feed;
    }

    /**
     * @return int
     */
    public function getTwitterFeed(): ?string
    {
        return $this->twitterFeed;
    }
}
