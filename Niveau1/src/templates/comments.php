<?php
// $userId = intval($_GET['user_id']);
include "./src/methods/like.php";

$post = $lesInformations->fetch_assoc()
    ?>

<article>
    <?= $post['id'] ?>
    <h3>
        <time datetime='2020-02-01 11:12:13'><?= $post['created'] ?></time>
    </h3>
    <address>par <a href="./wall.php?user_id=<?= $post['user_id'] ?>"> <?= $post['author_name'] ?></a></address>
    <div>
        <p><?= $post['content'] ?></p>
    </div>

    <footer>
        <small>♥ <?= getVotes($post['id']) ?></small>

        <form method="post" action="">
            <input type="hidden" name="id" value="<?= $post['id'] ?>">

            <button type="submit" name="action" value="upVote" class="likeButton">UpVote</button>
            <button type="submit" name="action" value="downVote" class="likeButton">DownVote</button>
        </form>
    </footer>
</article>
<article>
    <?php
    $enCoursDeTraitement = isset($_POST['message']);
    if ($enCoursDeTraitement) {
        $authorId = $userId;
        $postContent = $_POST['message'];

        $authorId = intval($authorId);

        $postContent = $mysqli->real_escape_string($postContent);

        //Etape 4 : construction de la requete
        $lInstructionSql = "INSERT INTO comments "
            . "(id, user_id, content, created, parent_id) "
            . "VALUES (NULL, "
            . $authorId . ", "
            . "'" . $postContent . "', "
            . "NOW(),"
            . $post['id'] . ");";

        // Etape 5 : execution
        $ok = $mysqli->query($lInstructionSql);
        if (!$ok) {
            echo "Impossible d'envoyer le commentaire: " . $mysqli->error;
        } else {
            echo "Commentaire envoyé !";
        }
    }
    ?>
    <form method="post">
        <dl>
            <dt><label for='message'>Message</label></dt>
            <dd><textarea name='message'></textarea></dd>
        </dl>
        <input type='submit'>
    </form>
</article>