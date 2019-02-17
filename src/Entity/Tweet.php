<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 17.02.19
 * Time: 19:08
 */

namespace Feeder\Entity;

/**
 * Class Tweet
 * @package Feeder\Entity
 *
 */
class Tweet
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
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return Tweet
     */
    public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getUserName(): ?string
    {
        return $this->userName;
    }

    /**
     * @param string|null $userName
     * @return Tweet
     */
    public function setUserName(?string $userName): self
    {
        $this->userName = $userName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getUserAvatar(): ?string
    {
        return $this->userAvatar;
    }

    /**
     * @param string|null $userAvatar
     * @return Tweet
     */
    public function setUserAvatar(?string $userAvatar): self
    {
        $this->userAvatar = $userAvatar;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getLink(): ?string
    {
        return $this->link;
    }

    /**
     * @param string|null $link
     * @return Tweet
     */
    public function setLink(?string $link): self
    {
        $this->link = $link;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getText(): ?string
    {
        return $this->text;
    }

    /**
     * @param string|null $text
     * @return Tweet
     */
    public function setText(?string $text): self
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getDate(): ?string
    {
        return $this->date;
    }

    /**
     * @param string|null $date
     * @return Tweet
     */
    public function setDate(?string $date): self
    {
        $this->date = $date;

        return $this;
    }

}
