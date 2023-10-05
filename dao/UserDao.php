<?php

interface UserDao
{
    function createuser(User $user);
    function editUser(User $user);
    function deleteUser(int $id);
    function getUserById(int $id);
}