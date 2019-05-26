<?php
/**
 * Created by PhpStorm.
 * User: snth
 * Date: 26.05.19
 * Time: 17:48
 */

class CRM_Entity {
    protected $name = '';

    protected $name_plural = '';

    protected $table_name = '';

    protected $fields = array();

    protected $keys = array();

    public function createObjectTable() {
        global $wpdb;

        $table_name = $wpdb->prefix . $this->table_name;
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE {$table_name} (";

        $count_fields = count($this->fields);

        $i = 1;
        foreach ($this->fields as $field => $params) {
            $sql .= "{$field} {$params}";

            if ($i < $count_fields) {
                $sql .= ", ";
            }

            $i++;
        }

        if (!empty($this->keys['primary'])) {
            $primary = $this->keys['primary'];
            $sql .= ", ";
            $sql .= "PRIMARY KEY ({$primary})";
        }

        if (!empty($this->keys['keys'])) {
            $count_keys = count($this->keys['keys']);
            $i = 1;
            $sql .= ", ";

            foreach ($this->keys['keys'] as $name => $field) {
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

    public function isTableExists() {
        global $wpdb;
        $table_name = $wpdb->prefix . $this->table_name;

        $sql = $wpdb->prepare( "SHOW TABLES LIKE '%s'", $table_name);

        $result = $wpdb->query($sql);

        return $result;
    }

    public function isTableChanged() {
        $columns_in_db = $this->getColumnsForTable();

        $is_changed = false;

        foreach ($this->fields as $field => $params) {
            if (!in_array($field, $columns_in_db)) {
                $is_changed = true;
            }
        }

        return $is_changed;
    }

    public function getColumnsForTable() {
        global $wpdb;
        $table_name = $wpdb->prefix . $this->table_name;

        $columns = array_map(function ($item) {
            return $item->Field;
        }, $wpdb->get_results('DESCRIBE ' . $table_name . ';'));

        return $columns;
    }
}