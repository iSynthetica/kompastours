<!-- Footer
============================================= -->
<footer id="colophon" class="site-footer" role="contentinfo" style="padding-top: 0;">
    <?php
    $social = get_field('social', 'options');

    if (!empty($social)) {
        ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div id="social_footer" style="border-top:none; margin-top: 0;">
                        <ul>
                            <?php
                            foreach ($social as $item) {
                                ?>
                                <li class="display-on-<?php echo $item['use_on'] ?>"><a href="<?php echo $item['link'] ?>" title="<?php echo $item['label'] ?>"><i class="fab fa-<?php echo $item['icon'] ?>"></i></a></li>
                                <?php
                            }
                            ?>
                        </ul>

                        <p>© MagicCompass 2008 - <?php echo date('Y'); ?></>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
</footer><!-- #footer end -->