<?php

namespace Feeder;

use Feeder\Manager\FeedManager;

/**
 * Class Application
 * @package Framework
 */
class App
{
    /**
     * @var FeedManager
     */
    protected $feedManager;

    /**
     * App constructor.
     * @param FeedManager $feedManager
     */
    public function __construct(FeedManager $feedManager)
    {
        $this->feedManager = $feedManager;
    }

    /**
     *
     */
    public function run()
    {
        $this->feedManager->run();
    }
}
