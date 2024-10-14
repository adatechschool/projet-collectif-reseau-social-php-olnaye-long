<?php
// session_start();

// if (!isset($_SESSION['connected_id'])) {
//     header("Location: login.php");
// } else {

include "password.php";


$BDD = new mysqli($dbHostname, $dbUser, $dbPassword, $dbName);
$sessionId = 5;   // user_id codé en dur

// début de refacto, a retravailler si possible

// function checkVotes($id, $query, $sessionId = 'user_id')
// {
//     global $BDD;

//     $check_votes = $BDD->prepare($query);

//     if ($check_votes === false) {
//         die('Erreur lors de la préparation de la requête : ' . $BDD->error);
//     }

//     $check_votes->bind_param('is', $id, $sessionId);
//     var_dump($check_votes);
//     $check_votes->execute();

//     $result = $check_votes->get_result();

//     if ($sessionId == 'user_id') {
//         if ($result->num_rows > 0) {
//             $row = $result->fetch_assoc();
//             return (int) $row['count'];
//         } else {
//             return 0;
//         }
//     } else {
//         return $result;
//     }
// }

function getVotes($id)
{
    global $BDD;

    // $likesCount = checkVotes($id, 'SELECT COUNT(id) AS count FROM likes WHERE post_id = ? AND user_id = ?');
    // $dislikesCount = checkVotes($id, 'SELECT COUNT(id) AS count FROM dislikes WHERE post_id = ? AND user_id = ?');
    // echo $dislikesCount . " ";
    // echo $likesCount;

    $check_all_likes = $BDD->prepare('SELECT COUNT(id) AS count FROM likes WHERE post_id = ?');
    $check_all_likes->bind_param('i', $id);
    $check_all_likes->execute();
    $likes_result = $check_all_likes->get_result();
    $row = $likes_result->fetch_assoc();
    $likes_Count = $row['count'];

    $check_all_dislike = $BDD->prepare('SELECT COUNT(id) AS count FROM dislikes WHERE post_id = ?');
    $check_all_dislike->bind_param('i', $id);
    $check_all_dislike->execute();
    $dislikes_result = $check_all_dislike->get_result();
    $row = $dislikes_result->fetch_assoc();
    $dislikes_Count = $row['count'];

    $total_likes = $likes_Count - $dislikes_Count;

    return (string) $total_likes;
}


function upvote($id)
{
    global $BDD;
    global $sessionId;
    if ($BDD->connect_error) {
        die('Erreur de connexion (' . $BDD->connect_errno . ') ' . $BDD->connect_error);
    }

    $check_like = $BDD->prepare('SELECT id FROM likes WHERE post_id = ? AND user_id = ?');
    $check_like->bind_param('ii', $id, $sessionId);
    $check_like->execute();
    $like_result = $check_like->get_result();

    if ($like_result->num_rows >= 1) {
        $del = $BDD->prepare('DELETE FROM likes WHERE post_id = ? AND user_id = ?');
        $del->bind_param('ii', $id, $sessionId);
        $del->execute();
    } else {
        $ins = $BDD->prepare('INSERT INTO likes (post_id, user_id) VALUES (?, ?)');
        $ins->bind_param('ii', $id, $sessionId);
        $ins->execute();

        $del = $BDD->prepare('DELETE FROM dislikes WHERE post_id = ? AND user_id = ?');
        $del->bind_param('ii', $id, $sessionId);
        $del->execute();
    }
}

function downVote($id)
{
    global $BDD;
    global $sessionId;

    if ($BDD->connect_error) {
        die('Erreur de connexion (' . $BDD->connect_errno . ') ' . $BDD->connect_error);
    }

    // $result = checkVotes($id, 'SELECT id FROM dislikes WHERE post_id = ? AND user_id = ?', $sessionId);

    $check_dislike = $BDD->prepare('SELECT id FROM dislikes WHERE post_id = ? AND user_id = ?');
    $check_dislike->bind_param('ii', $id, $sessionId);
    $check_dislike->execute();
    $dislike_result = $check_dislike->get_result();

    if ($dislike_result->num_rows >= 1) {
        $del = $BDD->prepare('DELETE FROM dislikes WHERE post_id = ? AND user_id = ?');
        $del->bind_param('ii', $id, $sessionId);
        $del->execute();
    } else {
        $ins = $BDD->prepare('INSERT INTO dislikes (post_id, user_id) VALUES (?, ?)');
        $ins->bind_param('ii', $id, $sessionId);
        $ins->execute();

        $del = $BDD->prepare('DELETE FROM likes WHERE post_id = ? AND user_id = ?');
        $del->bind_param('ii', $id, $sessionId);
        $del->execute();
    }
}

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

                <button onclick="upvote()" name="action" value="upVote">UpVote</button>
                <button type="submit" name="action" value="downVote">DownVote</button>
            </form>

            <!-- @todo : boucle while pour itérer chaque tag  comme dans feed & tags-->
            <!-- @todo : gérer le lien à mettre dans l'attribut href pour rediriger vers l'id -->
            <a href="">#<?php echo $post['taglist'] ?></a>
        </footer>
    </article>
<?php //}
} ?>