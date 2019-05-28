<?php
/**
 * Created by PhpStorm.
 * User: snth
 * Date: 26.05.19
 * Time: 16:08
 */

class CRM_User extends CRM_Entity {
    protected static $table_name = 'crm_users';

    protected static $fields = array(
        'ID' => 'bigint(20) unsigned NOT NULL auto_increment',
        'user_display_name' => "varchar(100) NOT NULL default ''",
        'user_email' => "varchar(100) NOT NULL default ''",
        'user_phone' => "varchar(25) NOT NULL default ''",
        'user_viber' => "int(1) NOT NULL default '0'",
        'user_telegram' => "int(1) NOT NULL default '0'",
        'user_registered' => "datetime NOT NULL default '0000-00-00 00:00:00'",
    );

    protected static $keys = array(
        'primary' => 'ID',
        'keys'    => array(
            'user_phone' => 'user_phone',
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