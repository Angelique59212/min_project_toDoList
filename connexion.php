<?php
session_start();

require_once 'utils/DBconnect.php';
require_once 'model/User.php';
require_once 'dao/UserDao.php';
require_once 'dao/imp/UserDaoImp.php';
require_once 'services/UserService.php';

$userDao = new UserDaoImp();
$userService = new UserService();

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $loginUser = $userService->login($email, $password);
}
?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Connexion</title>
    <link rel="stylesheet" href="assets/css/inscription_connexion.css">
</head>
<body>
<div class="container">
    <div class="header">
        <h1>Connexion</h1>
        <a href="index.php">Accueil</a>
    </div>
    <img src="assets/images/bloc-to-do-list.jpeg" alt="to_do_list">
    <div class="form">
        <form action="connexion.php" method="post">
            <label for="email">E-Mail</label>
            <input type="text" name="email" id="email" required>

            <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password" required>

            <input type="submit" name="submit" value="Se connecter">
        </form>
    </div>
</div>
<script src="assets/js/app.js"></script>
</body>
</html>
