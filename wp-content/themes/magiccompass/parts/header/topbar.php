<?php
/**
 * Created by PhpStorm.
 * User: snth
 * Date: 26.05.19
 * Time: 18:11
 */

$phones = get_field('phones', 'options');
$social = get_field('social', 'options');
?>
<!-- topbar -->
<div class="top-header-area bg-black-color ptb-10">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-md-6 text-uppercase alt-font d-flex align-items-center justify-content-center justify-content-md-start">
                <?php
                foreach ($phones as $phone) {
                    if (!empty($phone['link'])) {
                        echo '<a class="mr-10 font-alt font-weight-900" href="'.$phone['link'].'">';
                    } else {
                        echo '<span class="mr-10 font-alt font-weight-900">';
                    }

                    echo '<i class="fas fa-phone"></i> ' . $phone['label'];

                    if (!empty($phone['link'])) {
                        echo '</a>';
                    } else {
                        echo '</span>';
                    }
                }
                ?>
            </div>

            <div class="col-md-6 d-none d-md-flex align-items-center justify-content-end">
                <div class="icon-social-very-small display-inline-block line-height-normal">
                    <?php
                    foreach ($social as $item) {
                        ?>
                        <a class="ml-10" href="<?php echo $item['link'] ?>" target="_blank" title="<?php echo $item['label'] ?>"><i class="fab fa-<?php echo $item['icon'] ?>"></i></a>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end topbar -->
