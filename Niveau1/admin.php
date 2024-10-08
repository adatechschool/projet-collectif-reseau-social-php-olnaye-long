<?php $pageTitle = 'admin'
    ?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>ReSoC - Administration</title>
    <meta name="author" content="Julien Falconnet">
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <?php include 'header.php';
    include 'init-db.php';
    ?>

    <div id="wrapper" class='admin'>
        <?php include 'admin-tags.php';
        include 'admin-users.php' ?>
    </div>
</body>

</html>
