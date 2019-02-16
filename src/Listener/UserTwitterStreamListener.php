<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 13.02.19
 * Time: 19:55
 */

namespace Feeder\Listener;

use Feeder\Event\TwitterFeedEvent;
use Feeder\Contract\TwitterStreamInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use OauthPhirehose;
use Phirehose;

class UserTwitterStreamListener extends OauthPhirehose implements TwitterStreamInterface
{
    /**
     * @var EventDispatcherInterface
     */
    protected $eventDispatcher;

    protected $twitterConsumerKey;

    protected $twitterConsumerSecret;

    protected $trackIds;

    public function __construct(
        EventDispatcherInterface $eventDispatcher,
        ?string $twitterAccessToken,
        ?string $twitterAccessTokenSecret,
        ?string $twitterConsumerKey,
        ?string $twitterConsumerSecret,
        ?array $trackIds
    ) {
        $this->eventDispatcher = $eventDispatcher;
        $this->twitterConsumerKey = $twitterConsumerKey;
        $this->twitterConsumerSecret = $twitterConsumerSecret;
        $this->trackIds = $trackIds;

        parent::__construct($twitterAccessToken, $twitterAccessTokenSecret, Phirehose::METHOD_FILTER);
    }

    public function getFeedFromStream()
    {
        $this->consumerKey = $this->twitterConsumerKey;
        $this->consumerSecret = $this->twitterConsumerSecret;
        $this->setFollow($this->trackIds);
        $this->consume();
    }

    /**
     * Enqueue each status
     *
     * @param string $status
     */
    public function enqueueStatus($status)
    {
        $event = new TwitterFeedEvent($status);
        $this->eventDispatcher->dispatch('twitter.feed_update', $event);
    }
}
