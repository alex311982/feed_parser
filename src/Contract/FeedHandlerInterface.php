<?php

namespace Feeder\Contract;


interface FeedHandlerInterface
{
    public function handle(?string $status);
}
