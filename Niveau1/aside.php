<aside>
    <?php
    /**
     * Etape 3.1: récupérer le nom de l'utilisateur
     */
    $laQuestionEnSql = "SELECT * FROM `users` WHERE id= '$userId' ";
    $lesInformations = $mysqli->query($laQuestionEnSql);
    $user = $lesInformations->fetch_assoc();
    //echo "<pre>" . print_r($user, 1) . "</pre>";
    ?>
    <img src="user.jpg" alt="Portrait de l'utilisatrice" />
    <section>
        <h3>Présentation</h3>