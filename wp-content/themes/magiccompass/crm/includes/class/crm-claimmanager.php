<?php

class CRM_ClaimManager {
    public static function create_new_booking_request($data) {
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

        unset($created);

        $claim_meta = array();

        if (!empty($data['claim_type'])) {
            $claim_data['type'] = $data['claim_type'];

            unset($data["claim_type"]);
        }

        if (!empty($data['claim_step'])) {
            $claim_meta['step'] = $data['claim_step'];

            unset($data["claim_step"]);
        }

        if (!empty($data['claim_meta_group'])) {
            $claim_meta['meta_group'] = $data['claim_meta_group'];

            unset($data["claim_meta_group"]);
        }

        $claim_data['parent_id'] = '';
        $claim_data['client_id'] = $data['client_id'];

        unset($data['client_id']);

        $excerpt = array();
        $title = array();

        if (!empty($data["key"])) {
            $claim_meta['key'] = $data["key"];

            unset($data["key"]);
        }

        if (!empty($data["id"])) {
            $claim_meta['id'] = $data["id"];

            unset($data["id"]);
        }

        if (!empty($data["tour_id"])) {
            $claim_meta['tour_id'] = $data["tour_id"];

            unset($data["tour_id"]);
        }

        if (!empty($data["spo"])) {
            $claim_meta['spo'] = $data["spo"];

            unset($data["spo"]);
        }

        if (!empty($data["type"])) {
            $claim_meta['type'] = $data["type"];

            unset($data["type"]);
        }

        if (!empty($data["kind"])) {
            $claim_meta['kind'] = $data["kind"];

            unset($data["kind"]);
        }

        if (!empty($data["country"])) {
            $claim_meta['country'] = $data["country"];

            unset($data["country"]);
        }

        if (!empty($data["country_name"])) {
            $title[] = $data["country_name"];
            $excerpt[] = __('Country', 'snthwp') . ': ' . $data["country_name"];
            $claim_meta['country_name'] = $data["country_name"];

            unset($data["country_name"]);
        }

        if (!empty($data["region"])) {
            $claim_meta['region'] = $data["region"];

            unset($data["region"]);
        }

        if (!empty($data["region_name"])) {
            $title[] = $data["region_name"];
            $excerpt[] = __('Region', 'snthwp') . ': ' . $data["region_name"];
            $claim_meta['region_name'] = $data["region_name"];

            unset($data["region_name"]);
        }

        if (!empty($data["hotel"])) {
            $claim_meta['hotel'] = $data["hotel"];

            unset($data["hotel"]);
        }

        if (!empty($data["hotel_rating"])) {
            $claim_meta['hotel_rating'] = $data["hotel_rating"];
        }

        if (!empty($data["hotel_name"])) {
            $item_title = $data["hotel_name"];

            if (!empty($data["hotel_rating"])) {
                $item_title .= ' ' . ittour_get_hotel_number_rating_by_id($data["hotel_rating"]);
            }

            $title[] = $item_title;
            $excerpt[] = __('Hotel', 'snthwp') . ': ' . $item_title;
            $claim_meta['hotel_name'] = $data["hotel_name"];

            unset($item_title);
            unset($data["hotel_name"]);
            unset($data["hotel_rating"]);
        }

        if (!empty($data["adult_amount"])) {
            $claim_meta['adult_amount'] = $data["adult_amount"];

            $guests = '';
            $guests_title = '';

            $guests .= __('Adults', 'snthwp') . ': ' . $data["adult_amount"];

            $guests_title .= $data["adult_amount"] . __(' adults', 'snthwp');

            if (!empty($data["child_amount"])) {
                $guests .= ', ' . __('Children', 'snthwp') . ': ' . $data["child_amount"];
                $guests_title .= ' + ' . $data["child_amount"] . __(' children', 'snthwp');
            }

            $title[] = $guests_title;
            $excerpt[] = $guests;

            unset($guests);
            unset($guests_title);
            unset($data["adult_amount"]);
        }

        if (!empty($data["child_amount"])) {
            $claim_meta['child_amount'] = $data["child_amount"];

            if (!empty($data["child_age"])) {
                $claim_meta['child_age'] = $data["child_age"];

                unset($data["child_age"]);
            }

            unset($data["child_amount"]);
        }

        if (!empty($data["from_city"])) {
            $claim_meta['from_city'] = $data["from_city"];

            unset($data["from_city"]);
        }

        if (!empty($data["from_city_name"])) {
            $title[] = $data["from_city_name"];
            $excerpt[] = __('Departure city', 'snthwp') . ': ' . $data["from_city_name"];
            $claim_meta['from_city_name'] = $data["from_city_name"];

            unset($data["from_city_name"]);
        }

        if (!empty($data["night_from"])) {
            $title[] = $data["night_from"] . __(' nights', 'snthwp');
            $excerpt[] = __('Tour duration', 'snthwp') . ': ' . $data["night_from"];
            $claim_meta['night_from'] = $data["night_from"];

            unset($data["night_from"]);
        }

        if (!empty($data["meal_type_name"])) {
            $title[] = $data["meal_type_name"];
            $excerpt[] = __('Meal type', 'snthwp') . ': ' . $data["meal_type_name"];
            $claim_meta['meal_type_name'] = $data["meal_type_name"];

            unset($data["meal_type_name"]);
        }

        if (!empty($data["meal_type_short"])) {
            $claim_meta['meal_type_short'] = $data["meal_type_short"];
            $meal_types = ittour_get_meal_types_array();

            foreach ($meal_types as $id => $meal_type) {
                if ($meal_type['short'] === $data["meal_type_short"]) {
                    $data["meal_type"] = $id;
                }
            }

            unset($id);
            unset($meal_type);
            unset($meal_types);
            unset($data["meal_type_short"]);
        }

        if (!empty($data["meal_type"])) {
            $claim_meta['meal_type'] = $data["meal_type"];

            unset($data["meal_type"]);
        }

        if (!empty($data["date_from"])) {
            $title[] = snth_convert_date_to_human($data["date_from"]);
            $excerpt[] = __('Tour start', 'snthwp') . ': ' . snth_convert_date_to_human($data["date_from"]);
            $claim_meta['date_from'] = snth_convert_date_format($data["date_from"], 'Y-m-d', 'd.m.y');

            unset($data["date_from"]);
        }

        if (!empty($data["flight_from"])) {
            $excerpt[] = __('Flight there', 'snthwp') . ': ' . $data["flight_from"];
            $claim_meta['flight_from'] = $data["flight_from"];

            unset($data["flight_from"]);
        }

        if (!empty($data["flight_to"])) {
            $excerpt[] = __('Flight back', 'snthwp') . ': ' . $data["flight_to"];
            $claim_meta['flight_to'] = $data["flight_to"];

            unset($data["flight_to"]);
        }

        if (!empty($data["flight_from_json"])) {
            $claim_meta['flight_from_json'] = json_decode(stripslashes($data["flight_from_json"]), true);

            unset($data["flight_from_json"]);
        }

        if (!empty($data["flight_to_json"])) {
            $claim_meta['flight_to_json'] = json_decode(stripslashes($data["flight_to_json"]), true);

            unset($data["flight_to_json"]);
        }

        if (!empty($data["room_type"])) {
            $claim_meta['room_type'] = $data["room_type"];

            unset($data["room_type"]);
        }

        if (!empty($data["price_uah"])) {
            $claim_meta['price_uah'] = $data["price_uah"];
            $excerpt[] = __('Price', 'snthwp') . ' (' . __('UAH', 'snthwp') . '): ' . $data["price_uah"];

            unset($data["price_uah"]);
        }

        if (!empty($data["price_usd"])) {
            $claim_meta['price_usd'] = $data["price_usd"];
            $excerpt[] = __('Price', 'snthwp') . ' (' . __('USD', 'snthwp') . '): ' . $data["price_usd"];

            unset($data["price_usd"]);
        }

        if (!empty($data["price_euro"])) {
            $claim_meta['price_euro'] = $data["price_euro"];
            $excerpt[] = __('Price', 'snthwp') . ' (' . __('EURO', 'snthwp') . '): ' . $data["price_euro"];

            unset($data["price_euro"]);
        }

        if (!empty($data["price_from"])) {
            $excerpt[] = __('Price From', 'snthwp') . ' (' . $data["main_currency"] . '): ' . $data["price_from"];
        }

        if (!empty($data["price_till"])) {
            $excerpt[] = __('Price Till', 'snthwp') . ' (' . $data["main_currency"] . '): ' . $data["price_till"];
        }

        if (!empty($excerpt)) {
            $claim_data['excerpt'] .= '<ul>';

            foreach ($excerpt as $item) {
                $claim_data['excerpt'] .= '<li>' . $item . '</li>';
            }

            $claim_data['excerpt'] .= '</ul>';

            unset($excerpt);
        }

        if (!empty($title)) {
            $claim_data['title'] = implode(', ', $title);

            unset($title);
        }

        unset($item);

        $claim_id = CRM_Claim::insert($claim_data);

        if ($claim_id) {
            $order_items = array();

            if (!empty($claim_meta['step'])) {
                $mid = CRM_Claim::addMetadata($claim_id, 'claim_step', $claim_meta['step']);

                unset($claim_meta['step']);
            }

            $claim_group = 'claim_meta_group';

            if (!empty($claim_meta['meta_group'])) {
                $claim_group = $claim_meta['meta_group'];

                unset($claim_meta['meta_group']);
            }

            foreach ($claim_meta as $meta_key => $meta_value) {
                $mid = CRM_Claim::addMetadata($claim_id, $meta_key, $meta_value);

                if ($mid) {
                    $order_items[] = $mid;
                }
            }

            $cgid = CRM_Claim::addMetadata($claim_id, $claim_group, $order_items);
        }

        return $claim_id;
    }
}