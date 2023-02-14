<!DOCTYPE html>
<html lang="en">
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
    <link rel="stylesheet" href="product.css" />
    <title>AppX</title>
  </head>
  <body>
    <header>
      <nav>
        <div class="navlogo">
          <h3>AppX</h3>
        </div>
        <div class="navlinks">
          <ul>
            <li><a href="../Main/index.php">Home</a></li>
            <li><a href="">Contact</a></li>
            <li><a href="">Services</a></li>
            <li><a href="">Help</a></li>
          </ul>
        </div>
      </nav>
    </header>
    <section class="container">
      <section class='pshow'>
        <?php
          include("../Main/db.php");
          $pid = $_GET['pid'];
        
          $SQL = "SELECT pId, pName, pPrice, pImg, pDiscription FROM product WHERE pId=". $pid;
          $exeSQL=mysqli_query($conn, $SQL);
          while($arrayp=mysqli_fetch_array($exeSQL))
          {
              echo "<section class='pimg'>";
              echo "<img src='../Main/img/". $arrayp['pImg'] . "' alt='phone' width='300' />";
              echo "</section>";
              echo "<section class='pdetails'>";
              echo "<h3>". $arrayp['pName']."</h3>";
              echo "<h4>PRODUCT DISCRIPTION</h4>";
              echo "<p>". $arrayp['pDiscription'] ."</p>";
              echo "</section>";
              echo "</section>";
          }
          echo "<section class='comments'>";
          echo "<section class='btn'>";
          echo "<form name='commentf' action='../Comment/comment.php' method='post'>";
          //echo "<textarea id='comment' name='comment' id='comment'> </textarea>";
          echo "<input type='hidden' name='variable1' value='$pid'> ";
          echo "<input type='submit' value='Write Comment'/>";
          echo "</form>";
          echo "</section>";
          echo "<h4>COMMENTS :</h4>";
          $show="SELECT comm FROM comment WHERE pId=". $pid;
          $result=mysqli_query($conn, $show);
          while($arrayp=mysqli_fetch_array($result))
          {
            echo "<section class='comment'>";
            echo "<p>" . $arrayp['comm'] . "</p>";
            echo "</section>";
          };
          echo "</section>";

        ?>
      </section>
    </section>
    <script src="product.js"></script>
  </body>
</html>
