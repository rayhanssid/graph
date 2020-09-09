<?php
session_start();
//router Information
$ip = '103.213.236.20';
$username = 'speedtest';
$password = 'ibrahim36';

//database information 

$host = '';
$user = '';
$pass = '';
$db = '';

//height information

$height = '1090';

$home = 'http://localhost/graph/';

include('routeros_api.class.php');

$api = new routeros_api();
$api->connect($ip,$username,$password);
?>