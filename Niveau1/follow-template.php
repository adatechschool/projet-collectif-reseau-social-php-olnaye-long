<?php
$lesInformations = $mysqli->query($laQuestionEnSql);
            // Etape 4: à vous de jouer
            while ($follow = $lesInformations->fetch_assoc()) {
                // echo "<pre>" . print_r($follow, 1) . "</pre>";

            ?>
                <article>
                    <img src="user.jpg" alt="blason" />
                    <h3><?php echo $follow['alias'] ?></h3>
                    <p>id:<?php echo $follow['id'] ?></p>
                </article>
            <?php } ?>
