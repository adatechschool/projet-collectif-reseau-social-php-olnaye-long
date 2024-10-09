<?php
while ($post = $lesInformations->fetch_assoc()) {
    ?>
    <article>
     <?php ?>   
        <h3>
            <time datetime='2020-02-01 11:12:13'><?php echo $post['created'] ?></time>
        </h3>
        <address>par <?php echo $post['author_name'] ?></address>
        <div>
            <p><?php echo $post['content'] ?></p>
        </div>
        <footer>
            <small>♥ <?php echo $post['like_number'] ?></small>
            <!-- @todo : boucle while pour itérer chaque tag  comme dans feed & tags-->
            <!-- @todo : gérer le lien à mettre dans l'attribut href pour rediriger vers l'id -->
            <a href="">#<?php echo $post['taglist'] ?></a>
        </footer>
    </article>
<?php } ?>
