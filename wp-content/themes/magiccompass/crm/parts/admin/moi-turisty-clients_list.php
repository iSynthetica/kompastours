<?php
/**
 * CRM Main File.
 *
 * @package WordPress
 * @subpackage Magiccompass/CRM
 * @version 0.0.2
 * @since 0.0.2
 */

if ( ! defined( 'ABSPATH' ) ) exit;
$only_mail = !empty($_GET['only_mail']) ? true : false;
$per_page = 0;
$tag_id = !empty($_GET['tag_id']) ? $_GET['tag_id'] : '';
$tag_id_array = array();

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

// var_dump($clients_fields);

$show_array = array(
    'i',
    'n',
    'm',
    'p',
    'c',
    //'a',
    //'cn'
);
?>
<h2><?php _e('Clients'); ?> (<?php echo count($clients_data); ?>)</h2>

<div>
    <a target="_blank" href="<?php echo get_site_url() ?>/download-file/csv/<?php echo $only_mail ? 'yes' : 'no' ?>/<?php echo !empty($tag_id) ? $tag_id : 'no'; ?>" class="button button-primary" data-only-mail="<?php echo $only_mail ? '1' : '0' ?>" data-tag-id="<?php echo $tag_id ?>">
        <?php _e('Download CSv'); ?>
    </a>
</div>

<?php
if (!empty($tag_id) || !empty($only_mail)) {
    ?>
    <div class="crm-filter-container">
        Filter by:
        <?php
        $url = 'admin.php?page=crm-moi-turisty&tab=clients';
        if (!empty($only_mail)) {
            $email_filter = '';
            if (!empty($tag_id)) {
                $email_filter .= '&tag_id=' . $tag_id;
            }
            ?>
            <a href="<?php echo $url.$email_filter ?>" class="crm-tag-item crm-remove-tag-item"><?php echo 'Только с email' ?> <span class="crm-filter-control">&times;</span></a>
            <?php
        }
        foreach ($tag_id_array as $tag_id_item) {
            $tag_id_filter = '';

            if (!empty($only_mail)) {
                $tag_id_filter .= '&only_mail=1';
            }

            $new_tag_id_array = array_diff($tag_id_array, array($tag_id_item));

            if (!empty($new_tag_id_array)) {
                $tag_id_filter .= '&tag_id=' . implode(':', $new_tag_id_array);
            }
            ?>
            <a href="<?php echo $url.$tag_id_filter ?>" class="crm-tag-item crm-remove-tag-item"><?php echo $tags_names[$tag_id_item] ?> <span class="crm-filter-control">&times;</span></a>
            <?php
        }
        ?>
    </div>
    <?php
}
?>

<div class="crm-filter-container">
    Add Filter:
    <?php
    $url = 'admin.php?page=crm-moi-turisty&tab=clients';
    if (empty($only_mail)) {
        $email_filter = '&only_mail=1';
        if (!empty($tag_id)) {
            $email_filter .= '&tag_id=' . $tag_id;
        }
        ?>
        <a href="<?php echo $url.$email_filter; ?>" class="crm-tag-item crm-add-tag-item"><?php echo 'Только с email' ?> <span class="crm-filter-control">&#43;</span></a>
        <?php
    }

    foreach ($tags_names as $tag_names_id => $tag_names_item) {
        if (!in_array($tag_names_id, $tag_id_array)) {
            $tag_id_filter = '';

            if (!empty($only_mail)) {
                $tag_id_filter .= '&only_mail=1';
            }

            if (!empty($tag_id)) {
                $tag_id_filter .= '&tag_id=' . $tag_id . ':' . $tag_names_id;
            } else {
                $tag_id_filter .= '&tag_id=' . $tag_names_id;
            }
            ?>
            <a href="<?php echo $url.$tag_id_filter; ?>" class="crm-tag-item crm-add-tag-item"><?php echo $tag_names_item ?> <span class="crm-filter-control">&#43;</span></a>
            <?php
        }
    }
    ?>
</div>
<table class="wp-list-table widefat fixed striped pages">
    <thead>
    <tr>
        <th>#</th>
        <?php foreach ($show_array as $field_i) {
            ?><th><?php echo $clients_fields[$field_i] ?></th><?php
        } ?>
        <th>tags</th>
    </tr>
    </thead>

    <tbody id="the-list">
    <?php
    $num = 1;
    foreach ($clients_data as $client_id => $client_data) {
        if (0 !== $per_page && $num > $per_page) {
            break;
        }

        if ($tag_id && !in_array($client_id, $clients_only_tags)) {
            continue;
        }

        if ($only_mail) {
            if (empty($client_data['m'])) {
                continue;
            }
        }
        ?>
        <tr>
            <td><?php echo $num ?></td>
            <?php
            foreach ($show_array as $field_i) {
                if ('i' === $field_i || 'n' === $field_i) {
                    ?><td><a href="admin.php?page=crm-moi-turisty&tab=clients&client_id=<?php echo $client_id; ?>"><?php echo $client_data[$field_i]; ?></td></a><?php
                } else {
                    ?><td><?php echo $client_data[$field_i] ?></td><?php
                }

            }
            ?>
            <td>
                <?php
                 $client_tags = crm_moi_turisty_get_client_tags($client_id);

                if (!empty($client_tags)) {
                    foreach ($client_tags as $tag_i => $tag_n) {
                        ?>
                        - <a href="admin.php?page=crm-moi-turisty&tab=clients&tag_id=<?php echo $tag_i; ?>"><?php echo $tag_n ?></a><br>
                        <?php
                    }
                }
                ?>
            </td>
        </tr>
        <?php
        $num++;
    }
    ?>
    </tbody>

    <tfoot>
    <tr>
        <th>#</th>
        <?php foreach ($clients_fields as $i => $clients_field) {
            if (in_array($i, $show_array)) {
                ?><th><?php echo $clients_field ?></th><?php
            }
        } ?>
        <th>tags</th>
    </tr>
    </tfoot>
</table>
<?php
var_dump($num);
