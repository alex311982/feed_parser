<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 13.02.19
 * Time: 19:55
 */

namespace Feeder\Service;

use Feeder\Contract\FeedHandlerInterface;
use Feeder\Contract\TwitterStreamInterface;
use OauthPhirehose;
use Phirehose;

class UserTwitterStream extends OauthPhirehose implements TwitterStreamInterface
{
    /**
     * @var FeedHandlerInterface
     */
    protected $feedHandler;

    protected $twitterConsumerKey;

    protected $twitterConsumerSecret;

    protected $trackIds;

    public function __construct(
        FeedHandlerInterface $feedHandler,
        ?string $twitterAccessToken,
        ?string $twitterAccessTokenSecret,
        ?string $twitterConsumerKey,
        ?string $twitterConsumerSecret,
        ?array $trackIds
    ) {
        $this->feedHandler = $feedHandler;
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
        $this->feedHandler->handle($status);
    }
}
