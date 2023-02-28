<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce Website - shoping cart</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;400;600&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href=" style.css">
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
                <!--<li><a href="">About Us</a></li>-->
            </ul>
            </div>
        </nav>
    </header>
    <section class="container">
        <div class="shop-content">
            <div class="product-box">
                <?php
                    include("../Main/db.php");
                    $pid = $_GET['pid'];

                    $SQL="SELECT pId, pName, pPrice, pImg, pDescript FROM product WHERE pId=". $pid;
                    $exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error($conn));

                    while($arrayp=mysqli_fetch_array($exeSQL)){
                        echo "<section class='img'>";
                        echo "<img src='../Main/img/" . $arrayp['pImg'] . "' alt='' class='product-img'>";
                        echo "</section>";
                        echo "<section class='details'>";
                        echo "<h2 class='product-title'>" . $arrayp['pName'] . "</h2>";
                        echo "<span class='price'>RS." . $arrayp['pPrice']. "</span>";
                        echo "<p class='descript'>" . $arrayp['pDescript'] . "</p>";
                        echo "</section>";
                    }
                ?>
            </div>
            <?php
            echo "<section class='comments'>";
            echo "<section class='btn'>";
            echo "<form name='commentf' action='../Comment/comment.php' method='post'>";
            //echo "<textarea id='comment' name='comment' id='comment'> </textarea>";
            echo "<input type='hidden' name='variable1' value='$pid'> ";
            echo "<input type='submit' value='Write Comment'/>";
            echo "</form>";
            echo "</section>";
            echo "<h4>COMMENTS </h4>";
            $show="SELECT comm, csRate FROM comment WHERE pId=". $pid;
            $result=mysqli_query($conn, $show);
            while($arrayp=mysqli_fetch_array($result))
            {
              echo "<section class='comment'>";
              echo "<section class='rating'>";
              echo "<div class='stars'>";
              echo "<span class='fa fa-star checked'></span>";
              echo "<span class='fa fa-star '></span>";
              echo "<span class='fa fa-star '></span>";
              echo "<span class='fa fa-star '></span>";
              echo "<span class='fa fa-star '></span>";
              echo "</div>";
              if($arrayp['csRate']==NULL){
                echo "<p>NULL</p>";
              }else{
                echo "<p id='rate'>". $arrayp['csRate'] . "</p>";
              };
              echo "</section>";
              echo "<p class='comm'>" . $arrayp['comm'] . "</p>";
              echo "</section>";
            };
            echo "</section>";
            ?>
        </div>           
    </section>
    <script src="index.js"></script>
</body>
</html>