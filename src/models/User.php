<?php


class User
{
    private $id;
    private $nick;
    private $email;
    private $password;

    public function __construct(string $nick, string $email, string $password = null, $id = null)
    {
        $this->id = $id;
        $this->nick = $nick;
        $this->email = $email;
        $this->password = $password;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): void
    {
        $this->id = $id;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function getNick(): string
    {
        return $this->nick;
    }

    public function setNick(string $nick)
    {
        $this->nick = $nick;
    }

}