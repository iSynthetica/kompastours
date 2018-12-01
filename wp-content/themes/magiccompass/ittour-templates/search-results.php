<?php

?>
<section class="parallax-window" data-parallax="scroll" data-image-src="img/header_bg.jpg" data-natural-width="1400"
         data-natural-height="470">
    <div class="parallax-content-1">
        <div class="animated fadeInDown">
            <h1>Contact us</h1>
            <p>Ridiculus sociosqu cursus neque cursus curae ante scelerisque vehicula.</p>
        </div>
    </div>
</section>
<!-- End Section -->

<?php ittour_show_template('form/section-search.php'); ?>

<?php

if (empty($_GET['country'])) {
    ittour_show_template('search/no-parameters.php');
} else {

    $country_id = $_GET['country'];

    unset($_GET['country']);

    $args = $_GET;

    if (!empty($_GET['child_amount_group'])) {
        $child_amount_group = $_GET['child_amount_group'];
        unset($_GET['child_amount_group']);

        $child_amount = count($child_amount_group);
        $child_age_array = array();

        foreach ($child_amount_group as $child) {
            $child_age_array[] = $child['child_amount'];
        }

        $child_age = implode(':', $child_age_array);

        $args['child_amount'] = $child_amount;
        $args['child_age'] = $child_age;
    }

    if (!empty($_GET['date'])) {
        $dates = explode('-', $_GET['date']);

        $args['date_from'] = trim($dates[0]);
        $args['date_till'] = trim($dates[1]);
    }

    $search = ittour_search('ru');
    $search_result = $search->get($country_id, $args);

    if ( !is_array( $search_result ) ) {
        return;
    }

    ittour_show_template('search/result.php', array('result' => $search_result));
}