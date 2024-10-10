<?php

// include 'src/methods/init-db.php';
include "password.php";
$BDD = new mysqli($dbHostname, $dbUser, $dbPassword, $dbName);

function upvote($id)
{
    global $BDD;
    $sessionId = 5;  // user_id codé en dur

    if ($BDD->connect_error) {
        die('Erreur de connexion (' . $BDD->connect_errno . ') ' . $BDD->connect_error);
    }

    // Vérification du like existant
    $check_like = $BDD->prepare('SELECT id FROM likes WHERE post_id = ? AND user_id = ?');
    $check_like->bind_param('ii', $id, $sessionId);
    $check_like->execute();
    $result = $check_like->get_result();

    // Si le like existe, on le supprime, sinon on l'ajoute
    if ($result->num_rows >= 1) {
        $del = $BDD->prepare('DELETE FROM likes WHERE post_id = ? AND user_id = ?');
        $del->bind_param('ii', $id, $sessionId);
        $del->execute();
    } else {
        $ins = $BDD->prepare('INSERT INTO likes (post_id, user_id) VALUES (?, ?)');
        $ins->bind_param('ii', $id, $sessionId);
        $ins->execute();
    }

    // Récupération du nombre de like et transformation du format mysqli_stmt en string
    $votesCount = $BDD->prepare('SELECT count(id) from likes where post_id = ?');
    $votesCount->bind_param('i', $id);
    $votesCount->execute();

    $result = $votesCount->get_result();
    $row = $result->fetch_array();
    
    $likesCount = $row[0];

    return (string)$likesCount;
}

function downVote($id)
{
    return "Fonction 2 a été exécutée avec succès avec l'ID : $id";
}

$upCount;

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifier quelle fonction appeler en fonction du bouton cliqué
    if (isset($_POST['action']) && isset($_POST['id'])) {
        $id = $_POST['id']; // Récupérer l'ID
        switch ($_POST['action']) {
            case 'upVote':
                $voteCount = upvote($id);
                break;
            case 'downVote':
                $voteCount = downVote($id);
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
        <?= $voteCount ?>
        <footer>
            <small>♥ <?= $post['like_number'] ?></small>

            <form method="post" action="">
                <input type="hidden" name="id" value="<?= $post['id'] ?>">

                <button type="submit" name="action" value="upVote">UpVote</button>
                <button type="submit" name="action" value="downVote">DownVote</button>
            </form>

            <!-- @todo : boucle while pour itérer chaque tag  comme dans feed & tags-->
            <!-- @todo : gérer le lien à mettre dans l'attribut href pour rediriger vers l'id -->
            <a href="">#<?php echo $post['taglist'] ?></a>
        </footer>
    </article>
<?php } ?>