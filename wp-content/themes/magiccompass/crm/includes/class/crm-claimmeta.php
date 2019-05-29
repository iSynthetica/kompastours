<?php
/**
 * Created by PhpStorm.
 * User: snth
 * Date: 26.05.19
 * Time: 16:08
 */

class CRM_Claimmeta extends CRM_Entity {
    protected static $table_name = 'crm_claims_meta';

    protected static $fields = array(
        'id' => 'bigint(20) unsigned NOT NULL auto_increment',
        'claim_id' => "bigint(20) unsigned NOT NULL default '0'",
        'meta_key' => "varchar(255) default NULL",
        'meta_value' => "longtext",
    );

    protected static $keys = array(
        'primary' => 'id',
        'keys'    => array(
            'claim_id' => 'claim_id',
            'meta_key' => 'meta_key(191)',
        )
    );

    public static function count( $claim_id, $meta_key ) {
        global $wpdb;

        $table = $wpdb->prefix . self::$table_name;
        $sql = $wpdb->prepare("SELECT COUNT(*) FROM {$table} WHERE meta_key = %s AND claim_id = %d", $meta_key, $claim_id);

        return $wpdb->get_var($sql);
    }

    public static function insert($data) {
        global $wpdb;
        $table = $wpdb->prefix . self::$table_name;

        if ( ! empty( $data['id'] ) ) {
            $id            = (int) $data['id'];
            $update        = true;
            unset($data['id']);
        } else {
            $update = false;
        }

        if ($update) {
            $result = $wpdb->update( $table,
                $data,
                array( 'id' => $id )
            );

            if (false === $result) {
                return false;
            }
        } else {
            $wpdb->insert( $table, $data );

            $id = (int) $wpdb->insert_id;
        }

        return $id;
    }

    public static function update($claim_id, $meta_key, $meta_value) {
        global $wpdb;
        $table = $wpdb->prefix . self::$table_name;

        $data = array(
            'claim_id' => $claim_id,
            'meta_key' => $meta_key,
            'meta_value' => $meta_value,
        );

        $wpdb->insert( $table, $data );
        $id = (int) $wpdb->insert_id;

        return $id;
    }
}