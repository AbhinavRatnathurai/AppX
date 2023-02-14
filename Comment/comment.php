<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- css file link  -->
    <link rel="stylesheet" href="mycomment.css" />
  </head>
  <body>
    <div class="container">
      <div class="title">Comment Form</div>
      <div class="content">
        <form name="commentf" action="submit.php" method="post">
          <?php
            $pid=$_POST['variable1'];
            echo "<input type='hidden' name='variable1' value='$pid'> ";
          ?>
          <span class="details">Add your comment hear</span>
          <textarea id="comment" name="comment" id="comment" required> </textarea>
          <input type="submit" />
          <input type="reset" name="reset" />
        </form>
      </div>
    </div>
  </body>
</html>




 


