<?php
session_start();
$pageTitle = 'login';
?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>ReSoC - Connexion</title>
    <meta name="author" content="Julien Falconnet">
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <?php include '..//Niveau1/src/templates/header-template.php' ?>


    <div id="wrapper">

        <aside>
            <h2>Présentation</h2>
            <p>Bienvenue sur notre réseau social.</p>
        </aside>
        <main>
            <article>
                <h2>Connexion</h2>
                <?php
                /**
                 * TRAITEMENT DU FORMULAIRE
                 */
                // Etape 1 : vérifier si on est en train d'afficher ou de traiter le formulaire
                // si on recoit un champs email rempli il y a une chance que ce soit un traitement


                $enCoursDeTraitement = isset($_POST['email']);

                if ($enCoursDeTraitement) {
                    // on ne fait ce qui suit que si un formulaire a été soumis.
                    // Initialisation des variables avec les contenus de motpasse et email
                    echo "<pre>" . print_r($_POST, 1) . "</pre>";
                    $emailAVerifier = $_POST['email'];
                    $passwdAVerifier = $_POST['motpasse'];


                    //Connexion avec la base de donnée.
                    include './src/methods/init-db.php';
                    //Etape 4 : Petite sécurité
                    // pour éviter les injection sql : https://www.w3schools.com/sql/sql_injection.asp
                    $emailAVerifier = $mysqli->real_escape_string($emailAVerifier);
                    $passwdAVerifier = $mysqli->real_escape_string($passwdAVerifier);
                    // on crypte le mot de passe pour éviter d'exposer notre utilisatrice en cas d'intrusion dans nos systèmes
                    password_hash($passwdAVerifier, PASSWORD_BCRYPT);



                    //Etape 5 : construction de la requete
                    $lInstructionSql = "SELECT * "
                        . "FROM users "
                        . "WHERE "
                        . "email LIKE '" . $emailAVerifier . "' ";

                    echo "<pre>" . print_r($_POST, 1) . "</pre>";

                    // Etape 6: Vérification de l'utilisateur
                    $res = $mysqli->query($lInstructionSql);

                    $user = $res->fetch_assoc();
                    // echo "<pre>"  .  print_r($userId, 1) . "</pre>";


                    if (password_verify($passwdAVerifier, $user['password'])) {
                        echo "Votre connexion est un succès : " . $user['alias'] . ".";
                        $_SESSION['connected_id'] = $user['id'];
                        // header("Location :  Niveau1/news.php");
                        // exit;
                    } else {
                        echo "La connexion a échoué. ";
                    }
                    if (isset($_POST['reset']) && ($_SESSION['connected_id'])) {
                        unset($_SESSION['connected_id']);
                    }
                }
                ?>
                <form action="login.php" method="post">
                    <input type='hidden' name='email' value='connexion'>
                    <dl>
                        <dt><label for='email'>E-Mail</label></dt>
                        <dd><input type='email' name='email' id="email"></dd>
                        <dt><label for='motpasse'>Mot de passe</label></dt>
                        <dd><input type='password' name='motpasse' id="motpasse"></dd>
                    </dl>
                    <input type='submit'>
                    <input type="submit" value="logout" name="reset">
                </form>
                <p>
                    Pas de compte?
                    <a href='registration.php'>Inscrivez-vous.</a>
                </p>

            </article>
        </main>
    </div>
</body>

</html>
