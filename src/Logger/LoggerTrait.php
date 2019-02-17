<?php

namespace Feeder\Logger;

use Psr\Log\LoggerInterface;

/**
 * Trait LoggerTrait
 * @package Feeder\Logger
 */
trait LoggerTrait
{
    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @return LoggerInterface
     */
    public function getLogger(): LoggerInterface
    {
        return $this->logger;
    }
}
