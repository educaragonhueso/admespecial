<?php

$url='https://maps.googleapis.com/maps/api/geocode/json?address=paseo%20rafael%20esteve%204&key=AIzaSyDORxJ68R5GU5pNKhO0fT_icSShE9c94Ic';
$result = file_get_contents($url);
$ll=json_decode($result, true);

print_r($ll['results'][0]['geometry']['location']);
