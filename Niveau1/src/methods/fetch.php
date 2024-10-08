<?php
$lesInformations = $mysqli->query($laQuestionEnSql);
if (!$lesInformations) {
    echo ("Échec de la requete : " . $mysqli->error);
}
$user = $lesInformations->fetch_assoc();

