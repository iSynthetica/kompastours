<?php
/**
 * Created by PhpStorm.
 * User: snth
 * Date: 26.05.19
 * Time: 16:08
 */

class CRM_Usermeta extends CRM_Entity {
    protected static $table_name = 'crm_users_meta';

    protected static $fields = array(
        'id' => 'bigint(20) unsigned NOT NULL auto_increment',
        'user_id' => "bigint(20) unsigned NOT NULL default '0'",
        'meta_key' => "varchar(255) default NULL",
        'meta_value' => "longtext",
    );

    protected static $keys = array(
        'primary' => 'id',
        'keys'    => array(
            'user_id' => 'user_id',
            'meta_key' => 'meta_key(191)',
        )
    );
}