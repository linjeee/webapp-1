<?php

include '../components/connect.php';


if(isset($_COOKIE['admin_id'])){
   $tutor_id = $_COOKIE['admin_id'];
}else{
   $tutor_id = '';
   header('location:login.php');
}
if(isset($_POST['delete'])){

    $delete_id = $_POST['user_id'];
    $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);
 
    $verify_delete = $conn->prepare("SELECT * FROM `admin` WHERE id = ?");
    $verify_delete->execute([$delete_id]);
 
    if($verify_delete->rowCount() > 0){
       $delete_admin = $conn->prepare("DELETE FROM `admin` WHERE id = ?");
       $delete_admin->execute([$delete_id]);
       $success_msg[] = 'Admin deleted!';
    }else{
       $warning_msg[] = 'Admin deleted already!';
    }
 
 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/style.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<!-- teachers section starts  -->

<section class="teachers">

   <h1 class="heading">Admin</h1>

   <form action="search_admin.php" method="post" class="search-tutor">
      <input type="text" name="search_tutor" maxlength="100" placeholder="search admin..." required>
      <button type="submit" name="search_tutor_btn" class="fas fa-search"></button>
   </form>

   <div class="box-container">

      <div class="box offer">
         <h3>Become a Admin</h3>
         <p>If you want to join as an instructor, click on the button below.</p>
         <a href="register.php" style="background-color:#52cc00;display: display: block;
   width: 100%;border-radius: .5rem;
   padding: 1rem 3rem;
   font-size: 1.8rem;
   color: #fff;
   margin-top: 1rem;
   text-transform: capitalize;
   cursor: pointer;
   text-align: center;
 ">Get started</a>
      </div>

      <?php
         $select_tutors = $conn->prepare("SELECT * FROM `admin`");
         $select_tutors->execute();
         if($select_tutors->rowCount() > 0){
            while($fetch_tutor = $select_tutors->fetch(PDO::FETCH_ASSOC)){

      ?>
      <div class="box">
         <div class="tutor">
            <img src="../uploaded_files/<?= $fetch_tutor['image']; ?>" alt="">
            <div>
               <h3><?= $fetch_tutor['name']; ?></h3>
               <span><?= $fetch_tutor['profession']; ?></span>
                <p><?= $fetch_tutor['email']; ?></p>
            </div>
         </div>
         <form action="" method="post" class="flex-btn">
            <input type="hidden" name="user_id" value="<?= $fetch_tutor['id']; ?>">
            <button type="submit" name="delete" class="inline-delete-btn" onclick="return confirm('delete this user?');">delete </button>
            
         </form>
         
      </div>
      <?php
            }
         }else{
            echo '<p class="empty">no tutors found!</p>';
         }
      ?>

   </div>

</section>

<!-- teachers section ends -->






























<?php include '../components/footer.php'; ?>    

<!-- custom js file link  -->
<script src="../js/admin_script.js"></script>
   
</body>
</html>