<?php
?>
<div class="message-holder">
    <div class="alert alert-danger" role="alert">
        <?php
        foreach ($errors as $error) {
            ?>
            <p class="mtb-5"><?php echo $error['message']; ?></p>
            <?php
        }
        ?>
    </div>
</div>