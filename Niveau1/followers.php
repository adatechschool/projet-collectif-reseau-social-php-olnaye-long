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
        <aside>
            <?php
            $laQuestionEnSql = "SELECT * FROM users WHERE id= '$userId' ";
            $lesInformations = $mysqli->query($laQuestionEnSql);
            $user = $lesInformations->fetch_assoc();
            ?>
            <img src="user.jpg" alt="Portrait de l'utilisatrice" />
            <section>
                <h3>Présentation</h3>
                <!-- idée : mettre un if (si c'est nous qui sommes connectés, alors c'est "qui vous suivent") -->
                <p>Sur cette page vous trouverez la liste des personnes qui
                    suivent <?php echo $user['alias'] ?></p>
            </section>
        </aside>
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