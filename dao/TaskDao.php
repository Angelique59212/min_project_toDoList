<?php

interface TaskDao
{
    function getAllTask();
    function createTask(Task $task);

    function editTask(Task $task);
    function deleteTask(int $id);
    function getTaskById(int $id);
}