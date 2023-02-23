<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;400;600&display=swap"
      rel="stylesheet"
    />
    <!-- css file link  -->
    <link rel="stylesheet" href="mycomment.css" />
  </head>
  <body>
    <div class="container">
      <div class="title">Comment Form</div>
      <div class="content">
        <form name="commentf" action="submit.php" onsubmit='return validateForm();'  method="post">
          <span class='details'>Add your comment here</span>
          <textarea id='comment' name='comment' placeholder="Write the comment"></textarea>
          <input type='submit' />
          <input type='reset' name='reset' />
          <?php
            $pid=$_POST['variable1'];
            echo "<input type='hidden' name='variable1' value='$pid'> ";
            echo "<a href='../Product/buypage.php?pid=".$pid ."'> Back </a>";
          ?>
        </form>
      </div>
    </div>
    <script src='comment.js'></script>
  </body>
</html>




 


