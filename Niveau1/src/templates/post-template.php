<?php
if (!isset($_SESSION['connected_id'])) {
    header("Location: login.php");
} else {

    include "password.php";
    include "./src/methods/like.php";

    // Vérifier si le formulaire a été soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Vérifier quelle fonction appeler en fonction du bouton cliqué
        if (isset($_POST['action']) && isset($_POST['id'])) {
            $id = $_POST['id'];
            switch ($_POST['action']) {
                case 'upVote':
                    upvote($id);
                    break;
                case 'downVote':
                    downVote($id);
                    break;
            }
        }
    }

    while ($post = $lesInformations->fetch_assoc()) {

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

                <!-- @todo : boucle while pour itérer chaque tag  comme dans feed & tags-->
                <!-- @todo : gérer le lien à mettre dans l'attribut href pour rediriger vers l'id -->
                <a href="">#<?php echo $post['taglist'] ?></a>
            </footer>
            <!-- onclick="myFunction()" <- dans le boutton
     <script>
         function myFunction() {
            event.preventDefault()
        };
    </script> -->
        </article>
    <?php }
} ?>