<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 17.02.19
 * Time: 19:09
 */

namespace Feeder\Service;


use Feeder\DTO\TweetDTO;
use Feeder\Entity\Tweet;

class TweetAssembler
{
    /**
     * @param TweetDTO $tweetDTO
     * @return Tweet
     * @throws \Exception
     */
    public function readDTO(TweetDTO $tweetDTO): Tweet
    {
        $tweet = new Tweet();

        $date = new \DateTime($tweetDTO->getDate());

        $tweet
            ->setId($tweetDTO->getId())
            ->setUserName($tweetDTO->getUserName())
            ->setUserAvatar($tweetDTO->getUserAvatar())
            ->setText($tweetDTO->getText())
            ->setLink('http://twitter.com/' . $tweetDTO->getLink())
            ->setDate($date->format('Y-m-d'));

        return $tweet;
    }
}
