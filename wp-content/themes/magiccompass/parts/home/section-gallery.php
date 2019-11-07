<?php
$is_gallery_items = (int)Class_SNTH_Gallery::is_gallery_items();

if (empty($is_gallery_items)) {
    return;
}

$blog = array(
    "section_title" => __('Photogallery'),
    "primary_button" => array(
        'link' => array(
            'url' => '#'
        ),
        'label' => __('All galleries')
    ),
    "secondary_button" => array(),
);
?>

<section id="blog" class="ptb-20 ptb-md-40 ptb-lg-60 bg-white-color blog-post-style3">
    <div class="container">
        <?php
        if (!empty($blog["section_title"])) {
            ?>
            <div class="row">
                <div class="col-12">
                    <h2 class="text-center mt-0 mb-20 mb-md-40 font-weight-600"><?php echo $blog["section_title"]; ?></h2>
                </div>
            </div>
            <?php
        }
        echo do_shortcode('[snth_galleries_list]');
        ?>

        <?php
        if (!empty($blog["primary_button"]["link"]) || $blog["secondary_button"]["link"]) {
            ?>
            <div class="row">
                <div class="col-12">
                    <div class="text-center mt-10 mt-md-20 mt-lg-40">
                        <?php
                        if (!empty($blog["primary_button"]["link"])) {
                            ?>
                            <a
                                class="btn size-xl shape-rnd hvr-invert prl-40 mrl-10 mb-0 text-uppercase font-alt font-weight-900"
                                href="<?php echo $blog["primary_button"]["link"]['url'] ?>"
                            >
                                <?php echo $blog['primary_button']['label'] ?>
                            </a>
                            <?php
                        }

                        if (!empty($blog["secondary_button"]["link"])) {
                            ?>
                            <a
                                class="btn size-xl type-hollow shape-rnd hvr-invert prl-40 mrl-10 mb-0 text-uppercase font-alt font-weight-900"
                                href="<?php echo $blog["secondary_button"]["link"]['url'] ?>"
                            >
                                <?php echo $blog['secondary_button']['label'] ?>
                            </a>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</section>