<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">

   <section class="flex">

      <a href="home.php" class="logo"> Knowledge Sharing Website</a>

      <form action="search_course.php" method="post" class="search-form">
         <input type="text" name="search_course" placeholder="Search Content..." required maxlength="100">
         <button type="submit" class="fas fa-search" name="search_course_btn"></button>
      </form>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="search-btn" class="fas fa-search"></div>
         <div id="user-btn" class="fas fa-user"></div>
         <div id="toggle-btn" class="fas fa-sun"></div>
         
      </div>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <img src="<?= $fetch_profile['image']; ?>" alt="">
         <h3><?= $fetch_profile['name']; ?></h3>
         <span>Student</span>
         <a href="profile.php" class="btn">Profile</a>
         <!-- <div class="flex-btn">
            <a href="selectuser.php" class="option-btn">Login</a>
            <a href="selectregister.php" class="option-btn">Register</a>
         </div> -->
         <a href="components/user_logout.php" onclick="return confirm('logout from this website?');" class="delete-btn">logout</a>
         <?php
            }else{
         ?>
         <h3>Please Login </h3>
          <div class="flex-btn">
            <a href="login2.php" class="option-btn">Login</a>
            <!-- <a href="register.php" class="option-btn">Register</a> -->
         </div>
         <?php
            }
         ?>
      </div>

   </section>

</header>

<!-- header section ends -->

<!-- side bar section starts  -->

<div class="side-bar">

   <div class="close-side-bar">
      <i class="fas fa-times"></i>
   </div>

   <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_profile->execute([$user_id]);
            if($select_profile->rowCount() > 0){
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <img src="<?= $fetch_profile['image']; ?>" alt="">
         <h3><?= $fetch_profile['name']; ?></h3>
         <span>Student</span>
         <a href="profile.php" class="btn">Profile</a>
         <?php
            }else{
         ?>
         <h3>Please Login</h3>
          <div class="flex-btn" style="padding-top: .5rem;">
            <a href="login2.php" class="option-btn">Login</a>
            <!-- <a href="register.php" class="option-btn">Register</a> -->
         </div>
         <?php
            }
         ?>
      </div>

   <nav class="navbar">
      <a href="home.php"><i class="fas fa-home"></i><span>Home</span></a>
      <!-- <a href="about.php"><i class="fas fa-question"></i><span>about us</span></a> -->
      <a href="playlist.php"><i class="fas fa-bookmark"></i></i><span>Playlist</span></a>
      <a href="contents.php"><i class="fas fa-video"></i></i><span>Content</span></a>
      <a href="post.php"><i class="fas fa-pen"></i><span>Post</span></a>
      <a href="student.php"><i class="fas fa-chalkboard-user"></i><span>Student</span></a>
      <a href="comment.php"><i class="fas fa-comment"></i><span>View Comment</span></a>
      <a href="leaderboard.php"><i class="fa-sharp fa-solid fa-ranking-star"></i><span>View Ranking</span></a>
      <a href="contact.php"><i class="fas fa-headset"></i><span>Contact</span></a>
   </nav>

</div>

<!-- side bar section ends -->