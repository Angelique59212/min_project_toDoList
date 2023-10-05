<?php

class UserService
{
    private UserDaoImp $userDao;

    public function __construct()
    {
        $this->userDao = new UserDaoImp();
    }

    public function makeUser(array $data): User
    {
        return (new User(
            $data['name'],
            $data['firstname'],
            $data['email'],
            $data['password']
        ))
            ->setId($data['id']);
    }

    private function hashPassword($password)
    {
        return password_hash($password, PASSWORD_ARGON2I);
    }

    public function createUser(User $user)
    {
        $hashPassword = $this->hashPassword($user->getPassword());
        $user->setPassword($hashPassword);
        $this->userDao->createuser($user);
    }

    public function editUser(User $user)
    {
        $hashPassword = $this->hashPassword($user->getPassword());
        $user->setPassword($hashPassword);
        $this->userDao->editUser($user);
    }

    public function deleteUser(int $id)
    {
        $this->userDao->deleteUser($id);
    }

    public function getUserById(int $id): ?User
    {
        $result = $this->userDao->getUserById($id);
        if (is_array($result)) {
            return self::makeUser($result);
        }
        return null;
    }
}