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

        unset($title);

        return $claim_id;
    }

    public static function send_moituristy_email( $source, $data ) {
        $result = $data;
        $tour_data = '<table style="display:none !important;"><tr>';

        if ('tour_booking_request' === $source) {
            $subject = __('Booking request', 'snthwp');
            $message = __('Ура, бронирование тура на сайте!', 'snthwp');

            $tour_data .= '<td data-source="'.__('Форма бронирование тура на сайте', 'snthwp').'"></td>';
        } else {
            $subject = __('Tour search request', 'snthwp');
            $message = __('Ура, заказ на поиск тура на сайте!', 'snthwp');

            $tour_data .= '<td data-source="'.__('Форма бронирование тура на сайте', 'snthwp').'"></td>';
        }

        $headers = array();

        if (!empty($data["clientEmail"])) {
            $headers[] = 'From: '.$data["clientName"].' <'.$data["clientEmail"].'>';
        } else {
            $headers[] = 'From: '.$data["clientName"];
        }

        $headers[] = 'content-type: text/html';

        $destination = '';

        if (!empty($data["country_name"])) {
            $destination .= $data["country_name"];

            $tour_data .= '<td data-country="'.$data["country_name"].'">'.$data["country_name"].'</td>';
        }

        if (!empty($data["region_name"])) {
            if (!empty($destination)) {
                $destination .= ', ';
            }

            $destination .= $data["region_name"];

            $tour_data .= '<td data-city="'.$data["region_name"].'">'.$data["region_name"].'</td>';
        }

        if (!empty($data["hotel_name"])) {
            $hotel = '';
            if (!empty($destination)) {
                $destination .= ', ';
            }

            $destination .= $data["hotel_name"];
            $hotel .= $data["hotel_name"];

            if (!empty($data["hotel_rating"])) {
                $destination .= ' ' . ittour_get_hotel_number_rating_by_id($data["hotel_rating"]);
                $hotel .= ' ' . ittour_get_hotel_number_rating_by_id($data["hotel_rating"]);
            }

            $tour_data .= '<td data-city="'.$hotel.'">'.$hotel.'</td>';
        }

        if (!empty($destination)) {
            $message .= '<br>' . $destination;
        }

        if (!empty($data["key"])) {
            $message .= '<br> '.__('Tour link on Kompas Tours', 'snthwp').': https://kompas.tours/tour/'.$data["key"] . '/';
            $tour_data .= '<td data-tour="'.'https://kompas.tours/tour/'.$data["key"] . '/'.$data["clientName"].'</td>';
        }

        $client_info = '';

        if (!empty($data["clientName"])) {
            $client_info .= $data["clientName"];

            $tour_data .= '<td data-client="'.$data["clientName"].'">'.$data["clientName"].'</td>';
        }

        if (!empty($data["clientEmail"])) {
            if (!empty($client_info)) {
                $client_info .= ', ';
            }

            $client_info .= $data["clientEmail"];
            $tour_data .= '<td data-email="'.$data["clientEmail"].'">'.$data["clientEmail"].'</td>';
        }

        if (!empty($data["clientPhone"])) {
            if (!empty($client_info)) {
                $client_info .= ', ';
            }

            $client_info .= $data["clientPhone"];

            $tour_data .= '<td data-phone="'.$data["clientPhone"].'">'.$data["clientPhone"].'</td>';

            if (!empty($data["clientViber"]) || !empty($data["clientTelegram"])) {
                $client_info .= ' (';

                if (!empty($data["clientViber"])) {
                    $client_info .= ' viber ';
                }

                if (!empty($data["clientTelegram"])) {
                    $client_info .= ' telegram ';
                }

                $client_info .= ' )';
            }
        }

        if (!empty($client_info)) {
            $message .= '<br><br>' . $client_info;
        }

        $tour_data .= '</tr></table>';


//        $subject = __('Message from contact form');
//
//        $headers = array (
//            'From: '.'Kompas Tours'.' <info@kompas.tours>',
//            'content-type: text/html',
//        );
//
//        // $message = $data;
//
//        $message = '';
//        $message .= 'Ура, заказ!<br>';
//        $message .= 'Турция, Алания<br>';
//        $message .= 'Туристы: 2 взр. + 1 реб<br>';
//        $message .= 'Даты: c 17.07.2019 - по 17.07.2019<br>';
//        $message .= 'Бюджет: 20 000 грн<br>';
//
        $result = wp_mail( '24@z.agent.tat.ua', $subject, $message . $tour_data, $headers );

        return $result;
    }

    public static function send_allinclusivecrm($data) {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.allinclusivecrm.com/v1/site/api/create",
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => http_build_query(array(
                "name"      => "ФОП Лісна Тетяна Владиславівна Компас",
                "phone"     => "+38 (067) 111 2222",
                "email"     => "tetlisna@gmail.com",
                "comment"   => "Еду с 3 детьми",
                "data"      => "Заявки по Турции",
            )),
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer 8311690182:nUCZ-KIjP3Jtz00unE1XuSE2OMtRbanGjLuCWfwr5O3HYP0LMcYQvtV1USF2TamGbR-Cx7sUFXBMQQ3JegRFhneLNqhsv8yZkI8x",
            ),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            return "cURL Error #:" . $err;
        } else {
            return $response;
        }

    }

    public static function send_admin_email( $data ) {
        $email_heading = !empty($data["requestTypeName"]) ? $data["requestTypeName"] : __('New Tour request', 'snthwp');
        $subject = $email_heading;

        $preheader_text = '';

        if (!empty($data['tour_name'])) {
            $preheader_text .= $data['tour_name'];
        }

        if (!empty($data['country_name_list'])) {
            $preheader_text .= ' - ' . $data['country_name_list'];
        }

        if (!empty($data['city_name_list'])) {
            $preheader_text .= ' - ' . $data['city_name_list'];
        }

        $headers = array();
        $headers[] = 'From: Kompas Tours <order.kompas@gmail.com>';
        $headers[] = 'content-type: text/html';

        ob_start();

        snth_show_template('email/email-header.php', array('preheader_text' => $preheader_text));
        snth_show_template('email/email-title.php', array('email_heading' => $email_heading));
        snth_show_template('email/email-tour-info.php', array('tour_info' => $data));
        snth_show_template('email/email-client-info.php', array('tour_info' => $data));
        snth_show_template('email/email-footer.php');

        $email_content = ob_get_clean();

        $tos = array(
            'i.synthetica@gmail.com',
            'test-z1wvbpfpg@mail-tester.com'
        );

        foreach ($tos as $to) {
            $result = wp_mail( $to, $subject, $email_content, $headers );
        }

        return true;
    }

    public static function get_client_id($form_data_array) {
        $user = CRM_User::getByField('user_phone', $form_data_array['clientPhone']);

        if (!$user) {
            $user_data = array(
                'user_display_name' => $form_data_array['clientName'],
                'user_email' => $form_data_array['clientEmail'],
                'user_phone' => $form_data_array['clientPhone'],
                'user_registered' => gmdate( 'Y-m-d H:i:s' ),
            );

            if (!empty($form_data_array['clientViber'])) {
                $user_data['user_viber'] = 1;
            }

            if (!empty($form_data_array['clientTelegram'])) {
                $user_data['user_telegram'] = 1;
            }

            $user_id = CRM_User::insert($user_data);
        } else {
            $user_id = $user->ID;
        }

        return $user_id;
    }
}
