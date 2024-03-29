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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="index.css" />
    <title>AppX</title>
  </head>
  <body id="top">
    <header>
      <nav>
        <div class="navlogo">
          <h3>AppX</h3>
        </div>
        <div class="navlinks">
          <ul>
            <li><a href="#top">Home</a></li>
            <li><a href="#p">Products</a></li>
            <!--<li><a href="">About us</a></li>-->
          </ul>
        </div>
      </nav>
    </header>
    <section class="discription">
      <img src="img/discrip.webp" alt="" srcset="" />
      <h1>
        Help You To<br />
        Buy The Right Product
      </h1>
    </section>
    <section class="products" id="p">
        <h2>Products</h2>
        <section class="productD">
          <?php
          include("db.php");
          //echo "<p>hello</p>";
          $SQL="select pId, pName, pImg, pPrice, psRate from product";
          $exeSQL=mysqli_query($conn, $SQL) or die (mysqli_error($conn));;
          while($arrayp=mysqli_fetch_array($exeSQL))
          {
            echo "<a href='../Product/buypage.php?pid=".$arrayp['pId']."'>";
            echo "<section class='product'>";
            echo "<img src=img/".$arrayp['pImg']." height='250' width='250' >";
            echo "<h4>".$arrayp['pName']."</h4>";
            echo "<h5>RS.".$arrayp['pPrice']."</h5>";
            echo "<section class='rating'>";
            echo "<div class='stars'>";
            echo "<span class='fa fa-star '></span>";
            echo "<span class='fa fa-star '></span>";
            echo "<span class='fa fa-star '></span>";
            echo "<span class='fa fa-star '></span>";
            echo "<span class='fa fa-star '></span>";
            echo "</div>";
            if($arrayp['psRate']==NULL){
              //echo "<p class='rate'>0</p>";
              echo "<input type='hidden' name='rating' value='0'>";
            }else{
              //echo "<p class='rate'>". $arrayp['csRate'] . "</p>";
              echo "<input type='hidden' name='rating' value=".$arrayp['psRate'].">";
            };
            echo "</section>";
            echo "</section>";
            echo "</a>";
          };
          ?>
        </section>
    </section>
    <script src="index.js"></script>
  </body>
</html>
