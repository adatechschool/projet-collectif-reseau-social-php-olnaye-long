<?php
while ($post = $lesInformations->fetch_assoc()) {
    ?>

    <article>
        
        <h3>
            <time datetime='2020-02-01 11:12:13'><?= $post['created'] ?></time>
        </h3>
        <address>par <a href="./wall.php?user_id=<?= $post['user_id'] ?>"> <?= $post['author_name'] ?></a></address>
        <div>
            <p><?= $post['content'] ?></p>
        </div>
        
        <footer>
            <small>♥ <?= $post['like_number'] ?></small>
            
            <a href="src/methods/like.php?t=1&user_id=<?= $post['user_id'] ?>&id=<?= $post['id'] ?>">J'aime ce contenu</a>
            <a href="src/methods/like.php?t=2&user_id=<?= $post['user_id'] ?>&id=<?= $post['id'] ?>">Ce contenu ne m'apporte pas de plaisir</a>
            <!-- @todo : boucle while pour itérer chaque tag  comme dans feed & tags-->
            <!-- @todo : gérer le lien à mettre dans l'attribut href pour rediriger vers l'id -->
            <a href="">#<?php echo $post['taglist'] ?></a>
        </footer>
    </article>
<?php } ?>
