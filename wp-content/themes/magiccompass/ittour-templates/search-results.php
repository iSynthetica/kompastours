<?php
/**
 * Template part for displaying posts
 *
 * @package WordPress
 * @subpackage Magiccompass/IttourParts
 * @version 0.0.8
 * @since 0.0.1
 */

if ( ! defined( 'ABSPATH' ) ) exit;

if (empty($template)) {
    $template = 'left-sidebar';
}

global $ittour_global_form_args;
global $ittour_global_tour_result;
global $ittour_global_template_args;

$template = 'no-sidebar';

if (!empty($ittour_global_tour_result['error'])) {
    $page_title_template = snth_get_template('titles/static-image-bg.php', array(
            'title' => __('Search tours', 'snthwp')
        )
    );
    $ittour_content = ittour_get_template('search/no-parameters.php');
}  elseif (!empty($ittour_global_tour_result['result'])) {
    $search_result = $ittour_global_tour_result['result'];

    if (is_wp_error($search_result)) {
        $page_title_template = snth_get_template('titles/static-image-bg.php', array(
                'title' => __('Search error', 'snthwp')
            )
        );

        $ittour_content = ittour_get_template('search/result-error.php', array('error' => $search_result->errors['ittour_error'][0]));
    }

    if ( !is_array( $search_result ) ) return;

    $page_title_template = snth_get_template('titles/static-image-bg.php', array(
            'title' => __('Search results', 'snthwp')
        )
    );

    $ittour_content = ittour_get_template('search/result.php', $ittour_global_template_args);
} else {
    $page_title_template = snth_get_template('titles/static-image-bg.php', array(
            'title' => __('Search tours', 'snthwp')
        )
    );
    $ittour_content = ittour_get_template('search/no-parameters.php');
}

echo $page_title_template;
?>

<section id="search-section">
    <div class="container">
        <?php ittour_show_template('form/section-search.php'); ?>
    </div>
</section>

<div class="wrap">
    <div class="container mt-0 mb-20 mt-md-20 mb-md-40 mt-lg-40 mb-lg-60 ">
        <div class="row">
            <?php
            if ( 'right-sidebar' === $template ) {
                ?>
                <div id="primary" class="content-area col-lg-9">
                    <main id="main" class="site-main" role="main">
                        <?php echo $ittour_content; ?>
                    </main>
                </div>

                <aside class="col-lg-3">
                    <?php get_sidebar(); ?>
                </aside>
                <?php
            } elseif ( 'left-sidebar' === $template ) {
                ?>
                <aside class="col-lg-3">
                    <?php get_sidebar(); ?>
                </aside>

                <div id="primary" class="content-area col-lg-9">
                    <main id="main" class="site-main" role="main">
                        <?php echo $ittour_content; ?>
                    </main>
                </div>
                <?php
            } else {
                ?>
                <div id="primary" class="content-area col-12">
                    <main id="main" class="site-main" role="main">
                        <?php echo $ittour_content; ?>
                    </main>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>
