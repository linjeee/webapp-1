<?php

require_once 'config.php';

// authenticate code from Google OAuth Flow
if (isset($_GET['code'])) {
   $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
   $_SESSION['token'] = $client->getAccessToken();

   if (isset($_SESSION['token'])) {
      $client->setAccessToken($token['access_token']);
   }

   if ($client->getAccessToken($_SESSION['token'])) {
      // get profile info
      $google_oauth = new Google_Service_Oauth2($client);
      $google_account_info = $google_oauth->userinfo->get();

      $userinfo = [
         'email' => $google_account_info['email'],
         'first_name' => $google_account_info['givenName'],
         'last_name' => $google_account_info['familyName'],
         // 'gender' => $google_account_info['gender'],
         'name' => $google_account_info['name'],
         'image' => $google_account_info['picture'],
         'verifiedEmail' => $google_account_info['verifiedEmail'],
         'token' => $google_account_info['id'],
      ];

      // checking if user is already exists in database
      $sql = "SELECT * FROM users WHERE email ='{$userinfo['email']}'";
      $result = mysqli_query($connn, $sql);

      if (mysqli_num_rows($result) > 0) {
         // user is exists
         $userinfo = mysqli_fetch_assoc($result);
         $token = $userinfo['token'];
      } else {
         // user is not exists
         $sql = "INSERT INTO users (email, first_name, last_name, name, image, verifiedEmail, token) VALUES ('{$userinfo['email']}', '{$userinfo['first_name']}', '{$userinfo['last_name']}', '{$userinfo['name']}', '{$userinfo['image']}', '{$userinfo['verifiedEmail']}', '{$userinfo['token']}')";
         $result = mysqli_query($connn, $sql);
         if ($result) {
            $token = $userinfo['token'];
         } else {
            echo "User is not created";
            die();
         }
      }

      // save user data into session
      $_SESSION['user_token'] = $token;
   }

   // header("Refresh:0; home.php");
} else {

   if (!isset($_SESSION['user_token']) && isset($_COOKIE['user_id']) === '' ) {
      header("Location: login2.php");
      die();
   }

   if(isset($_SESSION['user_token'])){

      // checking if user is already exists in database
      $sql = "SELECT * FROM users WHERE token ='{$_SESSION['user_token']}'";
      $result = mysqli_query($connn, $sql);
      if (mysqli_num_rows($result) > 0) {
         // user is exists
         $userinfo = mysqli_fetch_assoc($result);
      }
      $user_id = $userinfo['id'];
   }

}