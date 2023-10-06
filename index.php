<?php
require_once 'utils/DBconnect.php';
require_once 'model/User.php';
require_once 'model/Task.php';
require_once 'dao/UserDao.php';
require_once 'dao/TaskDao.php';
require_once 'dao/imp/UserDaoImp.php';
require_once 'dao/imp/TaskDaoImp.php';
require_once 'services/UserService.php';

?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>To Do List</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div id="container">
        <div id="header">
            <h1>To Do List</h1>
            <a href="inscription.php">Inscription</a>
            <a href="connexion.php">Connexion</a>
        </div>
        <div id="container-intro">
            <div id="intro">
                <p>N'hésitez pas à vous inscrire afin de profiter de votre ToDoList</p>
                <p>
                     To Do List vous permettra de gérer vos tâches en fonction de la priorité et de ne pas en oublier !
                </p>
            </div>
        </div>

    </div>
</body>
</html>
