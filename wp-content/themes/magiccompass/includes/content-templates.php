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

    $show_home_link = 1;
    $show_on_home = 0;
    $show_current = 1;

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

    if (is_home() || is_front_page()) {
        if ($show_on_home) echo $wrap_before . $home_link . $wrap_after;
    }
    else {
        echo $wrap_before;

        if ($show_home_link) {
            echo $home_link;
        }

        if (is_category()) {

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

        echo $wrap_after;
    }
}