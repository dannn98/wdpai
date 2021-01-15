<?php


class Photo
{
    private $id;
    private $title;
    private $image;
    private $id_user;

    public function __construct($id, $title, $image, $id_user)
    {
        $this->id = $id;
        $this->title = $title;
        $this->image = $image;
        $this->id_user = $id_user;
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

    public function getIdUser()
    {
        return $this->id_user;
    }

    public function setIdUser($id_user): void
    {
        $this->id_user = $id_user;
    }
}