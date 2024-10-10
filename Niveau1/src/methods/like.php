<?php

$pageTitle = 'likeFunction';

include "init-db.php";

var_dump($_GET);

if (isset($_GET['t'], $_GET['user_id'], $_GET['id']) && $_GET['t'] !== '' && !empty($_GET['id'])) {
    $gett = (int) $_GET['t'];
    $getUserId = (int) $_GET['user_id'];
    $getid = (int) $_GET['id'];

    echo "<pre>t: " . print_r($gett, 1) . " user id: " . print_r($getUserId, 1) . " id: " .print_r($getid, 1) . "</pre>";

    try {
        $check = $bdd->prepare('SELECT id FROM posts WHERE id = $getid');
        $check->execute(array($getid));

        echo "Nombre de résultats : " . $check->rowCount() . "<br>";

        if ($check->rowCount() == 1) {
            if ($gett == 0) {
                $ins = $bdd->prepare('INSERT INTO likes (post_id) VALUE (?)');
            } elseif ($gett == 1) {
                $ins = $bdd->prepare('INSERT INTO dislikes (post_id) VALUE (?)');
            }
            echo "Debugging before redirection";  // Ajoute un écho ici pour vérifier
            exit();  // Empêche la redirection pour tester
            // header('Location: '. $_SERVER['HTTP_REFERER']);
        }


    } catch (Exception $e) {
        echo "Erreur SQL : " . $e->getMessage();
    }
}
 