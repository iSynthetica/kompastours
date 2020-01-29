<?php
?>
<div class="error_messages">
    <div class="alert alert-danger mb-0 p-5 pr-10 pl-10" role="alert">
        <?php
        foreach ($errors as $error) {
            ?>
            <p class="mtb-5"><?php echo $error['message']; ?></p>
            <?php
        }
        ?>
    </div>
</div>