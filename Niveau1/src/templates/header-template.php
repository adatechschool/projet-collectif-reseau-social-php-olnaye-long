<?php
session_start();
if (isset($_SESSION['connected_id'])) {
    $userIdForLink =  $_SESSION['connected_id']; ?>
    <header>
        <img src="./src/img/resoc.jpg" alt="Logo de notre réseau social" />
        <nav id="menu">

            <a href="news.php">Actualités</a>
            <a href="wall.php?user_id=<?= $userIdForLink ?>">Mur</a>
            <a href="feed.php?user_id=<?= $userIdForLink ?>">Flux</a>
            <a href="tags.php?tag_id=1">Mots-clés</a>
        </nav>
        <nav id="user">
            <a href="#">Profil</a>
            <ul>
                <li><a href="settings.php?user_id=<?= $userIdForLink ?>">Paramètres</a></li>
                <li><a href="followers.php?user_id=<?= $userIdForLink ?>">Mes suiveurs</a></li>
                <li><a href="subscriptions.php?user_id=<?= $userIdForLink ?>">Mes abonnements</a></li>
            </ul>
        </nav>
    </header>
<?php }
?>