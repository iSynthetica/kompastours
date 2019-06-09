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
            'type' => 'tour',
            'status' => 'pending',
            'created' => $created,
            'modified' => $created,
        );

        if (!empty($data['claim_type'])) {
            $claim_data['type'] = $data['claim_type'];
        }

        $order_items = array();

        $claim_data['parent_id'] = '';
        $claim_data['client_id'] = $data['client_id'];
        $claim_data['title'] = array();

        unset($data['client_id']);

        $excerpt = array();

        if (!empty($data["destination"])) {
            $excerpt[] = __('Destination', 'snthwp') . ': ' . $data["destination"];
        }

        if (!empty($data["country"])) {
            $claim_data['title'][] = $data["country"];
            $excerpt[] = __('Country', 'snthwp') . ': ' . $data["destination"];
        }

        if (!empty($data["hotel"])) {
            $claim_data['title'][] = $data["hotel"];
            $excerpt[] = __('Hotel', 'snthwp') . ': ' . $data["hotel"];
        }

        if (!empty($data["city_from"])) {
            $claim_data['title'][] = $data["city_from"];
            $excerpt[] = __('Departure city', 'snthwp') . ': ' . $data["city_from"];
        }

        if (!empty($data["date_from"])) {
            $excerpt[] = __('Tour start', 'snthwp') . ': ' . $data["date_from"];
        }

        if (!empty($data["night_from"])) {
            $claim_data['title'][] = $data["night_from"] . __(' nights', 'snthwp');
            $excerpt[] = __('Tour duration', 'snthwp') . ': ' . $data["night_from"];
        }

        if (!empty($data["meal_type"])) {
            $excerpt[] = __('Meal type', 'snthwp') . ': ' . $data["meal_type"];
        }

        if (!empty($data["adult_amount"])) {
            $guests = '';
            $guests_title = '';

            $guests .= __('Adults', 'snthwp') . ': ' . $data["adult_amount"];

            $guests_title .= $data["adult_amount"] . __(' adults', 'snthwp');

            if (!empty($data["child_amount"])) {
                $guests_title .= ' + ' . $data["child_amount"] . __(' children', 'snthwp');
                $guests .= ', ' . __('Children', 'snthwp') . ': ' . $data["child_amount"];
            }

            $excerpt[] = $guests;
            $claim_data['title'][] = $guests_title;
        }

        if (!empty($data["key"])) {
            $excerpt[] = __('Key', 'snthwp') . ': ' . $data["key"];
        }

        if (!empty($data["price_from"])) {
            $excerpt[] = __('Price From', 'snthwp') . ' (' . $data["main_currency"] . '): ' . $data["price_from"];
        }

        if (!empty($data["price_till"])) {
            $excerpt[] = __('Price Till', 'snthwp') . ' (' . $data["main_currency"] . '): ' . $data["price_till"];
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
            $claim_data['excerpt'] .= '<ul>';
            foreach ($excerpt as $item) {
                $claim_data['excerpt'] .= '<li>' . $item . '</li>';
            }
            $claim_data['excerpt'] .= '</ul>';
        }

        if (!empty($claim_data['title'])) {
            $claim_data['title'] = implode(', ', $claim_data['title']);
        }

        $claim_id = CRM_Claim::insert($claim_data);

        if ($claim_id) {
            foreach ($data as $meta_key => $meta_value) {
                $mid = CRM_Claim::addMetadata($claim_id, $meta_key, $meta_value);

                if ($mid) {
                    $order_items[] = $mid;
                }
            }

            $cgid = CRM_Claim::addMetadata($claim_id, 'claim_group', $order_items);
        }

        return $claim_id;
    }
}