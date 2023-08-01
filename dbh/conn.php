<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "optics";
$conn =  mysqli_connect($servername, $username, $password, $database);

// $cURL = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
// $ip = $_SERVER['REMOTE_ADDR'];
// if ($ip = '::1' || $ip = '127:0:0:1') {
//   $ip = '49.36.102.90';
// }
// $IPLocation = "http://ip-api.com/php/$ip?fields=status,message,country,countryCode,region,regionName,city,currency,timezone";
// $curl = curl_init();
// curl_setopt_array($curl, array(
//   CURLOPT_URL => $IPLocation,
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_ENCODING => '',
//   CURLOPT_MAXREDIRS => 10,
//   CURLOPT_TIMEOUT => 0,
//   CURLOPT_FOLLOWLOCATION => true,
//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//   CURLOPT_CUSTOMREQUEST => 'GET',
// ));
// $response = curl_exec($curl);
// curl_close($curl);
// $response = unserialize($response);
// $timezone = $response['timezone'];
// $country =  $response['country'];
// $country =  $response['country'];
// $city =  $response['city'];
// date_default_timezone_set($timezone);
// $timeStamp = date('Y-m-d:H:i:s');


function ENC($string, $action = 'encrypt')
{
  $encrypt_method = "AES-256-CBC";
  $secret_key = 'ZvOLdaDY4222yxiAVQuD3xg9bjbJ'; // user define private key
  $secret_iv = 'B7hm482C0zj'; // user define secret key
  $key = hash('sha256', $secret_key);
  $iv = substr(hash('sha256', $secret_iv), 0, 16); // sha256 is hash_hmac_algo
  if ($action == 'encrypt') {
    $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
    $output = base64_encode($output);
  } else if ($action == 'decrypt') {
    $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
  }
  return $output;
}
