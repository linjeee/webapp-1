<?php

require_once 'vendor/autoload.php';

session_start();

// init configuration
$clientID = '820301954003-qnfbg5178e6h6sc3fdmg1fog3euqt0j2.apps.googleusercontent.com';
$clientSecret = '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';
$redirectUri = 'http://localhost/webapp-1/home.php';

// create Client Request to access Google API
$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUri);
$client->addScope("email");
$client->addScope("profile");

// config for send mail
$mailfrom = "mathawee.li@rmuti.ac.th";
$mailpass = "iqnndohxbuxqiavi";

// Connect to database
$hostname = "localhost";
$username = "root";
$password = "123456789";
$database = "course_db";

$connn = mysqli_connect($hostname, $username, $password, $database);