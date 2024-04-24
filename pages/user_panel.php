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

if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $user_id = $_SESSION['user_id'];
    $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE username='$username' AND user_id='$user_id'") or die('query failed');
    if(mysqli_num_rows($select_users) > 0){
        $fetch_users = mysqli_fetch_assoc($select_users);
    } else {
        header("location: http://localhost/project/log.php");
        exit();
    }
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
            <section >
            <form action="submit.php"  method="post">
            <div class="products">
            <label for="product_name">Name: Vicodin</label><br>
        <input type="hidden"  name="nazwa" value="Vicodin"><br>
        <img src="/project/img/vicodin.jpg" alt="">
        <br>
        <label for="price">Cena: 40$</label><br>
        <input type="hidden"  name="cena" value="40$"><br>
        <label for="quantity">Ilość:</label><br>
        <input type="number" name="ilosc" min="1"><br>
        <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
        <input type="submit" value="Dodaj do koszyka">
        </div>
        </form>

        <form action="submit.php"  method="post">
       <div class="products">
        <label for="product_name">Name: Epinefrin</label><br>
        <input type="hidden"  name="nazwa" value="Epinefrin"><br>
        <br>
        <img src="/project/img/epinefrin.jpg" alt="">
        <br>
        <label for="price">Cena: 25$</label><br>
        <input type="hidden"  name="cena" value="25$"><br>
        <label for="quantity">Ilość:</label><br>
        <input type="number" name="ilosc" min="1"><br>
        <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
        <input type="submit" value="Dodaj do koszyka">
        </div>
        </form>

        <form action="submit.php"  method="post">
        <div class="products">
            <label for="product_name">Name: Morfin</label><br>
        <input type="hidden"  name="nazwa" value="Morfin"><br>
        <br>
        <img src="/project/img/morfin.jpg" alt="">
        <br>
        <label for="price">Cena: 50$</label><br>
        <input type="hidden"  name="cena" value="50$"><br>
        <label for="quantity">Ilość:</label><br>
        <input type="number" name="ilosc" min="1"><br>
        <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
        <input type="submit" value="Dodaj do koszyka">
        </div>
        </form>
        
        <form action="submit.php"  method="post">
        <div class="products">
        <label for="product_name">Name: Aspirin</label><br>
        <input type="hidden"  name="nazwa" value="Aspirin"><br>
        <br>
        <img src="/project/img/aspirin.jpg" alt="">
        <br>
        <label for="price">Cena: 15$</label><br>
        <input type="hidden"  name="cena" value="15$"><br>
        <label for="quantity">Ilość:</label><br>
        <input type="number" name="ilosc" min="1"><br>
        <input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>">
        <input type="submit" value="Dodaj do koszyka">
        </div>
</form>
        </section>
        </div>
    
</main>
<br>
<br>
<br>
<footer>@</footer>
</body>
</html>
