<?php
require_once 'utils/DBconnect.php';
require_once 'model/Task.php';
require_once 'dao/TaskDao.php';
require_once 'dao/imp/TaskDaoImp.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['task_id'])) {
    $task_id = $_GET['task_id'];

    $taskDao = new TaskDaoImp();
    $taskData = $taskDao->getTaskById($task_id);

    if ($taskData) {
        $idUser = (int)$taskData['user_id'];

        $task = new Task(
            $idUser,
            $taskData['title'],
            $taskData['description'],
            new DateTime($taskData['due_date']),
            new DateTime($taskData['date_creation']),
            $taskData['status'],
            $taskData['id']
        );
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task_id'])) {
    $task_id = $_POST['task_id'];

    $taskDao = new TaskDaoImp();
    $taskData = $taskDao->getTaskById($task_id);

    if ($taskData) {
        $idUser = (int)$taskData['user_id'];

        $task = new Task(
            $idUser,
            $taskData['title'],
            $taskData['description'],
            new DateTime($taskData['due_date']),
            new DateTime($taskData['date_creation']),
            $taskData['status'],
            $taskData['id']
        );

        $newTitle = $_POST['task_title'];
        $newDescription = $_POST['description'];
        $newDueDate = $_POST['due_date'];
        $newStatus = $_POST['status'];

        $task->setTitle($newTitle);
        $task->setDescription($newDescription);
        $task->setDueDate(new DateTime($newDueDate));
        $task->setStatus($newStatus);

        $taskDao->editTask($task);

        header('Location: task_list.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Éditer la tâche</title>
    <link rel="stylesheet" href="assets/css/inscription_connexion.css">
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Modifier la tâche</h1>
        <a href="index.php">Accueil</a>
        <a href="task_list.php">Liste des tâches</a>
    </div>
    <div class="form">
        <div class="task-card">
            <form action="edit_task.php" method="POST">
                <input type="hidden" name="task_id" value="<?= $task->getId() ?>">
                <h2>Modifier la tâche</h2>
                <label for="task_title">Titre</label>
                <input type="text" name="task_title" id="task_title" value="<?= $task->getTitle() ?>" required>

                <label for="description">Description</label>
                <input type="text" name="description" id="description" value="<?= $task->getDescription() ?>">

                <label for="due_date">Date d'échéance :</label>
                <input type="date" name="due_date" id="due_date" value="<?= $task->getDueDate()->format('Y-m-d') ?>" required><br>

                <label for="status">Statut :</label>
                <select name="status" id="status">
                    <option value="À faire" <?= ($task->getStatus() === 'À faire') ? 'selected' : '' ?>>À faire</option>
                    <option value="En cours" <?= ($task->getStatus() === 'En cours') ? 'selected' : '' ?>>En cours</option>
                    <option value="Terminé" <?= ($task->getStatus() === 'Terminé') ? 'selected' : '' ?>>Terminé</option>
                </select>

                <input type="submit" name="update_task" value="Mettre à jour">
            </form>
        </div>
    </div>
</div>
</body>
</html>
