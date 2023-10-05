<?php

class UserDaoImp implements UserDao
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = DBconnect::getInstance()->getPdo();
    }


    function createUser(User $user)
    {
        $stmt = $this->conn->prepare("
            INSERT INTO User(name, firstname,email, password)
            VALUES (:name, :firstname, :email, :password)
        ");

        $stmt->bindValue(':name', $user->getName());
        $stmt->bindValue('firstname', $user->getFirstname());
        $stmt->bindValue('email', $user->getEmail());
        $stmt->bindValue('password', $user->getPassword());

        $stmt->execute();
    }

    function editUser(User $user)
    {
        $stmt = $this->conn->prepare("
            UPDATE User
            SET name = :name,
                firstname = :firstname,
                email = :email,
                password = :password
            WHERE id = :id
        ");

        $stmt->bindValue(':name', $user->getName());
        $stmt->bindValue(':firstname', $user->getFirstname());
        $stmt->bindValue(':email', $user->getEmail());
        $stmt->bindValue(':password', $user->getPassword());

        $stmt->execute();
    }

    function deleteUser(int $id)
    {
        $stmt = $this->conn->prepare(" DELETE FROM User  WHERE id = :id");
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }

    function getUserById(int $id)
    {
        $stmt = $this->conn->prepare("
            SELECT * FROM User
            WHERE id = :id
        ");
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }
}