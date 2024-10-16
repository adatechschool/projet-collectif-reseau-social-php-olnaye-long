<?php
if (!isset($_SESSION['connected_id'])) {
    header("Location: login.php");
} else {

    include "password.php";

     function showComments($info, $indentation = 0): void {

    while ($post = $info->fetch_assoc()) {
        ?>

        <article style="position: relative; left:<?= $indentation ?>px">
            <h3>
                <time datetime='2020-02-01 11:12:13'><?= $post['created'] ?></time>
            </h3>
            <address>par <a href="./wall.php?user_id=<?= $post['user_id'] ?>"> <?= $post['author_name'] ?></a></address>
            <div>
                <p><?= $post['content'] ?></p>
            </div>

            <footer>
                <small>💩 <?= getVotes($post['id']) ?></small>

                <form method="post" action="" id="post-form">
                    <input type="hidden" name="id" value="<?= $post['id'] ?>">

                    <button type="submit" name="action" value="upVote" class="likeButton">UpVote</button>
                    <button type="submit" name="action" value="downVote" class="likeButton">DownVote</button>
                    <button type="button" onclick="location.href = 'post.php?post_id=<?= $post['id'] ?>';"><?php if (isset($_GET['post_id'])) {
            echo 'Commenter';} else {echo 'Commentaires';} ?></button>
                </form>


                <?php include './src/methods/get-tag-id.php' ?>
            </footer>
            <!-- onclick="myFunction()" <- dans le boutton
            <script>
         function myFunction() {
            event.preventDefault()
        };
    </script> -->
        </article>
        <?php
        $laQuestion2EnSql = "SELECT posts.content, posts.created, posts.id, posts.user_id, users.alias as author_name
                    FROM posts
                    JOIN users ON users.id = posts.user_id
                    WHERE posts.parent_id = " . $post['id'] . "; 
                    ";

        $lesInformations2 = $GLOBALS["mysqli"]->query($laQuestion2EnSql);
        if (isset($_GET['post_id'])) {
            showComments($lesInformations2, $indentation + 50);
        }
     }
    }
}
showComments($lesInformations)?>
