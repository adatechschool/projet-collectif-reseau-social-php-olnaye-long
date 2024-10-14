<?php
session_start();
if (isset($_SESSION['connected_id'])) {
    $userId =  $_SESSION['connected_id']; ?>
    <header>
        <img src="./src/img/resoc.jpg" alt="Logo de notre réseau social" />
        <nav id="menu">

            <a href="news.php">Actualités</a>
            <a href="wall.php?user_id=<?= $userId ?>">Mur</a>
            <a href="feed.php?user_id=<?= $userId ?>">Flux</a>
            <a href="tags.php?tag_id=1">Mots-clés</a>
            <a href="post.php">Ecrire un post</a>
        </nav>
        <nav id="user">
            <a href="#">Profil</a>
            <ul>
                <li><a href="settings.php?user_id=<?= $userId ?>">Paramètres</a></li>
                <li><a href="followers.php?user_id=<?= $userId ?>">Mes suiveurs</a></li>
                <li><a href="subscriptions.php?user_id=<?= $userId ?>">Mes abonnements</a></li>
            </ul>
        </nav>
    </header>
<?php }
?>