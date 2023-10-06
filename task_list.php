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

if (isset($_SESSION['user'])) {
    $tasks = $taskService->getTaskByUserId($_SESSION['user']->getId());
    getMessages('success');
}

function getMessages(string $type)
{
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

if (isset($_GET['createTask']) && $_GET['createTask'] === 'success') {
    echo '<div id="success-message">Tâche ajoutée avec succès !</div>';
}

if (isset($_GET['deleteTask']) && $_GET['deleteTask'] === 'success') {
    echo '<div id="success-message">Tâche supprimée avec succès !</div>';
}

if (isset($_SESSION['user'])) {
    $tasks = $taskService->TasksSortByDueDate($_SESSION['user']->getId());
    getMessages('success');
}
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Liste des Tâches</title>
    <link rel="stylesheet" href="assets/css/inscription_connexion.css">
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Liste des Tâches</h1>
        <a href="dashboard.php">Retour au Tableau de Bord</a>
    </div>

    <?php
    if (isset($_SESSION['success'])) {
        echo '<div id="success-message">' . $_SESSION['success'] . '</div>';
        unset($_SESSION['success']);
    }

    if (!empty($tasks)) {
        echo '<div class="card-container">';
        foreach ($tasks as $task) {
            $randomImageURL = 'https://picsum.photos/id/' . rand(1, 100) . '/200/200';
            $statusClass= '';

            $statusClassMap = [
                'À faire' => 'status-a-faire',
                'En cours' => 'status-en-cours',
                'Terminé' => 'status-termine',
            ];
            if (isset($statusClassMap[$task->getStatus()])){
                $statusClass = $statusClassMap[$task->getStatus()];
            }
            ?>
            <div class="card">
                <h2 class="card-m"><?= $task->getTitle() ?></h2>
                <p class="card-m">Description : <?= $task->getDescription() ?></p>
                <p class="card-m">Date d'échéance : <?= $task->getDueDate()->format('Y-m-d') ?></p>
                <p class="<?= $statusClass ?>">Statut : <?= $task->getStatus() ?></p>
                <a href="edit_task.php?task_id=<?= $task->getId() ?>" class="edit-link">Éditer</a>
                <img class="card-m" src="<?= $randomImageURL ?>" alt="Image aléatoire">
            </div>
            <?php
        }
        echo '</div>';
    } else {
        echo '<p>Aucune tâche trouvée.</p>';
    }
    ?>

</div>
<script src="assets/js/app.js"></script>
</body>
</html>
