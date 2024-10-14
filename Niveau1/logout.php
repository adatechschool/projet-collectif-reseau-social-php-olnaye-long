<?php $pageTitle = "logout" ?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>ReSoC - Logout</title>
    <meta name="author" content="Julien Falconnet">
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <?php include './src/templates/header-template.php'; ?>

    <div id="wrapper" class='profile'>

        <?php
        include './src/methods/init-db.php';
        include './src/templates/aside-template.php';
        if (isset($_POST['reset']) && isset($_SESSION['connected_id'])) {
            session_unset();
            session_destroy();
            header("Location:  login.php");
            exit();
        }
        ?>

        <main>
            <article class="parameters">
                <form action="login.php" method="post">
                    <p>Voulez-vous vous déconnecter ?</p>
                    <input type="submit" value="Deconnexion" name="reset">
            </article>
        </main>
        </form>
    </div>
</body>

</html>
