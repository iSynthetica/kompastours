<?php
/**
 * Created by PhpStorm.
 * User: snth
 * Date: 03.05.19
 * Time: 15:26
 */

$api_key = 'F8BEFCB9-83E4-BD32-E42025AB5D630B80';
$action = 'passport/list';
$data = ['passport' => 'FE498269'];

$curl = curl_init('https://www.moituristy.com/service/' . $action);
$headers = array(
    'X-Mt-Api-Auth-Key: ' . $api_key,
    'X-Mt-Api-Version: 2',
    'Content-type: multipart/form-data'
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, ['data' => json_encode($data)]);
$response = json_decode(curl_exec($curl));
?>

<section class="ptb-40 bg-black-color">

</section>

<section class="ptb-40 bg-aqua-color">

</section>

<section class="ptb-40 bg-black-color">

</section>

<section class="ptb-40 bg-black-color">

</section>
