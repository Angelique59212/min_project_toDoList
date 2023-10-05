<?php
function getMessages(string $type) {
    if (isset($_SESSION[$type])) { ?>
        <div class="message-<?= $type ?>">
            <p><?= $_SESSION[$type] ?></p>
        </div> <?php
        unset($_SESSION[$type]);
    }
}

// success messages.
getMessages('success');

if (isset($_GET['login']) && $_GET['login'] === 'success') {
    echo '<div id="success-message">Connexion réussie !</div>';
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

<script src="assets/js/app.js"></script>
</body>
</html>



