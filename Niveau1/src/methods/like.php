<?php

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

// DANS GETVOTES() {
    // $likesCount = checkVotes($id, 'SELECT COUNT(id) AS count FROM likes WHERE post_id = ? AND user_id = ?');
    // $dislikesCount = checkVotes($id, 'SELECT COUNT(id) AS count FROM dislikes WHERE post_id = ? AND user_id = ?');
    // echo $dislikesCount . " ";
    // echo $likesCount;
// }

// DANS DOWNVOTE() {
    // $result = checkVotes($id, 'SELECT id FROM dislikes WHERE post_id = ? AND user_id = ?', $sessionId);
// }