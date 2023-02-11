<?php

include 'components/connect.php';


if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
}

include 'logic/login_with_gmail.php';
if(isset($_POST['delete'])){
   $delete_id = $_POST['playlist_id'];
   $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);

   $verify_playlist = $conn->prepare("SELECT * FROM `playlist` WHERE id = ? AND user_id = ? LIMIT 1");
   $verify_playlist->execute([$delete_id, $user_id]);

   if($verify_playlist->rowCount() > 0){

   

   $delete_playlist_thumb = $conn->prepare("SELECT * FROM `playlist` WHERE id = ? LIMIT 1");
   $delete_playlist_thumb->execute([$delete_id]);
   $fetch_thumb = $delete_playlist_thumb->fetch(PDO::FETCH_ASSOC);
   $delete_bookmark = $conn->prepare("DELETE FROM `bookmark` WHERE playlist_id = ?");
   $delete_bookmark->execute([$delete_id]);
   $delete_playlist = $conn->prepare("DELETE FROM `playlist` WHERE id = ?");
   $delete_playlist->execute([$delete_id]);
   $message[] = 'playlist deleted!';
   }else{
      $message[] = 'playlist already deleted!';
   }
}

?>

<?php include 'logic/login_with_gmail.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Playlists</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>

<?php include 'components/user_header.php'; ?>

<section class="playlists">

   <h1 class="heading">added playlists</h1>

   <div class="box-container">
   
   <?php
         if ($user_id !== '') {
         ?>
   
      <div class="box" style="text-align: center;">
         <h3 class="title" style="margin-bottom: .5rem;">create new playlist</h3>
         <a href="add_playlist.php" class="btn">add playlist</a>
      </div>

      <?php
         $select_playlist = $conn->prepare("SELECT * FROM `playlist` WHERE user_id = ? ORDER BY date DESC");
         $select_playlist->execute([$user_id]);
         if($select_playlist->rowCount() > 0){
         while($fetch_playlist = $select_playlist->fetch(PDO::FETCH_ASSOC)){
            $playlist_id = $fetch_playlist['id'];
            $count_videos = $conn->prepare("SELECT * FROM `content` WHERE playlist_id = ?");
            $count_videos->execute([$playlist_id]);
            $total_videos = $count_videos->rowCount();

            $count_post = $conn->prepare("SELECT * FROM `post` WHERE playlist_id = ?");
            $count_post->execute([$playlist_id]);
            $total_post = $count_post->rowCount();
      ?>
      <div class="box">
         <div class="flex">
            <div><i class="fas fa-circle-dot" style="<?php if($fetch_playlist['status'] == 'active'){echo 'color:limegreen'; }else{echo 'color:red';} ?>"></i><span style="<?php if($fetch_playlist['status'] == 'active'){echo 'color:limegreen'; }else{echo 'color:red';} ?>"><?= $fetch_playlist['status']; ?></span></div>
            <div><i class="fas fa-calendar"></i><span><?= $fetch_playlist['date']; ?></span></div>
         </div>
         <div class="thumb">
         <span><?= $total_videos;  ?> videos <?= $total_post;  ?> posts</span>
            <img src="uploaded_files/<?= $fetch_playlist['thumb']; ?>" alt="">
         </div>
         <h3 class="title"><?= $fetch_playlist['title']; ?></h3>
         <p class="description"><?= $fetch_playlist['description']; ?></p>
         <form action="" method="post" class="flex-btn">
            <input type="hidden" name="playlist_id" value="<?= $playlist_id; ?>">
            <a href="update_playlist.php?get_id=<?= $playlist_id; ?>" class="option-btn">update</a>
            <input type="submit" value="delete" class="delete-btn" onclick="return confirm('delete this playlist?');" name="delete">
         </form>
         <a href="view_playlist.php?get_id=<?= $playlist_id; ?>" class="btn">view playlist</a>
      </div>
      <?php
         } 
      }else{
         echo '<p class="empty">no playlist added yet!</p>';
         
      }
      ?>
   </div>
         <?php
         } else {
         ?>
           <div class="box-container2">
      <div class="box2" style="text-align: center;">
         <h3 class="title2">please login</h3>
            </div>
         <?php
         }
         ?>
   </div>

</section>











<?php include 'components/footer.php'; ?>
<script src="js/admin_script.js"></script>

<script>
   document.querySelectorAll('.playlists .box-container .box .description').forEach(content => {
      if(content.innerHTML.length > 100) content.innerHTML = content.innerHTML.slice(0, 100);
   });
</script>

</body>
</html>





<style>
.box-container2 .box2 {
    border-radius: .5rem;
    background-color: var(--white);
    padding: 2rem;
}
.box-container2 .box2 .title2 {
    font-size: 2rem;
    color: var(--black);
    margin-top: .5rem;
    padding: .5rem 0;
}
</style>
