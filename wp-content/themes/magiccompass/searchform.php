<?php
/**
 * Template for displaying search forms in Twenty Seventeen
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>

<?php $unique_id = esc_attr( uniqid( 'search-form-' ) ); ?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <div class="input-group">
        <input
                type="search"
                id="<?php echo $unique_id; ?>"
                class="search-field form-control"
                placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'snthwp' ); ?>"
                value="<?php echo get_search_query(); ?>" name="s"
        />

        <button
                type="submit"
                class="search-submit btn btn-default"
        >
            <i class="fas fa-search"></i>
        </button>
    </div>
</form>
