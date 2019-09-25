<?php
header("Content-type: text/x-csv");
header("Content-Disposition: attachment; filename=search_results.csv");
$only_mail = !empty($_GET['only_mail']) ? $_GET['only_mail'] : false;

if ($only_mail && 'no' === $only_mail) {
    $only_mail = false;
}

$tag_id = !empty($_GET['tag_id']) ? $_GET['tag_id'] : '';

if ($tag_id && 'no' === $tag_id) {
    $tag_id = '';
}

$tags_names = crm_moi_turisty_get_tags_names_by_id();
$clients_ids_by_tags = crm_moi_turisty_get_clients_ids_by_tags();

if (!empty($tag_id)) {
    $tag_id_array = explode(':', $tag_id);
    $clients_only_tags = array();

    foreach ($tag_id_array as $tag_id_item) {
        if (!empty($clients_ids_by_tags[$tag_id_item]) ) {
            $clients_only_tags = array_merge($clients_only_tags, $clients_ids_by_tags[$tag_id_item]);
        }
    }

    $clients_only_tags = array_values(array_unique($clients_only_tags));
}

$client_array = crm_moi_turisty_get_clients_data_by_id();

$clients_decoded = $client_array;
$clients_fields = $clients_decoded['struct'];
$clients_data = $clients_decoded['data'];

$show_array = array(
    'i',
    'n',
    'm',
    'p',
    'c',
    //'a',
    //'cn'
);

$output = '';

ob_start();
$i = 1;
$num = count($show_array);
foreach ($show_array as $field_i) {
    $output .= $clients_fields[$field_i];

    if ($i < $num) {
        $output .= ',';
    }
    $i++;
}
echo $output;
exit();
$output .= PHP_EOL;

foreach ($clients_data as $client_id => $client_data) {
    $i = 1;
    $num = count($show_array);
    foreach ($show_array as $field_i) {
        $output .= $client_data[$field_i];

        if ($i < $num) {
            $output .= ',';
        }
        $i++;
    }
    $output .= PHP_EOL;
}

$data = ob_get_clean();

echo $output;
exit();