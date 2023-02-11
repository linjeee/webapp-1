<?php

include '../components/connect.php';

if(isset($_COOKIE['admin_id'])){
   $tutor_id = $_COOKIE['admin_id'];
}else{
   $tutor_id = '';
   header('location:login.php');
}

$select_contents = $conn->prepare("SELECT * FROM `admin` WHERE email = ?");
$select_contents->execute([$tutor_id]);
$total_contents = $select_contents->rowCount();

$select_user = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
$select_user->execute([$tutor_id]);
$total_user = $select_user->rowCount();

// $select_playlists = $conn->prepare("SELECT * FROM `playlist` WHERE tutor_id = ?");
// $select_playlists->execute([$tutor_id]);
// $total_playlists = $select_playlists->rowCount();

// $select_likes = $conn->prepare("SELECT * FROM `likes` WHERE tutor_id = ?");
// $select_likes->execute([$tutor_id]);
// $total_likes = $select_likes->rowCount();

// $select_comments = $conn->prepare("SELECT * FROM `comments` WHERE tutor_id = ?");
// $select_comments->execute([$tutor_id]);
// $total_comments = $select_comments->rowCount();

$select_post = $conn->prepare("SELECT * FROM `post` WHERE  user_id = ?");
$select_post->execute([$tutor_id]);
$total_post = $select_post->rowCount();

$select_content = $conn->prepare("SELECT * FROM `content` WHERE  user_id = ?");
$select_content->execute([$tutor_id]);
$total_content = $select_content->rowCount();

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Dashboard</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>
   
<section class="dashboard">

   <h1 class="heading">dashboard</h1>

   <div class="box-container">

      <div class="box">
         <h3>welcome!</h3>
         <p><?= $fetch_profile['name']; ?></p>
         <a href="profile.php" class="btn">view profile</a>
      </div>
      <div class="box">
         <!-- <h3><?= $total_contents; ?></h3> -->
         <p>total admin</p>
         <a href="view_admin.php" class="btn">View Admin</a>
      </div>
      <div class="box">
         <!-- <h3><?= $total_user; ?></h3> -->
         <p>total user</p>
         <a href="view_student.php" class="btn">View User</a>
      </div>
      <div class="box">
         <!-- <h3><?= $total_post; ?></h3> -->
         <p>total post & video </p>
         <a href="managedata.php" class="btn">View post & video</a>
      </div>
      <div class="box">
         <!-- <h3><?= $total_post; ?></h3> -->
         <p>total message </p>
         <a href="view_message.php" class="btn">View Message</a>
      </div>
      <!-- <div class="box">
         <h3><?= $total_playlists; ?></h3>
         <p>total playlists</p>
         <a href="add_playlist.php" class="btn">add new playlist</a>
      </div>
      <div class="box">
         <h3><?= $total_contents; ?></h3>
         <p>total contents</p>
         <a href="add_content.php" class="btn">add new content</a>
      </div> -->
      <!-- <div class="box">
         <h3><?= $total_post; ?></h3>
         <p>total post</p>
         <a href="post.php" class="btn">view post</a>
      </div> -->

      <div class="box">
         <!-- <h3><?= $total_likes; ?></h3>
         <p>total likes</p>
         <a href="contents.php" class="btn">view contents</a>
      </div>

      <div class="box">
         <h3><?= $total_comments; ?></h3>
         <p>total comments</p>
         <a href="comments.php" class="btn">view comments</a>
      </div>
      <div class="box">
         <h3><?= $total_post; ?></h3>
         <p>total post</p>
         <a href="teachers1.php" class="btn">view post</a>
      </div> -->
<!-- 
      <div class="box">
         <h3>quick select</h3>
         <p>login or register</p>
         <div class="flex-btn">
            <a href="login.php" class="option-btn">login</a>
            <a href="register.php" class="option-btn">register</a>
         </div>
      </div> -->

   </div>

</section>















<?php include '../components/footer.php'; ?>
<script src="../js/admin_script.js"></script>

</body>
</html>