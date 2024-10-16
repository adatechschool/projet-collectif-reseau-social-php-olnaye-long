<?php
if (!isset($_SESSION['connected_id'])) {
    header("Location: login.php");
} else {

    include "password.php";
    include "./src/methods/like.php";

    while ($post = $lesInformations->fetch_assoc()) {
        if (!$post['parent_id']) {
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
                <small>💩 <?= getVotes($post['id']) ?></small>

                <form method="post" action="">
                    <input type="hidden" name="id" value="<?= $post['id'] ?>">

                    <button type="submit" name="action" value="upVote" class="likeButton">UpVote</button>
                    <button type="submit" name="action" value="downVote" class="likeButton">DownVote</button>
                </form>
                <button onclick="location.href = 'post.php?post_id=<?= $post['id'] ?>';">Commentaires</button>

                <!-- @todo : boucle while pour itérer chaque tag  comme dans feed & tags-->
                <!-- @todo : gérer le lien à mettre dans l'attribut href pour rediriger vers l'id -->
                <?php include './src/methods/get-tag-id.php' ?>
            </footer>
            <!-- onclick="myFunction()" <- dans le boutton
     <script>
         function myFunction() {
            event.preventDefault()
        };
    </script> -->
        </article>
<?php }}} ?>