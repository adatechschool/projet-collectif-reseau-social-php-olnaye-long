<?php
if (isset($post['taglist'])) {
    $tagLink = $post['taglist'];
    $getTagId = $BDD->prepare('SELECT id, label FROM tags WHERE label = ?');
    $getTagId->bind_param('s', $tagLink);
    $getTagId->execute();
    $result = $getTagId->get_result();
    $hashtag = $result->fetch_assoc();

    if ($hashtag) {
        $tagIdLink = $hashtag['id'];
        echo $tagIdLink;
?>
        <!-- @todo : boucle while pour itérer chaque tag  comme dans feed & tags-->
        <!-- @todo : gérer le lien à mettre dans l'attribut href pour rediriger vers l'id -->
        <a href="tags.php?tag_id=<?= $tagIdLink ?>">#<?= $post['taglist'] ?></a>
<?php
    } else {
        echo "No tag found.";
    }
}
?>