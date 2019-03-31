<?php
/**
 * Created by PhpStorm.
 * User: snth
 * Date: 29.03.19
 * Time: 13:55
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Custom Breadcrumbs
 */
function snth_the_breadcrumbs() {
    /* == Options - Start == */
    $text['home'] = __('Home', 'snthwp');
    $text['blog'] = __('Blog', 'snthwp');

    $show_home_link = 1;
    $show_on_home = 0;
    $home_page_for_posts = 1;
    $show_current = 1;

    $is_woo_active = snth_is_woocommerce_active();
    $is_yoast_seo_active = snth_is_yoast_seo_active();

    $wrap_before = '<section id="breadcrumbs-section"><div id="position"><div class="container"><ul>';
    $wrap_after = '</ul></div></div></section>';

    $sep_item = '<li class="separator">/</li>'; // разделитель между "крошками"
    $sep_before = '&nbsp'; // тег перед разделителем
    $sep_after = '&nbsp'; // тег после разделителя
    $sep = $sep_before . $sep_item . $sep_after;

    $link_before = '<li itemprop="name">';
    $link_after = '</li>';
    $link_attr = ' itemprop="item"';
    $link_in_before = '';
    $link_in_after = '';
    $link = $link_before . '<a href="%1$s"' . $link_attr . '>' . $link_in_before . '%2$s' . $link_in_after . '</a>' . $link_after;

    $current_before = '<span class="current">'; // тег перед текущей "крошкой"
    $current_after = '</span>'; // тег после текущей "крошки"
    /* == Options - End == */

    global $post;

    $home_url = home_url('/');
    $home_link = $link_before . '<a href="' . $home_url . '"' . $link_attr . '>' . $link_in_before . $text['home'] . $link_in_after . '</a>' . $link_after;
    $frontpage_id = get_option('page_on_front');
    $homepage_id = get_option('page_for_posts');

    if ((is_home() && !$home_page_for_posts) || is_front_page()) {
        if ($show_on_home) {
            echo $wrap_before . $home_link . $wrap_after;
        }
    }
    else {
        echo $wrap_before;

        if ($show_home_link) {
            echo $home_link;
        }

        if (is_category()) {

        }
        elseif (is_single()) {
            $id = $post->ID;

            if ( get_post_type() === 'product' ) {

            }
            else {
                $cat = false;

                if ($is_yoast_seo_active) {
                    $cat = get_post_meta($post->ID , '_yoast_wpseo_primary_category', true);
                }

                if (!$cat) {
                    $cat = get_the_category();
                    $cat = $cat[0];
                }

                $cats = get_category_parents($cat, TRUE, $sep);
                $cats = preg_replace('#<a([^>]+)>([^<]+)<\/a>#', $link_before . '<a$1' . $link_attr .'>' . $link_in_before . '$2' . $link_in_after .'</a>' . $link_after, $cats);

                if (!$show_current || get_query_var('cpage')) {
                    $cats = preg_replace("#^(.+)$sep$#", "$1", $cats);
                }

                if ($show_home_link) {
                    echo $sep;
                }

                echo sprintf($link, get_permalink($homepage_id), $text['blog']);

                echo $sep . $cats;

                if ($show_current) {
                    echo $link_before . $current_before . get_the_title($id) . $current_after . $link_after;
                }
            }
        }
        elseif ( is_page() ) {
            $id = $post->ID;
            $parent_id = ($post) ? $post->post_parent : '';

            if ($show_home_link) {
                echo $sep;
            }

            if ($parent_id) {
                if ($parent_id != $frontpage_id) {
                    $breadcrumbs = array();

                    while ($parent_id) {
                        $page = get_post($parent_id);

                        if ($parent_id != $frontpage_id) {
                            $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
                        }

                        $parent_id = $page->post_parent;
                    }

                    $breadcrumbs = array_reverse($breadcrumbs);

                    for ($i = 0; $i < count($breadcrumbs); $i++) {
                        echo $breadcrumbs[$i];
                        if ($i != count($breadcrumbs)-1) echo $sep;
                    }

                    if ($show_current) {
                        echo $sep;
                    }
                }
            }

            if ($show_current) {
                echo $link_before . $current_before . get_the_title($id) . $current_after . $link_after;
            }
        }
        elseif (is_home() && $home_page_for_posts) {

            if ($show_home_link) {
                echo $sep;
            }

            if ($show_current) {
                echo $link_before . $current_before . $text['blog'] . $current_after . $link_after;
            }
        }

        echo $wrap_after;
    }
}