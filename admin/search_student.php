<?php


include '../components/connect.php';

if(isset($_COOKIE['admin_id'])){
    $tutor_id= $_COOKIE['admin_id'];
}else{
    $tutor_id = ''; 
}
if(isset($_POST['delete'])){

    $delete_id = $_POST['user_id'];
    $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);
 
    $verify_delete = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
    $verify_delete->execute([$delete_id]);
 
    if($verify_delete->rowCount() > 0){
       $delete_admin = $conn->prepare("DELETE FROM `users` WHERE id = ?");
       $delete_admin->execute([$delete_id]);
       $delete_admin = $conn->prepare("DELETE FROM `post` WHERE user_id = ?");
       $delete_admin->execute([$delete_id]);
       $delete_admin = $conn->prepare("DELETE FROM `playlist` WHERE user_id = ?");
       $delete_admin->execute([$delete_id]);
       $delete_admin = $conn->prepare("DELETE FROM `likes` WHERE user_id = ?");
       $delete_admin->execute([$delete_id]);
       $delete_admin = $conn->prepare("DELETE FROM `content` WHERE user_id = ?");
       $delete_admin->execute([$delete_id]);
       $delete_admin = $conn->prepare("DELETE FROM `comments` WHERE user_id = ?");
       $delete_admin->execute([$delete_id]);
       $delete_admin = $conn->prepare("DELETE FROM `commentss` WHERE user_id = ?");
       $delete_admin->execute([$delete_id]);
       $delete_admin = $conn->prepare("DELETE FROM `bookmark` WHERE user_id = ?");
       $delete_admin->execute([$delete_id]);
       $success_msg[] = 'User deleted!';
    }else{
       $warning_msg[] = 'User deleted already!';
    }
 
 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>student</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/style.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<section class="teachers">

   <h1 class="heading">student</h1>

   <form action="" method="post" class="search-tutor">
      <input type="text" name="search_tutor" maxlength="100" placeholder="search student..." required>
      <button type="submit" name="search_tutor_btn" class="fas fa-search"></button>
   </form>

   <div class="box-container">

      <?php
         if(isset($_POST['search_tutor']) or isset($_POST['search_tutor_btn'])){
            $search_tutor = $_POST['search_tutor'];
            $select_tutors = $conn->prepare("SELECT * FROM `users` WHERE name LIKE '%{$search_tutor}%'");
            $select_tutors->execute();
            if($select_tutors->rowCount() > 0){
               while($fetch_tutor = $select_tutors->fetch(PDO::FETCH_ASSOC)){

                  $tutor_id = $fetch_tutor['id'];

                  $count_playlists = $conn->prepare("SELECT * FROM `playlist` WHERE user_id = ?");
                  $count_playlists->execute([$tutor_id]);
                  $total_playlists = $count_playlists->rowCount();

                  $count_contents = $conn->prepare("SELECT * FROM `content` WHERE user_id = ?");
                  $count_contents->execute([$tutor_id]);
                  $total_contents = $count_contents->rowCount();

                  $count_likes = $conn->prepare("SELECT * FROM `likes` WHERE user_id = ?");
                  $count_likes->execute([$tutor_id]);
                  $total_likes = $count_likes->rowCount();

                  $count_comments = $conn->prepare("SELECT * FROM `comments` WHERE user_id = ?");
                  $count_comments->execute([$tutor_id]);
                  $total_comments = $count_comments->rowCount();
      ?>
      <div class="box">
         <div class="tutor">
            <img src="../uploaded_files/<?= $fetch_tutor['image']; ?>" alt="">
            <div>
               <h3><?= $fetch_tutor['name']; ?></h3>
               <span>Student</span>
            </div>
         </div>
         <p>playlists : <span><?= $total_playlists; ?></span></p>
         <p>total videos : <span><?= $total_contents ?></span></p>
         <p>total likes : <span><?= $total_likes ?></span></p>
         <p>total comments : <span><?= $total_comments ?></span></p>
         <form action="" method="post" class="flex-btn">
            <input type="hidden" name="user_id" value="<?= $fetch_tutor['id']; ?>">
            <button type="submit" name="delete" class="inline-delete-btn" onclick="return confirm('delete this user?');">delete </button>
         </form>
      </div>
      <?php
               }
            }else{
               echo '<p class="empty">no results found!</p>';
            }
         }else{
            echo '<p class="empty">please search something!</p>';
         }
      ?>

   </div>

</section>

<!-- teachers section ends -->











<?php include '../components/footer.php'; ?>

<!-- custom js file link  -->
<script src="../js/script.js"></script>
   
</body>
</html>