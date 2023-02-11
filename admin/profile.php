<?php

   include '../components/connect.php';

   if(isset($_COOKIE['admin_id'])){
      $tutor_id = $_COOKIE['admin_id'];
   }else{
      $tutor_id = '';
      header('location:login.php');
   }

//    $select_playlists = $conn->prepare("SELECT * FROM `playlist` WHERE tutor_id = ?");
//    $select_playlists->execute([$tutor_id]);
//    $total_playlists = $select_playlists->rowCount();

//    $select_contents = $conn->prepare("SELECT * FROM `content` WHERE tutor_id = ?");
//    $select_contents->execute([$tutor_id]);
//    $total_contents = $select_contents->rowCount();

//    $select_likes = $conn->prepare("SELECT * FROM `likes` WHERE tutor_id = ?");
//    $select_likes->execute([$tutor_id]);
//    $total_likes = $select_likes->rowCount();

//    $select_comments = $conn->prepare("SELECT * FROM `comments` WHERE tutor_id = ?");
//    $select_comments->execute([$tutor_id]);
//    $total_comments = $select_comments->rowCount();

//    $select_bookmark = $conn->prepare("SELECT * FROM `bookmark` WHERE tutor_id = ?");
//    $select_bookmark->execute([$tutor_id]);
//    $total_bookmark = $select_bookmark->rowCount();

//    $select_post = $conn->prepare("SELECT * FROM `post` WHERE tutor_id = ?");
//    $select_post->execute([$tutor_id]);
//    $total_post = $select_post->rowCount();

   

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Profile</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>
   
<section class="tutor-profile" style="min-height: calc(100vh - 19rem);"> 

   <h1 class="heading">profile details</h1>

   <div class="details">
      <div class="tutor">
         <img src="../uploaded_files/<?= $fetch_profile['image']; ?>" alt="">
         <h3><?= $fetch_profile['name']; ?></h3>
         <span><?= $fetch_profile['profession']; ?></span>
         <a href="update.php" class="inline-btn">update profile</a>
      </div>
      

      <!-- <div class="box-container">

<div class="box">
   <div class="flex">
      <i class="fas fa-bookmark"></i>
      <div>
         <h3><?= $total_playlists; ?></h3>
         <p class="p1">Total playlists</p>
      </div>
   </div>
   <a href="playlists.php" class="inline-btn">View Playlists</a>
</div>

<div class="box">
   <div class="flex">
      <i class="fas fa-video"></i>
      <div>
         <h3><?= $total_contents; ?></h3>
         <p class="p1">Total Videos </p>
      </div>
   </div>
   <a href="contents.php" class="inline-btn">View Contents</a>
</div>

<div class="box">
   <div class="flex">
      <i class="fas fa-heart"></i>
      <div>
         <h3><?= $total_likes; ?></h3>
         <p class="p1">Total Likes</p>
      </div>
   </div>
   <a href="likes.php" class="inline-btn">View like</a>
</div>
<div class="box">
   <div class="flex">
      <i class="fas fa-comment"></i>
      <div>
         <h3><?= $total_comments; ?></h3>
         <p class="p1">Total Comments </p>
      </div>
   </div>
   <a href="comments.php" class="inline-btn">View Comments</a>
</div>
<div class="box">
   <div class="flex">
      <i class="fas fa-bookmark"></i>
      <div>
         <h3><?= $total_bookmark; ?></h3>
         <p class="p1">Bookmark</p>
      </div>
   </div>
   <a href="bookmark.php" class="inline-btn">View Bookmark</a>
</div>
<div class="box">
   <div class="flex">
      <i class="fas fa-pen"></i>
      <div>
         <h3><?= $total_post; ?></h3>
         <p class="p1">Total Post</p>
      </div>
   </div>
   <a href="post.php" class="inline-btn">View post</a>
</div>

</div>
     
   </div> -->

</section>
<style>
   .p1 {
      font-size: 1.5rem;
   color: var(--light-color);
   }
.box-container{
   display: flex;
   flex-wrap: wrap;
   align-items: flex-end;
   gap: 1.5rem;
}

.box-container .box{
   background-color: var(--light-bg);
   border-radius: .5rem;
   padding: 2rem;
   flex: 1 1 30rem;
}

.box-container .box .flex{
   display: flex;
   align-items: center;
   gap: 1.7rem;
   margin-bottom: 1rem;
}

.box-container .box .flex i{
   height: 4.5rem;
   width: 4.5rem;
   border-radius: .5rem;
   background-color: var(--black);
   line-height: 4.4rem;
   font-size: 2rem;
   color: var(--white);
   text-align: center;
}

.box-container .box .flex h3{
   font-size: 2rem;
   color: var(--main-color);
   margin-bottom: .2rem;
}

.box-container .box .flex .span{
   font-size: 1.5rem;
   color: var(--light-color);
}
:root{
   --main-color:#3388FF;
   --red:#e74c3c;
   --oragen:#f39c12;
   --white:#fff;
   --black:#2c3e50;
   --light-color:#888;
   --light-bg:#eee;
   --border:.1rem solid rgba(0,0,0,.2);
}

*{
   font-family: 'Nunito', sans-serif;
   margin: 0; padding: 0;
   box-sizing: border-box;
   outline: none; border: none;
   text-decoration: none;
}
</style>















<?php include '../components/footer.php'; ?>
<script src="../js/admin_script.js"></script>

</body>
</html>