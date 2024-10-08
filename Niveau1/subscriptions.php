<?php $pageTitle = "subscriptions" ?>


<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>ReSoC - Mes abonnements</title>
    <meta name="author" content="Julien Falconnet">
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <?php include 'header.php'; ?>

    <div id="wrapper">

        <?php
        include 'init-db.php';
        include 'aside.php';
        ?>

        <main class='contacts'>
            <?php
            $laQuestionEnSql = "
                    SELECT users.*
                    FROM followers
                    LEFT JOIN users ON users.id=followers.followed_user_id
                    WHERE followers.following_user_id='$userId'
                    GROUP BY users.id
                    ";
                    include 'follow-template.php';
                ?>
        </main>
    </div>
</body>

</html>
