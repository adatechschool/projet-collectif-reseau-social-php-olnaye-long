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
        <aside>
            <h2>Mots-clés</h2>
            <?php


            //Etape 3 : @todo : Afficher les mots clés en s'inspirant de ce qui a été fait dans news.php
            while ($tag = $lesInformations->fetch_assoc()) {
                //echo "<pre>" . print_r($tag, 1) . "</pre>";
                ?>
                <article>
                    <h3>#<?php echo $tag['label'] ?></h3>
                    <p>id:<?php echo $tag['id'] ?></p>
                    <nav>
                        <a href="tags.php?tag_id=<?php echo $tag['label'] ?>">Messages</a>
                    </nav>
                </article>
            <?php } ?>
        </aside>
        <main>
            <h2>Utilisatrices</h2>
            <?php
            //Etape 4 : trouver tous les mots clés
            $laQuestionEnSql = "SELECT * FROM `users` LIMIT 50";
            $lesInformations = $mysqli->query($laQuestionEnSql);
            // Vérification
            if (!$lesInformations) {
                echo ("Échec de la requete : " . $mysqli->error);
                exit();
            }

            //Etape 5 : @todo : Afficher les utilisatrices en s'inspirant de ce qui a été fait dans news.php
            while ($users = $lesInformations->fetch_assoc()) {
                //echo "<pre>" . print_r($users, 1) . "</pre>";
                ?>
                <article>
                    <h3><?php echo $users['alias'] ?></h3>
                    <p>id:<?php echo $users['id'] ?></p>
                    <nav>
                        <a href="wall.php?user_id=<?php echo $users['id'] ?>">Mur</a>
                        | <a href="feed.php?user_id=<?php echo $users['id'] ?>">Flux</a>
                        | <a href="settings.php?user_id=<?php echo $users['id'] ?>">Paramètres</a>
                        | <a href="followers.php?user_id=<?php echo $users['id'] ?>">Suiveurs</a>
                        | <a href="subscriptions.php?user_id=<?php echo $users['id'] ?>">Abonnements</a>
                    </nav>
                </article>
            <?php } ?>
        </main>
    </div>
</body>

</html>
