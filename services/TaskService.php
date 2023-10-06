<?php

class TaskService
{
    private TaskDaoImp $taskDao;

    public function __construct()
    {
        $this->taskDao = new TaskDaoImp();
    }

    public function getAll()
    {
        $tasks=[];
        foreach ($this->taskDao->getAllTask() as $task)
        {
            $tasks[] = self::makeTask($task);
        }
        return $tasks;
    }
    public function makeTask(array $data): Task
    {
        $idUser = isset($data['id_user']) ? (int)$data['id_user'] : 0;
        $title = $data['title'];
        $description = $data['description'];
        $dueDate = new DateTime($data['due_date']);
        $dateCreation = new DateTime($data['date_creation']);
        $status = $data['status'];
        $id = $data['id'];

        return (new Task(
            $idUser,
            $title,
            $description,
            $dueDate,
            $dateCreation,
            $status,
            $id
        ));
    }

    public function createTask(Task $task)
    {
        $this->taskDao->createTask($task);
    }

    public function editTask(Task $task)
    {
        $this->taskDao->editTask($task);
    }

    public function deleteTask(int $id)
    {
        $this->taskDao->deleteTask($id);
    }

    public function getTaskById(int $id): ? Task
    {
        $result = $this->taskDao->getTaskById($id);
        if (is_array($result)) {
            return self::makeTask($result);
        }
        return null;
    }

    public function getTaskByUserId(int $id)
    {
        $tasks = [];
        foreach ($this->taskDao->getTasksByUserId($id) as $task) {
            $tasks[] = self::makeTask($task);
        }
        $_SESSION['tasks'] = $tasks;
        return $tasks;
    }

    public function TasksSortByDueDate(int $userId)
    {
        $tasks = $this->getTaskByUserId($userId);

        function compareDueDate($a, $b) {
            return $a->getDueDate() <=> $b->getDueDate();
        }

        usort($tasks, 'compareDueDate');
        return $tasks;
    }

}