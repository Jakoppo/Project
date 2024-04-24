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
        <ul >
            <li><a href="">Leki</a></li>
            <li><a href="">Produkty Medyczne</a></li>
            <li><a href="">Ksiązki</a></li>
            <li><a href="">Kliniki które polecamy</a></li>
            <li><a href="logout.php">Wyloguj</a></li>
        </ul>
        <ul class="user">
        <li><p>użytkownik: <span><?php echo $fetch_users['username'];?></span></p></li>
        </ul>
    </nav>

    <main>
        <div class="container">   
            <section>
            <div class="shopping-cart">

<h1 class="heading">koszyk z zakupami</h1>

<table>
   <thead>
      <th>status</th>
      <th>Zdjecie</th>
      <th>Nazwa</th>
      <th>Cena</th>
      <th>Ilość</th>
      <th>Cena całkowita</th>
      <th>edycja</th>
   </thead>
   <tbody>
   
   </tr>
</tbody>
</table>
</section>
        

        




</main> 
    </body>
 


    <footer>@</footer>
</html>

