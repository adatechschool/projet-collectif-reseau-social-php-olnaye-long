<?php

$pageTitle = 'likeFunction';

include "init-db.php";
include "../../password.php";

$bdd = new mysqli($dbHostname, $dbUser, $dbPassword, $dbName);

if (isset($_GET['t'], $_GET['id']) and !empty($_GET['t']) and !empty($_GET['id'])) {
    $gett = (int) $_GET['t'];
    $getUserId = 5; // récupérer la variable de connexion
    $getId = (int) $_GET['id'];

    if ($gett == 1) {
        $ins = $bdd->prepare('INSERT INTO likes (post_id, user_id) VALUES (?, ?)');
        $ins->execute(array($getId, $getUserId));
    } elseif ($gett == 2) {
        $ins = $bdd->prepare('INSERT INTO dislikes (post_id, user_id) VALUES (?, ?)');
        $ins->execute(array($getId, $getUserId));
    }
}