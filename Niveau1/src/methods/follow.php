<?php if ($pageTitle == 'wall') {
    // $connectedId = $connected_id;
    //Vérification que l'user connecté suit ou non la personne
    $verificationFollow = $mysqli->query("
            SELECT * FROM followers
            WHERE followed_user_id = '5'
            AND following_user_id = '4'
            ");

    if ($verificationFollow->num_rows == 0) {
        $isFollowing = false;
        $follow_button_label = "Suivre";
    } else {
        $isFollowing = true;
        $follow_button_label = "Ne pas suivre";
    }

    if (isset($_POST['followButton'])) {
        if ($verificationFollow->num_rows == 0) {
            echo 'on a cliqué';
            $follow = $mysqli->query(
                "INSERT INTO followers(followed_user_id, following_user_id) VALUES ('5', '4')"
            );
            $isFollowing = !$isFollowing;
            $follow_button_label = "Ne pas suivre";
        } else {
            echo 'on a cliqué';
            $unfollow = $mysqli->query(
                "DELETE FROM followers WHERE followed_user_id = '5' AND following_user_id = '4'"
            );
            $isFollowing = !$isFollowing;
            $follow_button_label = "Suivre";
        }
    }
} ?>
<form action="" method='post'>
    <input type="hidden" name="isFollowing" value="<?php echo $isFollowing; ?>">
    <input type="submit" value="<?php echo $follow_button_label ?>" name="followButton">
</form>