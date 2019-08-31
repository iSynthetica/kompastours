<?php
/**
 * Created by PhpStorm.
 * User: snth
 * Date: 06.06.19
 * Time: 21:36
 */

class CRM_UserManager {
    public static function getUserDataSections() {
        return array (
            'general' => array (
                'title' => __('General Info')
            ),
        );
    }
}