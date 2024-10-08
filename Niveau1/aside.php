<aside>
    <?php
    /**
     * Etape 3.1: récupérer le nom de l'utilisateur
     */
    $laQuestionEnSql = "SELECT * FROM `users` WHERE id= '$userId' ";
    $lesInformations = $mysqli->query($laQuestionEnSql);
    $user = $lesInformations->fetch_assoc();
    $userAlias = $user['alias'];
    //echo "<pre>" . print_r($user, 1) . "</pre>";
    ?>
    <img src="user.jpg" alt="Portrait de l'utilisatrice" />
    <section>
        <h3>Présentation</h3>
        <p><?php
            echo ($pageTitle == 'feed') ? "Sur cette page vous trouverez tous les messages des utilisatrices auxquelles est abonnée {$userAlias}." : "";
            echo ($pageTitle == 'followers') ? "Sur cette page vous trouverez la liste des personnes qui suivent {$userAlias}." : "";
            echo ($pageTitle == 'news') ? "Sur cette page vous trouverez les derniers messages de tous les utilisatrices du site." : "";
            ?>
        </p>

    </section>
</aside>