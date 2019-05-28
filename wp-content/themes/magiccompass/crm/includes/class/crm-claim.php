<?php
/**
 * Created by PhpStorm.
 * User: snth
 * Date: 26.05.19
 * Time: 16:08
 */

class CRM_Claim extends CRM_Entity {
    protected static $table_name = 'crm_claims';

    protected static $fields = array(
        'ID' => 'bigint(20) unsigned NOT NULL auto_increment',
        'parent_id' => 'bigint(20) unsigned NOT NULL auto_increment',
        'client_id' => 'bigint(20) unsigned NOT NULL auto_increment',
        'title' => "varchar(200) NOT NULL default ''",
        'excerpt' => 'text NOT NULL',
        'type' => "varchar(20) NOT NULL default 'tour'",
        'status' => "varchar(20) NOT NULL default 'pending'",
        'created' => "datetime NOT NULL default '0000-00-00 00:00:00'",
        'modified' => "datetime NOT NULL default '0000-00-00 00:00:00'",
    );

    protected static $keys = array(
        'primary' => 'ID',
        'keys'    => array(
            'title' => 'title(191)',
            'client' => 'client_id',
            'type_status_date' => "type,status,created,ID"
        )
    );

    public static function insert($userdata) {
        global $wpdb;
        $table = $wpdb->prefix . self::$table_name;

        if ( ! empty( $userdata['ID'] ) ) {
            $ID            = (int) $userdata['ID'];
            $update        = true;
        } else {
            $update = false;
        }

        if ($update) {

        } else {
            $wpdb->insert( $table, $userdata );

            $user_id = (int) $wpdb->insert_id;
        }

        return $user_id;
    }
}