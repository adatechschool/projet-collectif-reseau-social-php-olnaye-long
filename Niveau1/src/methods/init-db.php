<?php
include 'password.php';
// connexion à la base de donnée
$mysqli = new mysqli($dbHostname, $dbUser, $dbPassword, $dbName);

if ($mysqli->connect_errno) {
    echo ("Échec de la connexion : " . $mysqli->connect_error);
    exit();
}
// Etape 1: Les paramètres concernent une utilisatrice en particulier
if (isset($_GET['user_id'])) {
    $userId = intval($_GET['user_id']);
    $laQuestionEnSql = "SELECT * FROM `users` WHERE id= '$userId' ";

    $lesInformations = $mysqli->query($laQuestionEnSql);
    $user = $lesInformations->fetch_assoc();
    $userAlias = $user['alias'];
} elseif (isset($_GET['tag_id'])) {
    $tagId = intval($_GET['tag_id']);
    $laQuestionEnSql = "SELECT * FROM tags WHERE id= '$tagId' ";

    $lesInformations = $mysqli->query($laQuestionEnSql);
    $tag = $lesInformations->fetch_assoc();
} elseif ($pageTitle == 'admin') {
    $laQuestionEnSql = "SELECT * FROM `tags` LIMIT 50";
    $lesInformations = $mysqli->query($laQuestionEnSql);
} elseif ($pageTitle == 'usurpedpost') {
    $laQuestionEnSql = "SELECT * FROM users";
    $lesInformations = $mysqli->query($laQuestionEnSql);
}
