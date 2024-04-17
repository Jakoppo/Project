<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test3";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sprawdź, czy użytkownik jest zalogowany
if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $user_id = $_SESSION['user_id'];
    // Pobierz informacje o użytkowniku z bazy danych
    $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE username='$username' AND user_id='$user_id'") or die('query failed');
    if(mysqli_num_rows($select_users) > 0){
        $fetch_users = mysqli_fetch_assoc($select_users);
    } else {
        // Jeśli nie znaleziono użytkownika, przekieruj na stronę logowania
        header("location: http://localhost/project/log.php");
        exit(); // Upewnij się, że po przekierowaniu nie ma dalszego wykonywania kodu
    }
}
if(isset($_POST['add_to_cart'])){

    $username = $_SESSION['username'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = $_POST['product_quantity'];
    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id' AND client_name='$username'") or die('query failed');
 
    if(mysqli_num_rows($select_cart) > 0){
       $message[] = 'produkt już dodany!';
    }else{
       mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, image, quantity, client_name) VALUES('$user_id', '$product_name', '$product_price', '$product_image', '$product_quantity' , '$username' )") or die('query failed');
       $message[] = 'produkt dodany!';
    }
 
 };
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
    <ul>
        <li><a href="">Leki</a></li>
        <li><a href="">Produkty Medyczne</a></li>
        <li><a href="">Ksiązki</a></li>
        <li><a href="">Kliniki które polecamy</a></li>
        <li><a href="logout.php">Wyloguj</a></li>
    </ul>
    <ul class="shopcart">
            <li><a href="shopcart.php">koszyk z zakupami</a></li>
        </ul>
    <ul class="user">
        <li><p>użytkownik: <span><?php echo $fetch_users['username']; ?></span></p></li>
    </ul>
</nav>

<main>
    <section>
        <h1>Najlepsze Produkty</h1>
    </section>
    <div class="container">
        <div class="products">
            <div class="box-container">
                <?php
                $select_product = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
                if(mysqli_num_rows($select_product) > 0){
                    while($fetch_product = mysqli_fetch_assoc($select_product)){

                        ?>
                        <form method="post" action="" class="box">
                            <img src="/project/img/<?php echo $fetch_product['image']; ?>" alt="">
                            <div class="name"><?php echo $fetch_product['name']; ?></div>
                            <div class="price"><?php echo $fetch_product['price']; ?></div>
                            <input type="number" min="1" name="product_quantity" value="1">
                            <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
                            <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
                            <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
                            <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
                            <input type="submit" value="dodaj do koszyka" name="add_to_cart" class="btn">
                        </form>
                        <?php
                    };
                };
                ?>
            </div>
        </div>
    </div>
</main>
<br>
<br>
<br>
<footer>@</footer>
</body>
</html>
