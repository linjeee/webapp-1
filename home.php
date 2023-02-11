<?php

require_once 'config.php';
include 'components/connect.php';

if (isset($_COOKIE['user_id'])) {
   $user_id = $_COOKIE['user_id'];
} else {
   $user_id = '';
}

$select_likes = $conn->prepare("SELECT * FROM `likes` WHERE user_id = ?");
$select_likes->execute([$user_id]);
$total_likes = $select_likes->rowCount();

$select_comments = $conn->prepare("SELECT * FROM `comments` WHERE user_id = ?");
$select_comments->execute([$user_id]);
$total_comments = $select_comments->rowCount();

$select_bookmark = $conn->prepare("SELECT * FROM `bookmark` WHERE user_id = ?");
$select_bookmark->execute([$user_id]);
$total_bookmarked = $select_bookmark->rowCount();


$select_port = $conn->prepare("SELECT * FROM `commentss` WHERE user_id = ?");
$select_port->execute([$user_id]);
$total_port = $select_port->rowCount();


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

   header("Refresh:0; home.php");
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
   <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php include 'components/user_header.php'; ?>


   <!-- quick select section starts  -->

   <section class="quick-select">
<!-- 
      <img src="<?= $userinfo['picture'] ?>" alt="" width="90px" height="90px">
      <ul>
         <li>Full Name: <?= $userinfo['full_name'] ?></li>
         <li>Email Address: <?= $userinfo['email'] ?></li>
         <li><a href="logout.php">Logout</a></li>
      </ul> -->

      <h1 class="heading">quick options</h1>

      <div class="box-container">

         <?php
         if ($user_id !== '') {
         ?>
            <!-- <div class="box">
               <h3 class="title">likes and comments</h3>
               <p>total likes : <span><?= $total_likes; ?></span></p>
               <a href="like.php" class="inline-btn">view likes</a>
               <p>total comments : <span><?= $total_comments; ?></span></p>
               <a href="comment.php" class="inline-btn">view comments</a>
               <p>saved playlist : <span><?= $total_bookmarked; ?></span></p>
               <a href="bookmark.php" class="inline-btn">view bookmark</a>
            </div> -->
         <?php
         } else {
         ?>
            <div class="box" style="text-align: center;">
               <h3 class="title">please login </h3>
            </div>
         <?php
         }
         ?>

         <div class="box">
            <h3 class="title">top categories</h3>
            <div class="flex">
               <a href="#"><i class="fa-sharp fa-solid fa-book"></i><span>homework</span></a>
               <a href="#"><i class="fas fa-pen"></i><span>network</span></a>
               <a href="#"><i class="fas fa-chart-line"></i><span>micro</span></a>
               <a href="#"><i class="fas fa-music"></i><span>music</span></a>
               <a href="#"><i class="fas fa-camera"></i><span>photography</span></a>
               <a href="#"><i class="fas fa-cog"></i><span>software</span></a>
               <a href="#"><i class="fas fa-vial"></i><span>science</span></a>
            </div>
         </div>

         <div class="box">
            <h3 class="title">popular topics</h3>
            <div class="flex">
               <a href="#"><i class="fab fa-html5"></i><span>HTML</span></a>
               <a href="#"><i class="fab fa-css3"></i><span>CSS</span></a>
               <a href="#"><i class="fab fa-js"></i><span>javascript</span></a>
               <a href="#"><i class="fab fa-react"></i><span>react</span></a>
               <a href="#"><i class="fab fa-php"></i><span>PHP</span></a>
               <a href="#"><i class="fab fa-bootstrap"></i><span>bootstrap</span></a>
            </div>
         </div>
         <!-- <div class="box tutor">
         <h3 class="title">become a Students</h3>
         <p>If you want to join as an instructor, click on the button below.</p>
         <a href="admin/register.php" class="inline-btn">Get started</a>
      </div> -->

      </div>

   </section>

</body>

</html>

<!-- quick select section ends -->

<!-- courses section starts  -->

<section class="courses">

   <h1 class="heading">Latest Playlists</h1>

   <div class="box-container">

      <?php
      $select_courses = $conn->prepare("SELECT * FROM `playlist` WHERE status = ? ORDER BY date DESC LIMIT 6");
      $select_courses->execute(['active']);
      if ($select_courses->rowCount() > 0) {
         while ($fetch_course = $select_courses->fetch(PDO::FETCH_ASSOC)) {
            $course_id = $fetch_course['id'];

            $select_tutor = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_tutor->execute([$fetch_course['user_id']]);
            $fetch_tutor = $select_tutor->fetch(PDO::FETCH_ASSOC);
      ?>
            <?php
            if ($user_id != '') {
            ?>
               <div class="box">
                  <div class="tutor">
                     <img src="<?= $fetch_tutor['image']; ?>" alt="">
                     <div>
                        <h3><?= $fetch_tutor['name']; ?></h3>
                        <span><?= $fetch_course['date']; ?></span>
                     </div>
                  </div>
                  <img src="uploaded_files/<?= $fetch_course['thumb']; ?>" class="thumb" alt="">
                  <h3 class="title"><?= $fetch_course['title']; ?></h3>
                  <a href="playlist2.php?get_id=<?= $course_id; ?>" class="inline-btn">View Playlists</a>
               </div>
            <?php
            } else {
            ?>
               <div class="box" style="text-align: center;">
                  <h3 class="title">please login</h3>
               </div>
            <?php
            }
            ?>
      <?php
         }
      } else {
         echo '<p class="empty">no courses added yet!</p>';
      }
      ?>

   </div>

   <!-- <div class="more-btn">
      <a href="courses.php" class="inline-option-btn">view more</a>
   </div> -->

</section>

<!-- courses section ends -->










<!-- footer section starts  -->

<!-- footer section ends -->
<?php include 'components/footer.php'; ?>
<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>

</html>