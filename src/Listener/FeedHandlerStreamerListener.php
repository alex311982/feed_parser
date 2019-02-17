<?php

namespace Feeder\Listener;


use Feeder\Event\TwitterFeedEvent;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Serializer\SerializerInterface;
use WebSocket\Client;

/**
 * Class FeedHandlerStreamerListener
 * @package Feeder\Listener
 */
class FeedHandlerStreamerListener
{
    /**
     * @var SerializerInterface
     */
    protected $serializer;

    /**
     * @var ParameterBagInterface
     */
    protected $appParameterBag;

    /**
     * FeedHandlerStreamerListener constructor.
     * @param SerializerInterface $serializer
     * @param ParameterBagInterface $appParameterBag
     */
    public function __construct(
        SerializerInterface $serializer,
        ParameterBagInterface $appParameterBag
    ) {
        $this->serializer = $serializer;
        $this->appParameterBag = $appParameterBag;
    }

    /**
     * @param TwitterFeedEvent $event
     * @throws \WebSocket\BadOpcodeException
     */
    public function __invoke(TwitterFeedEvent $event)
    {
        $feed = $event->getTwitterFeed();

        $client = new Client($this->appParameterBag->get('stream_url'));
        $client->send($this->serializer->serialize($feed, 'json'));
    }
}
