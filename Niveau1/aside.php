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
        <!-- <p>Sur cette page vous trouverez tous les message des utilisatrices
            auxquel est abonnée l'utilisatrice <? //php echo $user['alias'] 
                                                ?>
        </p> -->
        <p><?php echo ($pageTitle == 'feed') ? "Sur cette page vous trouverez tous les messages des utilisatrices auxquelles est abonnée l'utilisatrice " . $userAlias . '.' : "condition non remplie"; ?></p>

    </section>
</aside>