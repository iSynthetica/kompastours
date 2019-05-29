<?php
/**
 * Created by PhpStorm.
 * User: snth
 * Date: 26.05.19
 * Time: 16:08
 */

class CRM_User extends CRM_Entity {
    /**
     * Client data container.
     */
    public $data;

    /**
     * The client's ID.
     */
    public $ID = 0;

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

    public function __construct($client = 0) {
        if ( $client ) {
            $data = self::get( $client );
        }

        if ( $data ) {
            $this->init( $data );
        }
    }

    /**
     * Sets up object properties.
     */
    public function init( $data ) {
        $this->data = $data;
        $this->ID = (int) $data->ID;
    }

    public function __get( $name ) {
        $value = false;

        if ( isset( $this->data->$name ) ) {
            $value = $this->data->$name;
        }

        return $value;
    }

    public function __isset( $name ) {
        if ( isset( $this->data->$name ) )
            return true;
    }

    public static function insert($data) {
        global $wpdb;
        $table = $wpdb->prefix . self::$table_name;

        if ( ! empty( $data['ID'] ) ) {
            $ID            = (int) $data['ID'];
            $update        = true;
            unset($data['ID']);
        } else {
            $update = false;
        }

        if ($update) {
            $result = $wpdb->update( $table,
                $data,
                array( 'ID' => $ID )
            );

            if (false === $result) {
                return false;
            }
        } else {
            $wpdb->insert( $table, $data );

            $ID = (int) $wpdb->insert_id;
        }

        return $ID;
    }

    public static function addMetadata($id, $key, $value, $unique = false) {
        if ($unique && CRM_Claimmeta::count($id, $key)) {
            return false;
        }

        $data = array(
            'claim_id' => $id,
            'meta_key' => $key,
            'meta_value' => maybe_serialize( $value ),
        );

        $mid = CRM_Claimmeta::insert($data);

        return $mid;
    }
}