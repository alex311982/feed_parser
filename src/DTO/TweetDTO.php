<?php

namespace Feeder\DTO;


use Framework\Exception\NotValidTweetException;

class TweetDTO
{
    /**
     * @var integer|null
     */
    protected $id;

    /**
     * @var string|null
     */
    protected $userName;

    /**
     * @var string|null
     */
    protected $userAvatar;

    /**
     * @var string|null
     */
    protected $link;

    /**
     * @var string|null
     */
    protected $text;

    /**
     * @var string|null
     */
    protected $date;

    /**
     * TweetDTO constructor.
     * @param string|null $tweetJson
     * @throws NotValidTweetException
     */
    public function __construct(?string $tweetJson)
    {
        if (!$tweetJson) {
            throw new NotValidTweetException('There is not tweet json received');
        }

        $tweetArr = json_decode($tweetJson, true);

        $this->id = $tweetArr['user']['id'] ?? null;
        $this->userName = $tweetArr['user']['name'] ?? '';
        $this->userAvatar = $tweetArr['user']['profile_image_url'] ?? '';
        $this->link = $tweetArr['user']['screen_name'] ?? '';
        $this->text = $tweetArr['text'] ?? '';
        $this->date = $tweetArr['created_at'] ?? null;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getUserName(): ?string
    {
        return $this->userName;
    }

    /**
     * @return string|null
     */
    public function getUserAvatar(): ?string
    {
        return $this->userAvatar;
    }

    /**
     * @return string|null
     */
    public function getLink(): ?string
    {
        return $this->link;
    }

    /**
     * @return string|null
     */
    public function getText(): ?string
    {
        return $this->text;
    }

    /**
     * @return string|null
     */
    public function getDate(): ?string
    {
        return $this->date;
    }

}
