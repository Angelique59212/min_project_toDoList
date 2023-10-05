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
            INSERT INTO mdf58_user(name, firstname,email, password)
            VALUES (:name, :firstname, :email, :password)
        ");

        $stmt->bindValue(':name', $user->getName());
        $stmt->bindValue('firstname', $user->getFirstname());
        $stmt->bindValue('email', $user->getEmail());
        $stmt->bindValue('password', $user->getPassword());

        $stmt->execute();

    }

    function getUserByMail(string $email)
    {
        $stmt = $this->conn->prepare("
            SELECT * FROM mdf58_user
            WHERE email = :email
        ");
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        return $stmt->fetch();
    }

    function editUser(User $user)
    {
        $stmt = $this->conn->prepare("
            UPDATE mdf58_user
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
        $stmt = $this->conn->prepare(" DELETE FROM mdf58_user  WHERE id = :id");
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }

    function getUserById(int $id)
    {
        $stmt = $this->conn->prepare("
            SELECT * FROM mdf58_user
            WHERE id = :id
        ");
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }
}