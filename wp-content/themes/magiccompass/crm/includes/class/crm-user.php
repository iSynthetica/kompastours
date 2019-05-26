<?php
/**
 * Created by PhpStorm.
 * User: snth
 * Date: 26.05.19
 * Time: 16:08
 */

class CRM_User {
    private static $name = CRM_USER_NAME;

    private static $name_plural = CRM_USERS_NAME;

    private static $table_name = 'crm_users';

    private static $fields = array(
        'ID' => 'bigint(20) unsigned NOT NULL auto_increment',
        'user_first_name' => "varchar(70) NOT NULL default ''",
        'user_last_name' => "varchar(70) NOT NULL default ''",
        'user_email' => "varchar(100) NOT NULL default ''",
        'user_phone' => "varchar(25) NOT NULL default ''",
        'user_viber' => "int(1) NOT NULL default '0'",
        'user_telegram' => "int(1) NOT NULL default '0'",
        'user_registered' => "datetime NOT NULL default '0000-00-00 00:00:00'",
    );

    private static $keys = array(
        'primary' => 'ID',
        'keys'    => array(
            'user_phone' => 'user_phone'
        )
    );

    public static function get_table() {
        global $wpdb;

        return $wpdb->prefix . self::$table_name;
    }

    public static function createObjectTable() {
        global $wpdb;

        $table_name = $wpdb->prefix . self::$table_name;
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE {$table_name} (";

        $count_fields = count(self::$fields);

        $i = 1;
        foreach (self::$fields as $field => $params) {
            $sql .= "{$field} {$params}";

            if ($i < $count_fields) {
                $sql .= ", ";
            }

            $i++;
        }

        if (!empty(self::$keys['primary'])) {
            $primary = self::$keys['primary'];
            $sql .= ", ";
            $sql .= "PRIMARY KEY ({$primary})";
        }

        if (!empty(self::$keys['keys'])) {
            $count_keys = count(self::$keys['keys']);
            $i = 1;
            $sql .= ", ";

            foreach (self::$keys['keys'] as $name => $field) {
                $sql .= "KEY {$name} ({$field})";

                if ($i < $count_keys) {
                    $sql .= ", ";
                }

                $i++;
            }
        }

        $sql .= ") $charset_collate;";

        dbDelta($sql);
    }

    public static function isTableExists() {
        global $wpdb;
        $table_name = $wpdb->prefix . self::$table_name;

        $sql = $wpdb->prepare( "SHOW TABLES LIKE '%s'", $table_name);

        $result = $wpdb->query($sql);

        return $result;
    }

    public static function isTableChanged() {
        $columns_in_db = self::getColumnsForTable();

        $is_changed = false;

        foreach (self::$fields as $field => $params) {
            if (!in_array($field, $columns_in_db)) {
                $is_changed = true;
            }
        }

        return $is_changed;
    }

    public static function getColumnsForTable() {
        global $wpdb;
        $table_name = $wpdb->prefix . self::$table_name;

        $columns = array_map(function ($item) {
            return $item->Field;
        }, $wpdb->get_results('DESCRIBE ' . $table_name . ';'));

        return $columns;
    }
}