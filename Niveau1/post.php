<?php
session_start();

if (!isset($_SESSION['connected_id'])) {
    header("Location: login.php");
} else {

$pageTitle = 'post';
?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>ReSoC - Post d'usurpateur</title>
        <meta name="author" content="Julien Falconnet">
        <link rel="stylesheet" href="style.css"/>

        <?php include '..//Niveau1/src/templates/header-template.php' ?>


        <div id="wrapper" >

            <aside>
                <h2>Présentation</h2>
                <p>Sur cette page on peut poster un message en se faisant
                    passer pour quelqu'un d'autre</p>
            </aside>

            <main>
                <article>
                    <h2>Poster un message</h2>
                    <?php
                    include './src/methods/init-db.php';

                    $enCoursDeTraitement = isset($_POST['message']);
                    if ($enCoursDeTraitement)
                    {
                        $authorId = $_SESSION['connected_id'];
                        $postContent = $_POST['message'];

                        $authorId = intval($authorId);

                        $postContent = $mysqli->real_escape_string($postContent);

                        //Etape 4 : construction de la requete
                        $lInstructionSql = "INSERT INTO posts "
                                . "(id, user_id, content, created) "
                                . "VALUES (NULL, "
                                . $authorId . ", "
                                . "'" . $postContent . "', "
                                . "NOW());"
                                ;

                        // Etape 5 : execution
                        $ok = $mysqli->query($lInstructionSql);
                        if ( ! $ok)
                        {
                            echo "Impossible d'envoyer le message: " . $mysqli->error;
                        } else
                        {
                            echo "Message envoyé !";
                        }
                    }
                    ?>
                    <form action="post.php" method="post">
                        <dl>
                            <dt><label for='message'>Message</label></dt>
                            <dd><textarea name='message'></textarea></dd>
                        </dl>
                        <input type='submit'>
                    </form>
                </article>
            </main>
        </div>
    </body>
</html>
<?php } ?>