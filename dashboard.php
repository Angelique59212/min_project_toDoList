<?php
require_once 'utils/DBconnect.php';
require_once 'model/User.php';
require_once 'model/Task.php';
require_once 'dao/UserDao.php';
require_once 'dao/TaskDao.php';
require_once 'dao/imp/UserDaoImp.php';
require_once 'dao/imp/TaskDaoImp.php';
require_once 'services/UserService.php';
require_once 'services/TaskService.php';

session_start();

$userService = new UserService();
$taskService = new TaskService();

$errors = [];

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {
        $loginUser = $userService->login($email, $password);
    } else {
        echo '<div id="error-message">Veuillez remplir tous les champs</div>';
    }
}

if (isset($_SESSION['user'])) {
    $tasks = $taskService->getTaskByUserId($_SESSION['user']->getId());
}

function getMessages(string $type) {
    if (isset($_SESSION[$type])) { ?>
        <div class="message-<?= $type ?>">
            <p><?= $_SESSION[$type] ?></p>
        </div> <?php
        unset($_SESSION[$type]);
    }
}

if (isset($_SESSION['user'])) {
    getMessages('success');
}

if (isset($_GET['login']) && $_GET['login'] === 'success') {
    echo '<div id="success-message">Connexion réussie !</div>';
}

if (isset($_POST['add_task'])) {
    $taskTitle = $_POST['task_title'];
    $description = $_POST['description'];
    $dueDate = $_POST['due_date'];
    $status = $_POST['status'];

    if (empty($taskTitle) || empty($dueDate) || empty($description)) {
        echo '<div id="error-message">Veuillez remplir tous les champs</div>';
    } else {
        $dateFormat = date('Y-m-d');
        $dueDate = DateTime::createFromFormat('Y-m-d', $dueDate);
        $newTask = new Task(
            $_SESSION['user']->getId(),
            $taskTitle,
            $description,
            $dueDate,
            new DateTime(),
            $status,
            (int)null
        );

        $taskService->createTask($newTask);
        header('Location: task_list.php?createTask=success');
        exit;
    }
}

if (isset($_POST['delete_task'])) {
    $task_id = $_POST['task_id'];
    $taskService->deleteTask($task_id);
    header('Location: task_list.php?deleteTask=success');
    exit;
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="assets/css/inscription_connexion.css">
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Tableau de Bord</h1>
        <a href="index.php">Accueil</a>
        <a href="task_list.php">Liste des tâches</a>
    </div>
    <img src="assets/images/bloc-to-do-list.jpeg" alt="to_do_list">
    <div class="form">
        <div class="task-card">
            <form action="dashboard.php" method="post">
                <h2>Ajouter une tâche</h2>
                <label for="task_title">Titre</label>
                <input type="text" name="task_title" id="task_title" required>

                <label for="description">Description</label>
                <textarea  name="description" id="description" rows="4" cols="50"></textarea>

                <label for="due_date">Date d'échéance :</label>
                <input type="date" name="due_date" id="due_date" required><br>

                <label for="status">Statut :</label>
                <select name="status" id="status" required>
                    <option value="À faire">À faire</option>
                    <option value="En cours">En cours</option>
                    <option value="Terminé">Terminé</option>
                </select>

                <input type="submit" name="add_task" class="submit" value="Ajouter">
            </form>
        </div>

        <div class="task-card">
            <form action="dashboard.php" class="delete-task-card" method="post">
                <h2>Supprimer une tâche</h2>
                <label for="task_id">Sélectionner la tâche à supprimer</label>
                <select name="task_id" id="task_id" required>
                    <?php
                    foreach ($tasks as $task) {
                        echo '<option value="' . $task->getId() . '">' . $task->getTitle() . '</option>';
                    }
                    ?>
                </select>
                <input type="submit" name="delete_task" class="submit" value="Supprimer">
            </form>
        </div>
    </div>
</div>



<script src="assets/js/app.js"></script>
</body>
</html>
