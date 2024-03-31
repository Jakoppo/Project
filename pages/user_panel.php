<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test3";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE username='$username'")
or die('query failed');
if(mysqli_num_rows($select_users) > 0){
    $fetch_users = mysqli_fetch_assoc($select_users);
}


session_start();

if(isset($_POST['username'])) {
    $_SESSION['username'] = $_POST['username'];
}

if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE username='$username'")
    or die('query failed');

    if(mysqli_num_rows($select_users) > 0){
        $fetch_users = mysqli_fetch_assoc($select_users);
    }
} else {
    header("location:http://localhost/project/log.php");
}

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Medical Shop</title>
</head>
<body>
<header class="header">
      <div class="container">
        <div class="branding">
          <a href="user_panel.php">Dr.Hous CoffeeShop</a>
        </div>
        </div>
        </header>
    <nav>
        <ul >
            <li><a href="">Drugs</a></li>
            <li><a href="">Supplies</a></li>
            <li><a href="">Books</a></li>
            <li><a href="">Medical Clinics we advise</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
        <ul class="shopcart">
            <li><a href="shopcart.php">Shop cart</a></li>
        </ul>
        <ul class="user">
        <li><p>username: <span><?php echo $fetch_users['username'];?></span></p></li>
        </ul>
    </nav>

    <main>
    <section>
                <h1>Best Sellers</h1>
            </section>
        <div class="container">   
            <div class="products">
                <div class="box-container">
            <?php
                $select_produkt = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
                if(mysqli_num_rows($select_produkt) > 0){
                    while($fetch_product = mysqli_fetch_assoc($select_produkt)){

            ?>
            <form method="post"  action="" class="box"> 
            <img src="/project/img/<?php echo $fetch_product['image']; ?>" alt="">
                <div class="name"><?php echo $fetch_product['name']; ?></div>
                <div class="price"><?php echo $fetch_product['price']; ?></div>
                <input type="number" min="1" name="product_quantity" value="">
                <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
                <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
                <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
                <input type="submit" value="add to cart" name="add_to_cart" class="btn">
            </form>


             <?php
                   };
                };
             ?>           
            </div>
            </div>
            </div>





</main> 
    </body>
 

    <br>
    <br>
    <br>
    <footer>@</footer>
</html>
