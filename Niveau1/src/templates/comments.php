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