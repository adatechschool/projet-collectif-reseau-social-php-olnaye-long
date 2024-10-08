<?php $pageTitle = 'followers' ?>

<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>ReSoC - Mes abonnés </title>
    <meta name="author" content="Julien Falconnet">
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <?php include 'header.php'; ?>

    <div id="wrapper">
        <?php
        // Etape 1: récupérer l'id de l'utilisateur
        $userId = intval($_GET['user_id']);
        // Etape 2: se connecter à la base de donnée
        $mysqli = new mysqli("localhost", "root", "", "socialnetwork");
        ?>
        <?php include 'aside.php' ?>
        <main class='contacts'>
            <?php
            $laQuestionEnSql = "
                    SELECT users.*
                    FROM followers
                    LEFT JOIN users ON users.id=followers.following_user_id
                    WHERE followers.followed_user_id='$userId'
                    GROUP BY users.id
                    ";
            $lesInformations = $mysqli->query($laQuestionEnSql);
            // Etape 4: à vous de jouer
            while ($followers = $lesInformations->fetch_assoc()) {
                // echo "<pre>" . print_r($followers, 1) . "</pre>";

            ?>
                <article>
                    <img src="user.jpg" alt="blason" />
                    <h3><?php echo $followers['alias'] ?></h3>
                    <p>id:<?php echo $followers['id'] ?></p>
                </article>
            <?php } ?>
        </main>
    </div>
</body>

</html>