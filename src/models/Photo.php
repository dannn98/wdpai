<?php


class Photo
{
    private $id;
    private $title;
    private $image;
    private $likes;
    private $comments;
    private ?User $user;

    public function __construct($title, $image, $id = null, $likes = 0, $comments = 0, $user = null)
    {
        $this->id = $id;
        $this->title = $title;
        $this->image = $image;
        $this->likes = $likes;
        $this->comments = $comments;
        $this->user = $user;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title): void
    {
        $this->title = $title;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image): void
    {
        $this->image = $image;
    }

    public function getLikes()
    {
        return $this->likes;
    }

    public function setLikes($likes): void
    {
        $this->likes = $likes;
    }

    public function getComments()
    {
        return $this->comments;
    }

    public function setComments($comments): void
    {
        $this->comments = $comments;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): void
    {
        $this->user = $user;
    }


}