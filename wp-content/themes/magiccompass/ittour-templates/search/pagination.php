<?php
if (!$result['has_more_pages']) {
    return;
}
?>

<div class="search-result__pagination">
    <strong><?php echo __('Page', 'snthwp'); ?>:</strong> <?php $result['page'] ?> <?php echo __('out of', 'snthwp'); ?> <?php  ?>
</div>
