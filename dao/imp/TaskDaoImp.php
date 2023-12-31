<?php

class TaskDaoImp implements TaskDao
{
    private PDO $conn;

    public function __construct()
    {
        $this->conn = DBconnect::getInstance()->getPdo();
    }


    function getAllTask()
    {
        return $this->conn->query("SELECT * FROM task")->fetchAll();
    }

    function createTask(Task $task)
    {
        $stmt = $this->conn->prepare("
            INSERT INTO mdf58_task(title, description, due_date, date_creation, status,id_mdf58_user)
            VALUES (:title, :description, :due_date, :date_creation, :status, :id_mdf58_task)
        ");
        $stmt->bindValue(":title", $task->getTitle());
        $stmt->bindValue(":description", $task->getDescription());
        $stmt->bindValue("due_date", $task->getDueDate()->format('Y-m-d'));
        $stmt->bindValue(":date_creation", $task->getDateCreation()->format('Y-m-d'));
        $stmt->bindValue(":status", $task->getStatus());
        $stmt->bindValue(":id_mdf58_task", $task->getIdUser());

        $stmt->execute();
    }

    function editTask(Task $task)
    {
        $stmt = $this->conn->prepare("
            UPDATE mdf58_task
            SET title = :title,
                description = :description,
                due_date = :due_date,
                status = :status
                WHERE id = :id;
        ");
        $stmt->bindValue(":title", $task->getTitle());
        $stmt->bindValue(":description", $task->getDescription());
        $dueDate = $task->getDueDate()->format('Y-m-d');
        $stmt->bindValue(':due_date', $dueDate);
        $stmt->bindValue(":status", $task->getStatus());
        $stmt->bindValue(':id', $task->getId());
        $stmt->execute();
    }

    function deleteTask(int $id)
    {
        $stmt = $this->conn->prepare(" DELETE FROM mdf58_task  WHERE id = :id");
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }

    function getTaskById(int $id)
    {
        $stmt = $this->conn->prepare("
            SELECT * FROM mdf58_task
            WHERE id = :id
        ");
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getTasksByUserId(int $userId)
    {
        $stmt = $this->conn->prepare("SELECT * FROM mdf58_task WHERE id_mdf58_user = :userId");
        $stmt->bindValue(':userId', $userId);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}