

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce Website - shoping cart</title>
    <link rel="stylesheet" href=" style.css">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
     <header>
        <div class="nav container">
            <a href="#" class="logo"> AppX </a>

            <i class='bx bxs-shopping-bag' id="cart-icon"></i>
            <div class="cart">
                <h2 class="cart-title">Your Cart </h2>
                <div class= "cart-content">
                
                </div>   
                <div class="total">
                    <div class="total-title">Total </div>
                    <div class="total-price">$00</div>
                </div>
                <button type="button" class="btn-buy">Buy Now</button>
                <i class="bx bx-x" id="close-cart"></i>   
            </div>

        </div>
     </header>
     <section class=" shop container" height="600" width="600">
        <h2 class="section-title"> shop Products</h2>
        <div class="shop-content">
            <div class="product-box">
                <img src="img/F1.jpeg" alt="" class="product-img" height="600" width="600">
                <h2 class="product-title">F1 cap </h2>
                <span class="price">$15</span>
                <i class='bx bx-shopping-bag add-cart'></i>
            </div>
        </div>           
     </section>
     <script src="main.js"></script>
</body>
</html>