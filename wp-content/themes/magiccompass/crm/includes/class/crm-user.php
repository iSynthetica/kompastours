<?php
/**
 * Created by PhpStorm.
 * User: snth
 * Date: 26.05.19
 * Time: 16:08
 */

class CRM_User extends CRM_Entity {
    protected $name = CRM_USER_NAME;

    protected $name_plural = CRM_USERS_NAME;

    protected $table_name = 'crm_users';

    protected $fields = array(
        'ID' => 'bigint(20) unsigned NOT NULL auto_increment',
        'user_display_name' => "varchar(100) NOT NULL default ''",
        'user_email' => "varchar(100) NOT NULL default ''",
        'user_phone' => "varchar(25) NOT NULL default ''",
        'user_viber' => "int(1) NOT NULL default '0'",
        'user_telegram' => "int(1) NOT NULL default '0'",
        'user_registered' => "datetime NOT NULL default '0000-00-00 00:00:00'",
    );

    protected $keys = array(
        'primary' => 'ID'
    );

    protected function insert_user( $userdata ) {
        global $wpdb;

        $defaults = array(
            'user_display_name'     => '',
            'user_email'            => '',
            'user_phone'            => '',
            'user_viber'            => '0',
            'user_telegram'         => '0',
        );

        $postarr = wp_parse_args( $userdata, $defaults );
    }
}