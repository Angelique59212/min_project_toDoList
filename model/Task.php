<?php

class Task
{
    private int $id;
    private string $title;
    private string $description;
    private DateTime $dueDate;
    private DateTime $dateCreation;
    private string $status;
    private int $idUser;

    public function __construct(
        int $idUser,
        string $title,
        string $description,
        DateTime $dueDate,
        DateTime $dateCreation,
        string $status,
        int $id
    )
    {
        $this->title = $title;
        $this->description = $description;
        $this->dueDate = $dueDate;
        $this->dateCreation = $dateCreation;
        $this->status = $status;
        $this->idUser = $idUser;
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title): self
    {
        $this->title = $title;
        return $this;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getDueDate()
    {
        return $this->dueDate;
    }

    public function setDueDate($dueDate): self
    {
        $this->dueDate = $dueDate;
        return $this;
    }

    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    public function setDateCreation($dateCreation): self
    {
        $this->dateCreation = $dateCreation;
        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getIdUser()
    {
        return $this->idUser;
    }

    public function setIdUser($idUser): self
    {
        $this->idUser = $idUser;
        return $this;
    }


}