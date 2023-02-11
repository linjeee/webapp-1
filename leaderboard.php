<?php

include 'components/connect.php';

if (isset($_COOKIE['user_id'])) {
  $user_id = $_COOKIE['user_id'];
} else {
  $user_id = '';
  // header('location:home.php');
}

?>

<?php include 'logic/login_with_gmail.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Students</title>

  <!-- font awesome cdn link  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

  <!-- custom css file link  -->
  <link rel="stylesheet" href="css/style.css">

</head>

<body>

  <?php include 'components/user_header.php'; ?>
  <section class="card">
    <div class="content">
      <h1 class="header">Ranking Post Like</h1>
      <div class="header-content">
        <p>Post</p>
        <p>Like Total</p>
      </div>
      <?php
      $sql_query = "SELECT likes.post_id,post.title, Count(post_id) FROM likes LEFT JOIN post ON likes.post_id = post.id WHERE post_id != 0 GROUP BY post_id ORDER BY Count(post_id) desc limit 10";

      if ($result_post_like = $conn->query($sql_query)) {

        if ($result_post_like->fetchColumn() > 0) {
          foreach ($conn->query($sql_query) as $row) {

      ?>
            <div class="item">
              <p>
                <?php
                print $row['title'];
                ?>
              </p>
              <p>
                <?= $row['Count(post_id)']; ?>
              </p>
            </div>
      <?php
          }
        } else {
          echo '<p class="empty">Nothing Ranking Post Like!</p>';
        }
      }
      ?>
    </div>
    <div class="content">
      <h1 class="header">Ranking Video Like</h1>
      <div class="header-content">
        <p>Video</p>
        <p>Like Total</p>
      </div>
      <?php
      $sql_query = "SELECT likes.content_id,content.title, Count(content_id) FROM likes LEFT JOIN content ON likes.content_id = content.id WHERE content_id != 0 GROUP BY content_id ORDER BY Count(content_id) desc limit 10";
      $result_video_like = $conn->query($sql_query);

      if ($result_video_like = $conn->query($sql_query)) {

        if ($result_video_like->fetchColumn() > 0) {
          foreach ($conn->query($sql_query) as $row) {

      ?>
            <div class="item">
              <p>
                <?php

                print $row['title'];

                ?>
              </p>
              <p>
                <?= $row['Count(content_id)']; ?>
              </p>
            </div>
      <?php
          }
        } else {
          echo '<p class="empty">Nothing Ranking Video Like!</p>';
        }
      }
      ?>
    </div>
  </section>

  <section class="card">
    <div class="content">
      <h1 class="header">Ranking Comment Post</h1>
      <div class="header-content">
        <p>Name</p>
        <p>Comment Total </p>
      </div>
      <?php
      $sql_query = "SELECT commentss.user_id,users.name, Count(user_id) FROM commentss LEFT JOIN users ON commentss.user_id = users.id GROUP BY user_id ORDER BY Count(user_id) desc limit 10";
      $result_comment_post = $conn->query($sql_query);

      if ($result_comment_post = $conn->query($sql_query)) {

        if ($result_comment_post->rowCount() > 0) {
          foreach ($conn->query($sql_query) as $row) {

      ?>
            <div class="item">
              <p>
                <?= $row['name']; ?>
              </p>
              <p>
                <?= $row['Count(user_id)']; ?>
              </p>
            </div>
      <?php
          }
        } else {
          echo '<p class="empty">Nothing Ranking Comment Post!</p>';
        }
      }
      ?>
    </div>
    <div class="content">
      <h1 class="header">Ranking Comment Video</h1>
      <div class="header-content">
        <p>Name</p>
        <p>Comment Total </p>
      </div>
      <?php
      $sql_query = "SELECT comments.user_id,users.name, Count(user_id) FROM comments LEFT JOIN users ON comments.user_id = users.id GROUP BY user_id ORDER BY Count(user_id) desc limit 10";
      $result_comment_video = $conn->query($sql_query);

      if ($result_comment_video = $conn->query($sql_query)) {

        if ($result_comment_video->rowCount() > 0) {
          foreach ($conn->query($sql_query) as $row) {
      ?>
            <div class="item">
              <p>
                <?= $row['name']; ?>
              </p>
              <p>
                <?= $row['Count(user_id)']; ?>
              </p>
            </div>
      <?php
          }
        } else {
          echo '<p class="empty">Nothing Ranking Comment Video!</p>';
        }
      }
      ?>
    </div>
  </section>






























  <?php include 'components/footer.php'; ?>

  <!-- custom js file link  -->
  <script src="js/script.js"></script>

</body>

</html>