<?php
$pageTitle = 'create-post';
?>
<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>ReSoC - Post</title>
    <meta name="author" content="Julien Falconnet">
    <link rel="stylesheet" href="style.css" />

    <?php include '..//Niveau1/src/templates/header-template.php' ?>
</head>

<div id="wrapper">

    <aside>
        <h2>Présentation</h2>
        <p>T'as vraiment besoin qu'on t'explique à quoi ça sert de faire un poste ?</p>
    </aside>

    <main>
        <article>
            <h2>Poster un message</h2>
            <?php
            include './src/methods/init-db.php';

            $enCoursDeTraitement = isset($_POST['message']);
            if ($enCoursDeTraitement) {
                $authorId = $userId;
                $postContent = $_POST['message'];

                $authorId = intval($authorId);

                $postContent = $mysqli->real_escape_string($postContent);

                //Etape 4 : construction de la requete
                $lInstructionSql = "INSERT INTO posts "
                . "(id, user_id, content, created, parent_id) "
                . "VALUES (NULL, "
                . $authorId . ", "
                . "'" . $postContent . "', "
                . "NOW(), "
                . "NULL, "
                . "1"
                . ");";

                // Etape 5 : execution
                $ok = $mysqli->query($lInstructionSql);
                if (!$ok) {
                    echo "Impossible d'envoyer le message: " . $mysqli->error;
                } else {
                    echo "Message envoyé !";
                    header("Refresh:3; url=news.php", true, 303);
                }
            }
            ?>
            <form action="create-post.php" method="post">
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