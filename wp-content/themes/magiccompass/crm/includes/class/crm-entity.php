<?php
/**
 * Created by PhpStorm.
 * User: snth
 * Date: 26.05.19
 * Time: 17:48
 */

class CRM_Entity {
    protected static $table_name = '';

    protected static $fields = array();

    protected static $keys = array();

    public static function createObjectTable() {
        global $wpdb;

        $table_name = $wpdb->prefix . static::$table_name;
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE {$table_name} (";

        $count_fields = count(static::$fields);

        $i = 1;
        foreach (static::$fields as $field => $params) {
            $sql .= "{$field} {$params}";

            if ($i < $count_fields) {
                $sql .= ", ";
            }

            $i++;
        }

        if (!empty(static::$keys['primary'])) {
            $primary = static::$keys['primary'];
            $sql .= ", ";
            $sql .= "PRIMARY KEY ({$primary})";
        }

        if (!empty(static::$keys['keys'])) {
            $count_keys = count(static::$keys['keys']);
            $i = 1;
            $sql .= ", ";

            foreach (static::$keys['keys'] as $name => $field) {
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
        $table_name = $wpdb->prefix . static::$table_name;

        $sql = $wpdb->prepare( "SHOW TABLES LIKE '%s'", $table_name);

        $result = $wpdb->query($sql);

        return $result;
    }

    public static function isTableChanged() {
        $columns_in_db = self::getColumnsForTable();

        $is_changed = false;

        foreach (static::$fields as $field => $params) {
            if (!in_array($field, $columns_in_db)) {
                $is_changed = true;
            }
        }

        return $is_changed;
    }

    protected static function getColumnsForTable() {
        global $wpdb;
        $table_name = $wpdb->prefix . static::$table_name;

        $columns = array_map(function ($item) {
            return $item->Field;
        }, $wpdb->get_results('DESCRIBE ' . $table_name . ';'));

        return $columns;
    }

    public static function getByField($field, $value) {
        global $wpdb;
        $table = $wpdb->prefix . static::$table_name;

        if ( ! $result = $wpdb->get_row(
            $wpdb->prepare(
                "SELECT * FROM $table WHERE $field = %s LIMIT 1",
                $value
            )
        ) ) {
            return false;
        }

        return $result;
    }
}