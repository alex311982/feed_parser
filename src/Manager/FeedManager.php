<?php

namespace Feeder\Manager;


use Feeder\Contract\FeedAdapterInterface;

class FeedManager
{
    protected $adapters;

    public function __construct()
    {
        $this->adapters = [];
    }

    public function addFeedAdapter(FeedAdapterInterface $feedAdapter)
    {
        array_push($this->adapters, $feedAdapter);
    }

    public function run()
    {
        foreach ($this->adapters as $adapter) {
            $adapter->getFeed();
        }
    }
}
