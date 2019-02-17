<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 13.02.19
 * Time: 19:55
 */

namespace Feeder\Service;

use Feeder\{DTO\TweetDTO, Event\TwitterFeedEvent, Contract\TwitterStreamInterface, Logger\LoggerTrait};
use Symfony\Component\{DependencyInjection\ParameterBag\ParameterBagInterface, EventDispatcher\EventDispatcherInterface};
use OauthPhirehose;
use Phirehose;

/**
 * Class UserTwitterStreamProcessor
 * @package Feeder\Service
 */
class UserTwitterStreamProcessor extends OauthPhirehose implements TwitterStreamInterface
{
    use LoggerTrait;

    /**
     * @var EventDispatcherInterface
     */
    protected $eventDispatcher;

    /**
     * @var TweetAssembler
     */
    protected $tweetAssembler;

    /**
     * @var ParameterBagInterface
     */
    protected $appParameterBag;

    /**
     * UserTwitterStreamProcessor constructor.
     *
     * @param EventDispatcherInterface $eventDispatcher
     * @param TweetAssembler $tweetAssembler
     * @param ParameterBagInterface $appParameterBag
     */
    public function __construct(
        EventDispatcherInterface $eventDispatcher,
        TweetAssembler $tweetAssembler,
        ParameterBagInterface $appParameterBag
    ) {
        $this->eventDispatcher = $eventDispatcher;
        $this->tweetAssembler = $tweetAssembler;
        $this->appParameterBag = $appParameterBag;

        parent::__construct(
            $this->appParameterBag->get('twitter_access_token'),
            $this->appParameterBag->get('twitter_access_token_secret'),
            Phirehose::METHOD_FILTER
        );
    }

    /**
     * @throws \ErrorException
     */
    public function getFeedFromStream()
    {
        $this->consumerKey = $this->appParameterBag->get('twitter_consumer_key');
        $this->consumerSecret = $this->appParameterBag->get('twitter_consumer_secret');
        $this->setFollow($this->appParameterBag->get('twitter_stream_ids'));
        $this->consume();
    }

    /**
     * Enqueue each status
     *
     * @param string $status
     * @throws \Framework\Exception\NotValidTweetException
     * @throws \Exception
     */
    public function enqueueStatus($status)
    {
        $this->getLogger()->info($status);

        $feed = $this->tweetAssembler->readDTO(new TweetDTO($status));

        if ($feed->getId()) {
            $event = new TwitterFeedEvent($feed);
            $this->eventDispatcher->dispatch('twitter.feed_update', $event);
        }
    }
}
