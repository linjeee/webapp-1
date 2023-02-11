<?php

include '../components/connect.php';


if(isset($_COOKIE['admin_id'])){
   $tutor_id = $_COOKIE['admin_id'];
}else{
   $tutor_id = '';
   header('location:login.php');
}
if(isset($_POST['delete'])){

    $delete_id = $_POST['contact_id'];
    $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);
 
    $verify_delete = $conn->prepare("SELECT * FROM `contact` WHERE name = ?");
    $verify_delete->execute([$delete_id]);
 
    if($verify_delete->rowCount() > 0){
       $delete_admin = $conn->prepare("DELETE FROM `contact` WHERE name = ?");
       $delete_admin->execute([$delete_id]);
       $success_msg[] = 'Contact deleted!';
    }else{
       $warning_msg[] = 'Contact deleted already!';
    }
 
 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Veiw Message</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="../css/style.css">

</head>
<body>

<?php include '../components/admin_header.php'; ?>

<!-- teachers section starts  -->

<section class="teachers">

   <h1 class="heading">Message</h1>

   <form action="search_message.php" method="post" class="search-tutor">
      <input type="text" name="search_tutor" maxlength="100" placeholder="search message..." required>
      <button type="submit" name="search_tutor_btn" class="fas fa-search"></button>
   </form>

   <div class="box-container">

      <?php
         $select_tutors = $conn->prepare("SELECT * FROM `contact`");
         $select_tutors->execute();
         if($select_tutors->rowCount() > 0){
            while($fetch_tutor = $select_tutors->fetch(PDO::FETCH_ASSOC)){

      ?>
      <div class="box">
         <div class="tutor">
            <div>
                <span><i class="fa-solid fa-message"></i> Message</span>
               <p>Name : <?= $fetch_tutor['name']; ?></p>
               <p>Email : <?= $fetch_tutor['email']; ?></p>
               <p>Tel : <?= $fetch_tutor['number']; ?></p>
               <p>Message : <?= $fetch_tutor['message']; ?></p>
               
            </div>
         </div>
         <form action="" method="post" class="flex-btn">
         <input type="hidden" name="contact_id" value="<?= $fetch_tutor['name']; ?>">
            <button type="submit" name="delete" class="inline-delete-btn" onclick="return confirm('delete this user?');">delete </button>
            
         </form>
      </div>
      <?php
            }
         }else{
            echo '<p class="empty">no message found!</p>';
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