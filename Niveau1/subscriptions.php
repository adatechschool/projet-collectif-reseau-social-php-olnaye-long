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
            $lesInformations = $mysqli->query($laQuestionEnSql);
            // Etape 4: Afficher les utilisatrices suivies.
            
            while ($subscribed = $lesInformations->fetch_assoc()) {
                // echo "<pre>" . print_r($subscribed, 1) . "</pre>";
            
                ?>
                <article>
                    <img src="user.jpg" alt="blason" />
                    <h3><?php echo $subscribed['alias'] ?></h3>
                    <p>id:<?php echo $subscribed['id'] ?></p>
                </article>
            <?php } ?>
        </main>
    </div>
</body>

</html>