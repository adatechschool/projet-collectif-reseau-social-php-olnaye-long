<?php
while ($follow = $lesInformations->fetch_assoc()) {
    ?>
    <article>
        <img src="./src/img/user.jpg" alt="blason" />
        <h3><?php echo $follow['alias'] ?></h3>
        <p>id:<?php echo $follow['id'] ?></p>
    </article>
<?php } ?>
