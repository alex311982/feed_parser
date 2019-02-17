<?php

namespace Feeder\Manager;


use Feeder\Contract\FeedAdapterInterface;

/**
 * Class FeedManager
 * @package Feeder\Manager
 */
class FeedManager
{
    /**
     * @var array
     */
    protected $adapters;

    /**
     * FeedManager constructor.
     */
    public function __construct()
    {
        $this->adapters = [];
    }

    /**
     * @param FeedAdapterInterface $feedAdapter
     */
    public function addFeedAdapter(FeedAdapterInterface $feedAdapter)
    {
        array_push($this->adapters, $feedAdapter);
    }

    /**
     *
     */
    public function run()
    {
        foreach ($this->adapters as $adapter) {
            $adapter->getFeed();
        }
    }
}
