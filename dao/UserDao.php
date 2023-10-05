<?php

interface UserDao
{
    function createuser(User $user);
    function getUserByMail(string $email);
    function editUser(User $user);
    function deleteUser(int $id);
    function getUserById(int $id);
}