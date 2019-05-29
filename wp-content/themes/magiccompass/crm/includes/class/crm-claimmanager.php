<?php

class CRM_ClaimManager {
    public static function create_new_booking_request($data) {
        $destination = $data['destination'];

        $created = gmdate( 'Y-m-d H:i:s' );

        $claim_data = array(
            'parent_id' => '',
            'client_id' => '',
            'title' => '',
            'excerpt' => '',
            'type' => 'tour_booking_request',
            'status' => 'pending',
            'created' => $created,
            'modified' => $created,
        );

        $claim_data['parent_id'] = '';
        $claim_data['client_id'] = $data['client_id'];
        $claim_data['title'] = $destination;

        $excerpt = array();

        if (!empty($data["destination"])) {
            $excerpt[] = __('Destination', 'snthwp') . ': ' . $data["destination"];
        }

        if (!empty($data["hotel"])) {
            $excerpt[] = __('Hotel', 'snthwp') . ': ' . $data["hotel"];
        }

        if (!empty($data["date_from"])) {
            $excerpt[] = __('Tour start', 'snthwp') . ': ' . $data["date_from"];
        }

        if (!empty($data["duration"])) {
            $excerpt[] = __('Tour duration', 'snthwp') . ': ' . $data["duration"];
        }

        if (!empty($data["meal_type"])) {
            $excerpt[] = __('Meal type', 'snthwp') . ': ' . $data["meal_type"];
        }

        if (!empty($data["adult_amount"])) {
            $guests = '';
            $guests .= __('Adults', 'snthwp') . ': ' . $data["adult_amount"];
            $excerpt[] = $guests;
        }

        if (!empty($data["key"])) {
            $excerpt[] = __('Key', 'snthwp') . ': ' . $data["key"];
        }

        if (!empty($data["price_uah"])) {
            $excerpt[] = __('Price', 'snthwp') . ' (' . __('UAH', 'snthwp') . '): ' . $data["price_uah"];
        }

        if (!empty($data["price_usd"])) {
            $excerpt[] = __('Price', 'snthwp') . ' (' . __('USD', 'snthwp') . '): ' . $data["price_usd"];
        }

        if (!empty($data["price_euro"])) {
            $excerpt[] = __('Price', 'snthwp') . ' (' . __('EURO', 'snthwp') . '): ' . $data["price_euro"];
        }

        if (!empty($excerpt)) {
            foreach ($excerpt as $item) {
                $claim_data['excerpt'] .= '<p>' . $item . '</p>';
            }
        }

        $claim_id = CRM_Claim::insert($claim_data);

        return true;
    }
}