<?php
// connexion à la base de donnée
$mysqli = new mysqli("localhost", "root", "", "socialnetwork");

// Etape 1: Les paramètres concernent une utilisatrice en particulier
if (isset($_GET['user_id'])) {
    $userId = intval($_GET['user_id']);
    $laQuestionEnSql = "SELECT * FROM `users` WHERE id= '$userId' ";

    $lesInformations = $mysqli->query($laQuestionEnSql);
    $user = $lesInformations->fetch_assoc();
    $userAlias = $user['alias'];
}
elseif (isset($_GET['tag_id'])) {
    $tagId = intval($_GET['tag_id']);
    $laQuestionEnSql = "SELECT * FROM tags WHERE id= '$tagId' ";
    
    $lesInformations = $mysqli->query($laQuestionEnSql);
    $tag = $lesInformations->fetch_assoc();
}