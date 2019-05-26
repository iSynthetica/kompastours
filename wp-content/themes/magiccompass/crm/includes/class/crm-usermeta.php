<?php
/**
 * Created by PhpStorm.
 * User: snth
 * Date: 26.05.19
 * Time: 16:08
 */

class CRM_Usermeta extends CRM_Entity {
    protected $name = CRM_USER_NAME;

    protected $name_plural = CRM_USERS_NAME;

    protected $table_name = 'crm_users_meta';

    protected $fields = array(
        'id' => 'bigint(20) unsigned NOT NULL auto_increment',
        'user_id' => "bigint(20) unsigned NOT NULL default '0'",
        'meta_key' => "varchar(255) default NULL",
        'meta_value' => "longtext",
    );

    protected $keys = array(
        'primary' => 'id',
        'keys'    => array(
            'user_id' => 'user_id',
            'meta_key' => 'meta_key(191)',
        )
    );
}