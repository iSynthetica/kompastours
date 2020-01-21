<?php
$content_before = get_field('content_before');
$content_gallery = get_field('content_gallery');
$content_after = get_field('content_after');
?>

<?php
if (!empty($content_before)) {
    echo wpautop($content_before);
}
?>

<?php
// var_dump($content_gallery);

if (!empty($content_gallery)) {
    ?>
    <div id="gallery-container" class="row">
        <?php
        foreach ($content_gallery as $photo) {
            $full_img = $photo['url'];
            $preview_img = $photo['sizes']['blog_thumb'];
            ?>
            <div class="col-12 col-md-6 col-lg-4 gallery-item" data-src="<?php echo $full_img; ?>">
                <img src="<?php echo $preview_img ?>" alt="">
            </div>
            <?php
        }
        ?>
    </div>
    <?php
}
?>

<?php
if (!empty($content_after)) {
    echo wpautop($content_after);
}
?>