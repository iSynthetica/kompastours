<?php
/**
 * Display Single Tour content
 *
 * @package WordPress
 * @subpackage Magiccompass/ITtour
 * @since 1.0
 *
 * @var $gallery_images
 */

if ( ! defined( 'ABSPATH' ) ) exit;

$images_count = count($gallery_images);
?>
<div id="single-tour-gallery__container" class="mb-20">
    <div class="single-tour-thumbnail__container">
        <img id="dynamicGallery" style="max-width: 100%" src="<?php echo $gallery_images[0]['full'] ?>" alt="">
    </div>

    <div class="single-tour-slider__container text-center">
        <?php
        $i = 0;
        foreach ($gallery_images as $image) {
            if (0 !== $i) {
                ?><div class="single-tour-slider__item">
                <div class="single-tour-slider__item-inner" style="background-image: url('<?php echo $image['thumb']; ?>')">

                </div>
                </div><?php
            }
            $i++;

            if ($i > 3) {
                break;
            }
        }
        ?>
    </div>
</div>

<script>
    var dynamicImages = {
        dynamic: true,
        download: false,
        dynamicEl: [
            <?php
            foreach ($gallery_images as $image) {
            ?>
            {
                "src": '<?php echo $image["full"]; ?>',
                'thumb': '<?php echo $image["thumb"]; ?>'
            },
            <?php
            }
            ?>
        ]
    };

    document.getElementById('dynamicGallery').addEventListener('click', function() {
        lightGallery(document.getElementById('dynamicGallery'), dynamicImages)
    });
</script>