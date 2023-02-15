<?php

include '../components/connect.php';

if(isset($_COOKIE['admin_id'])){
   $tutor_id = $_COOKIE['admin_id'];
}else{
   $tutor_id = '';
   header('location:login.php');
}


// if(isset($_POST['delete_playlist'])){
//    $delete_id = $_POST['playlists_id'];
//    $delete_id = filter_var($delete_id);

//    $verify_playlist = $conn->prepare("SELECT * FROM `playlist` WHERE id = ?");
//    $verify_playlist->execute([$delete_id]);

//    if($verify_playlist->rowCount() > 0){

   

//    $delete_playlist_thumb = $conn->prepare("SELECT * FROM `playlist` WHERE id = ?");
//    $delete_playlist_thumb->execute([$delete_id]);
//    $fetch_thumb = $delete_playlist_thumb->fetch(PDO::FETCH_ASSOC);
//    $delete_bookmark = $conn->prepare("DELETE FROM `bookmark` WHERE playlist_id = ?");
//    $delete_bookmark->execute([$delete_id]);
//    $delete_playlist = $conn->prepare("DELETE FROM `playlist` WHERE id = ?");
//    $delete_playlist->execute([$delete_id]);
//    $message[] = 'playlist deleted!';
//    }else{
//       $message[] = 'playlist already deleted!';
//    }



// }

if(isset($_POST['delete_video'])){
   $delete_id = $_POST['video_id'];
   $delete_id = filter_var($delete_id);
   $verify_video = $conn->prepare("SELECT * FROM `content` WHERE id = ? ");
   $verify_video->execute([$delete_id]);
   if($verify_video->rowCount() > 0){
      $delete_video_thumb = $conn->prepare("SELECT * FROM `content` WHERE id = ?");
      $delete_video_thumb->execute([$delete_id]);
      $fetch_thumb = $delete_video_thumb->fetch(PDO::FETCH_ASSOC);
      $delete_video = $conn->prepare("SELECT * FROM `content` WHERE id = ?");
      $delete_video->execute([$delete_id]);
      $fetch_video = $delete_video->fetch(PDO::FETCH_ASSOC);
      $delete_likes = $conn->prepare("DELETE FROM `likes` WHERE content_id = ?");
      $delete_likes->execute([$delete_id]);
      $delete_comments = $conn->prepare("DELETE FROM `comments` WHERE content_id = ?");
      $delete_comments->execute([$delete_id]);
      $delete_content = $conn->prepare("DELETE FROM `content` WHERE id = ?");
      $delete_content->execute([$delete_id]);
      $message[] = 'video deleted!';
   }else{
      $message[] = 'video already deleted!';
   }

}
if(isset($_POST['updatepost'])){

   $status = $_POST['status'];
   $status = filter_var($status, FILTER_SANITIZE_STRING);
   

   $update_content = $conn->prepare("UPDATE `post` SET  status = ? ");
   $update_content->execute([ $status]);

   $message[] = 'post updated!';

}

if(isset($_POST['updatecontent'])){

   $status = $_POST['status'];
   $status = filter_var($status, FILTER_SANITIZE_STRING);
   

   $update_content = $conn->prepare("UPDATE `content` SET  status = ? ");
   $update_content->execute([ $status]);

   $message[] = 'content updated!';

}


if(isset($_POST['delete_post'])){
    $delete_id = $_POST['post_id'];
    $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);
    $verify_video = $conn->prepare("SELECT * FROM `post` WHERE id = ? ");
    $verify_video->execute([$delete_id]);
    if($verify_video->rowCount() > 0){
       $delete_video_thumb = $conn->prepare("SELECT * FROM `post` WHERE id = ?");
       $delete_video_thumb->execute([$delete_id]);
       $fetch_thumb = $delete_video_thumb->fetch(PDO::FETCH_ASSOC);
       $delete_video = $conn->prepare("SELECT * FROM `post` WHERE id = ?");
       $delete_video->execute([$delete_id]);
       $fetch_video = $delete_video->fetch(PDO::FETCH_ASSOC);
       $delete_likes = $conn->prepare("DELETE FROM `likes` WHERE post_id = ?");
       $delete_likes->execute([$delete_id]);
       $delete_comments = $conn->prepare("DELETE FROM `comments` WHERE post_id = ?");
       $delete_comments->execute([$delete_id]);
       $delete_content = $conn->prepare("DELETE FROM `post` WHERE id = ?");
       $delete_content->execute([$delete_id]);
       $message[] = 'Post deleted!';
    }else{
       $message[] = 'Post already deleted!';
    }
 
 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Manage Data</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>
   
<section class="contents">
<!-- <h1 class="heading">Manage Playlist</h1>
     
     <div class="box-container">
  
        <?php
  
  
           $select_tutors = $conn->prepare("SELECT * FROM `playlist`");
           $select_tutors->execute();
         
           if($select_tutors->rowCount() > 0){
              while($fetch_tutor = $select_tutors->fetch(PDO::FETCH_ASSOC)){
                  
        ?>
        <div class="box">
           <div class="flex">
           </div>
           <img src="../uploaded_files/<?= $fetch_tutor['thumb']; ?>" class="thumb" alt="">
           <h3 style="font-size:2.5rem;"><?= $fetch_tutor['title']; ?></h3>
           <h3 style="font-size:1.7rem;color: var(--light-color);"><?= $fetch_tutor['description']; ?></h3>
           <h3  style="font-size:1.7rem;color: var(--light-color); "><?= $fetch_tutor['date']; ?></h3>
           <form action="" method="post" class="flex-btn">
              <input type="hidden" name="playlists_id" value="<?= $fetch_tutor['id']; ?>">
              <input type="submit" value="delete" class="delete-btn" onclick="return confirm('delete this video?');" name="delete_playlist">
           </form>
           <a href="view_post.php?get_id=<?= $video_id; ?>" class="btn">view post</a>
        </div>
        <?php
              }
           }else{
              echo '<p class="empty">no video found!</p>';
           }
        ?>
  
     </div> -->
   <h1 class="heading">Manage Video</h1>
     
   <div class="box-container">

      <?php


         $select_tutors = $conn->prepare("SELECT * FROM `content`");
         $select_tutors->execute();
       
         if($select_tutors->rowCount() > 0){
            while($fetch_tutor = $select_tutors->fetch(PDO::FETCH_ASSOC)){
                
      ?>
      <div class="box">
         <div class="flex">
         </div>
         <div><i class="fas fa-dot-circle" style="font-size:3rem;margin-right:.7rem;<?php if($fetch_tutor['status'] == 'active'){echo 'color:limegreen'; }else{echo 'color:red';} ?>"></i><span style="font-size:1.5rem;<?php if($fetch_tutor['status'] == 'active'){echo 'color:limegreen'; }else{echo 'color:red';} ?>"><?= $fetch_tutor['status']; ?></span></div>
         <img src="../uploaded_files/<?= $fetch_tutor['thumb']; ?>" class="thumb" alt="">
         <h3 style="font-size:2.5rem;"><?= $fetch_tutor['title']; ?></h3>
         <h3 style="font-size:1.7rem;color: var(--light-color);"><?= $fetch_tutor['description']; ?></h3>
         <h3  style="font-size:1.7rem;color: var(--light-color); "><?= $fetch_tutor['date']; ?></h3>
         <form action="" method="post" class="flex-btn">
            <input type="hidden" name="video_id" value="<?= $fetch_tutor['id']; ?>">
            <input type="submit" value="delete" class="delete-btn" onclick="return confirm('delete this video?');" name="delete_video">
         </form>
         <form action="" method="post" enctype="multipart/form-data">
         <p style="font-size:1.7rem;color: var(--light-color);">update status </p>
      <select name="status" class="box" required>
         <option value="<?= $fetch_tutor['status']; ?>" selected><?= $fetch_tutor['status']; ?></option>
         <option value="active" style="color:limegreen;">active</option>
         <option value="deactive"  style="color:red;">deactive</option>
      </select>
<input type="submit" value="update" name="updatecontent" class="option-btn">
            </form>
      </div>
      <?php
            }
         }else{
            echo '<p class="empty">no video found!</p>';
         }
      ?>

   </div>
   <h1 class="heading">Manage Post</h1>

   <div class="box-container">

      <?php
         $select_tutors = $conn->prepare("SELECT * FROM `post`");
         $select_tutors->execute();
         if($select_tutors->rowCount() > 0){
            while($fetch_tutor = $select_tutors->fetch(PDO::FETCH_ASSOC)){
      ?>
      <div class="box">
         <div class="flex">
         </div>
         <div><i class="fas fa-dot-circle" style="font-size:3rem;margin-right:.7rem;<?php if($fetch_tutor['status'] == 'active'){echo 'color:limegreen'; }else{echo 'color:red';} ?>"></i><span style="font-size:1.5rem;<?php if($fetch_tutor['status'] == 'active'){echo 'color:limegreen'; }else{echo 'color:red';} ?>"><?= $fetch_tutor['status']; ?></span></div>
         <img src="../uploaded_files/<?= $fetch_tutor['thumb']; ?>" class="thumb" alt="">
         <h3 style="font-size:2.5rem;"><?= $fetch_tutor['title']; ?></h3>
         <h3 style="font-size:1.7rem;color: var(--light-color);"><?= $fetch_tutor['description']; ?></h3>
         <h3  style="font-size:1.7rem;color: var(--light-color); "><?= $fetch_tutor['date']; ?></h3>
         <form action="" method="post" class="flex-btn">
            <input type="hidden" name="post_id" value="<?= $fetch_tutor['id']; ?>">
            <input type="submit" value="delete" class="delete-btn" onclick="return confirm('delete this post?');" name="delete_post">
         </form>
         <form action="" method="post" enctype="multipart/form-data">
      <p style="font-size:1.7rem;color: var(--light-color);">update status </p>
      <select name="status" class="box" required>
         <option value="<?= $fetch_tutor['status']; ?>" selected><?= $fetch_tutor['status'];?></option>
         <option value="active" style="color:limegreen;">active</option>
         <option value="deactive"  style="color:red;">deactive</option>
      </select>
      <input type="submit" value="update"  name="updatepost" class="option-btn">
            </form>
      </div>
      <?php
            }
         }else{
            echo '<p class="empty">no post found!</p>';
         }
      ?>

   </div>


</section>




<style>
   .actives {
      color:green;
   }
</style>










<?php include '../components/footer.php'; ?>
<script src="../js/admin_script.js"></script>

</body>
</html>