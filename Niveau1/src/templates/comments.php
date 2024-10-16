<?php
// $userId = intval($_GET['user_id']);
include "./src/methods/like.php";

$post = $lesInformations->fetch_assoc();
if ($post['parent_id']) {
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
        $lInstructionSql = "INSERT INTO posts "
            . "(id, user_id, content, created, parent_id) "
            . "VALUES (NULL, "
            . $authorId . ", "
            . "'" . $postContent . "', "
            . "NOW(),"
            . $post['id'] . ", "
            . "0"
            . ");";

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

<?php
$laQuestionEnSql = "SELECT posts.content, posts.created, posts.id, posts.user_id, users.alias
                    FROM posts
                    JOIN users ON users.id = posts.user_id
                    WHERE posts.parent_id = " . $post['id'] . "; 
                    ";

include './src/methods/fetch.php';  
while ($comment = $lesInformations->fetch_assoc()) {
    ?>
    <article>
        <?= $comment['id'] ?>
        <h3>
            <time datetime='2020-02-01 11:12:13'><?= $comment['created'] ?></time>
        </h3>
        <address>par <a href="./wall.php?user_id=<?= $comment['user_id'] ?>"> <?= $comment['alias'] ?></a></address>
        <div>
            <p><?= $comment['content'] ?></p>
        </div>

        <footer>
            <small>♥ <?= getVotes($comment['id']) ?></small>

            <form method="post" action="">
                <input type="hidden" name="id" value="<?= $comment['id'] ?>">

                <button type="submit" name="action" value="upVote" class="likeButton">UpVote</button>
                <button type="submit" name="action" value="downVote" class="likeButton">DownVote</button>
                <button onclick="location.href = 'post.php?post_id=<?= $comment['id'] ?>';">Commentaires</button>
            </form>
            <?php include './src/methods/get-tag-id.php' ?>
        </footer>

    </article>
<?php }} ?>