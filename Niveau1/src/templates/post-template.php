<?php
if (!isset($_SESSION['connected_id'])) {
    header("Location: login.php");
} else {

    include "password.php";

    function countComments($info,  $count = 0)
    {
        while ($post = $info->fetch_assoc()) {
            $count++;
            $laQuestion3EnSql = "SELECT posts.id
            FROM posts
            WHERE posts.parent_id = " . $post['id'] . "; 
            ";

            $lesInformations3 = $GLOBALS["mysqli"]->query($laQuestion3EnSql);
            $count = countComments($lesInformations3, $count);
        }
        return $count;
    }

    function showComments($info, $indentation = 0): void
    {
        $sessionId = $_SESSION['connected_id'];

        while ($post = $info->fetch_assoc()) {
            $check_like = $GLOBALS["mysqli"]->prepare('SELECT COUNT(id) AS count FROM likes WHERE post_id = ? AND user_id = ?');
            $check_like->bind_param('ii', $post['id'], $sessionId);
            $check_like->execute();
            $like_result = $check_like->get_result();
            $like_row = $like_result->fetch_assoc();

            $check_dislike = $GLOBALS["mysqli"]->prepare('SELECT COUNT(id) AS count FROM dislikes WHERE post_id = ? AND user_id = ?');
            $check_dislike->bind_param('ii', $post['id'], $sessionId);
            $check_dislike->execute();
            $dislike_result = $check_dislike->get_result();
            $dislike_row = $dislike_result->fetch_assoc();
            ?>


            <article style="position: relative; left:<?= $indentation ?>px; width: calc(900px - <?= $indentation ?>px)">
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

                        <button type="submit" name="action" value="upVote" class="likeButton"
                            style="<?php if ($like_row['count']) {
                                echo 'background-color:#FFDBB5; color: #603F26;';
                            } ?>;">UpVote</button>
                        <button type="submit" name="action" value="downVote" class="likeButton"
                            style="<?php if ($dislike_row['count']) {
                                echo 'background-color:#FFDBB5; color: #603F26;';
                            } ?>;">DownVote</button>
                        <button type="button" onclick="location.href = 'post.php?post_id=<?= $post['id'] ?>';">
                            <?php
                            if (isset($_GET['post_id'])) {
                                echo 'Répondre';
                            } else {
                                echo countComments($GLOBALS["mysqli"]->query("SELECT * FROM posts WHERE posts.parent_id = " . $post['id'])) . " commentaires";
                            }
                            ?>
                        </button>
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
showComments($lesInformations) ?>