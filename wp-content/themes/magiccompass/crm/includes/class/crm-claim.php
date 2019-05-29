<?php
/**
 * Created by PhpStorm.
 * User: snth
 * Date: 26.05.19
 * Time: 16:08
 */

class CRM_Claim extends CRM_Entity {
    /**
     * Claim data container.
     */
    public $data;

    /**
     * The claim's ID.
     */
    public $ID = 0;

    protected static $table_name = 'crm_claims';

    public static $initial_claim_number = 1850;

    protected static $fields = array(
        'ID' => 'bigint(20) unsigned NOT NULL auto_increment',
        'parent_id' => 'bigint(20) unsigned NOT NULL',
        'client_id' => 'bigint(20) unsigned NOT NULL',
        'manager_id' => 'bigint(20) unsigned NOT NULL',
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

    protected static $types = array(

    );

    public function __construct($claim = 0) {
        if ( $claim ) {
            $data = self::get( $claim );
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

        $this->data->manager = '';
        $manager = false;

        if (!empty($this->data->manager_id)) {
            $manager = get_userdata( (int) $this->data->manager_id );
        }

        if ($manager) {
            $this->data->manager = $manager->data;
        }

        $this->data->client = '';
        $client = false;

        if (!empty($this->data->client_id)) {
            $client = CRM_User::get($this->data->client_id);
        }

        if ($client) {
            $this->data->client = $client;
        }
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

    public static function updateMetadata($id, $key, $value, $prev_value = '') {
        if (is_array($value)) {
            $value = serialize($value);
        }
    }

    public static function deleteMetadata($id, $key, $value = '', $delete_all = '') {
        if (is_array($value)) {
            $value = serialize($value);
        }
    }

    public static function getStatuses() {
        return array(
            'pending'       => __('Pending', 'snthwp'),
            'in_progress'   => __('In Progress', 'snthwp'),
            'cancelled'     => __('Cancelled', 'snthwp'),
            'closed'        => __('Closed', 'snthwp'),
        );
    }

    public static function getTypes() {
        return array(
            'initial' => __('Initial', 'snthwp'),
            'tour' => __('Package Tour', 'snthwp'),
            'excursion_tour' => __('Excursion Tour', 'snthwp'),
            'job' => __('Excursion Tour', 'snthwp'),
            'plane_ticket' => __('Excursion Tour', 'snthwp'),
            'bus_ticket' => __('Excursion Tour', 'snthwp'),
            'booking_hotel' => __('Booking Hotel', 'snthwp'),


            'tour_search_request' => __('Tour search request', 'snthwp'),
            'tour_booking_request' => __('Tour booking request', 'snthwp'),
        );
    }
}