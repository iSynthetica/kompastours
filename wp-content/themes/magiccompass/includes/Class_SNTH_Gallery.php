<?php
class Class_SNTH_Gallery {
    public static function is_gallery_items() {
        global $wpdb;

        $sql = "SELECT COUNT(*) FROM {$wpdb->posts} WHERE post_type = 'gallery' AND post_status = 'publish';";

        return $wpdb->get_var( $sql );
    }
}