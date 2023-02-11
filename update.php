<?php

include 'components/connect.php';

if (isset($_COOKIE['user_id'])) {
   $user_id = $_COOKIE['user_id'];
} else {
   $user_id = '';
   // header('location:login2.php');
}

if (isset($_POST['submit'])) {

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE id = ? LIMIT 1");
   $select_user->execute([$user_id]);
   $fetch_user = $select_user->fetch(PDO::FETCH_ASSOC);

   $prev_pass = $fetch_user['password'];
   $prev_image = $fetch_user['image'];

   $name = $_POST['name'];
   $name = filter_var($name);

   if (!empty($name)) {
      $update_name = $conn->prepare("UPDATE `users` SET name = ? WHERE id = id");
      $update_name->execute([$name]);
      $message[] = 'username updated successfully!';
   }

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);

   if (!empty($email)) {
      $select_email = $conn->prepare("SELECT email FROM `users` WHERE email = ?");
      $select_email->execute([$email]);
      if ($select_email->rowCount() > 0) {
         $message[] = 'email already taken!';
      } else {
         $update_email = $conn->prepare("UPDATE `users` SET email = ? WHERE id = ?");
         $update_email->execute([$email, $user_id]);
         $message[] = 'email updated successfully!';
      }
   }



}

?>

<?php include 'logic/login_with_gmail.php';?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update profile</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>

<body>

   <?php include 'components/user_header.php'; ?>

   <section class="form-container" style="min-height: calc(100vh - 19rem);">

      <form action="" method="post" enctype="multipart/form-data">
         <h3>update profile</h3>
         <div class="flex">
            <div class="col">
               <p>your name</p>
               <input type="text" name="name" placeholder="<?= $fetch_profile['name']; ?>" maxlength="100" class="box">
               <p>your email</p>
               <?php if (!isset($userinfo['token'])) : ?>
                  <input type="email" name="email" placeholder="<?= $fetch_profile['email']; ?>" maxlength="100" class="box">
               <?php else : ?>
                  <input type="email" name="email" placeholder="<?= $fetch_profile['email']; ?>" maxlength="100" class="box" disabled>
               <?php endif; ?>
               <p>update pic</p>
               <input type="file" name="image" accept="image/*" class="box" disabled>
            </div>
            <!-- <div class="col">
               <p>old password</p>
               <input type="password" name="old_pass" placeholder="enter your old password" maxlength="50" class="box" disabled>
               <p>new password</p>
               <input type="password" name="new_pass" placeholder="enter your new password" maxlength="50" class="box">
               <p>confirm password</p>
               <input type="password" name="cpass" placeholder="confirm your new password" maxlength="50" class="box">
            </div> -->
         </div>
         <input type="submit" name="submit" value="update profile" class="btn">
      </form>

   </section>

   <!-- update profile section ends -->













   <?php include 'components/footer.php'; ?>

   <!-- custom js file link  -->
   <script src="js/script.js"></script>

</body>

</html>