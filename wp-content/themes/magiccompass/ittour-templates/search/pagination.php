<?php
if (!$result['has_more_pages']) {
    return;
}

$current_page = $result['page'];

$prev_page = $current_page - 1;
$next_page = $result['has_more_pages'] ? $current_page + 1 : false;
?>

<div class="search-result__pagination">
    <strong><?php echo __('Page', 'snthwp'); ?>:</strong> <?php echo $result['page']; ?> <?php echo __('out of', 'snthwp'); ?> <?php echo $result['max_page']; ?>

    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <?php
            if ($prev_page) {
                ?>
                <li class="page-item">
                    <a class="page-link" href="/search/?<?php echo $url . '&search_page=' . $prev_page; ?>" aria-label="Previous">
                        <i class="fas fa-chevron-left"></i> <?php echo __('Previous', 'snthwp'); ?>
                    </a>
                </li>
                <?php
            }

            if ($next_page) {
                ?>
                <li class="page-item">
                    <a class="page-link" href="/search/?<?php echo $url . '&search_page=' . $next_page; ?>" aria-label="Next">
                        <i class="fas fa-chevron-right"></i> <?php echo __('Next', 'snthwp'); ?>
                    </a>
                </li>
                <?php
            }
            ?>
        </ul>
    </nav>
</div>
