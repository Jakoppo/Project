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
   <?php

// Połączenie z bazą danych - załóżmy, że mamy już połączenie
$conn = new mysqli("localhost", "root", "", "test3");

// Sprawdzenie połączenia
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Funkcja usuwania produktu z koszyka
function deleteProduct($conn, $productId) {
    $sql = "DELETE FROM cart WHERE id = $productId";
    if ($conn->query($sql) === TRUE) {
        echo "Produkt został usunięty z koszyka.";
    } else {
        echo "Błąd podczas usuwania produktu: " . $conn->error;
    }
}

// Sortowanie - można zaimplementować sortowanie według różnych kolumn
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'id'; // Domyślne sortowanie według ID

// Sprawdzenie, czy użytkownik jest zalogowany
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    
    // Zapytanie SQL, aby wyświetlić tylko produkty użytkownika zalogowanego
    $sql = "SELECT * FROM cart WHERE user_id = $userId ORDER BY $sort";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th><a href='?sort=id'>ID</a></th>
                    <th><a href='?sort=name'>Nazwa Produktu</a></th>
                    <th><a href='?sort=price'>Cena</a></th>
                    <th><a href='?sort=quantity'>Ilość</a></th>
                    <th><a href='?sort=user_id'>ID Użytkownika</a></th>
                    <th>Akcja</th>
                </tr>";
        // Wyświetlanie danych
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>".$row["id"]."</td>
                    <td>".$row["name"]."</td>
                    <td>".$row["price"]."</td>
                    <td>".$row["quantity"]."</td>
                    <td>".$row["user_id"]."</td>
                    <td><a href='?delete=".$row["id"]."'>Usuń</a></td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "Brak produktów w koszyku.";
    }

    // Obsługa usuwania produktu
    if(isset($_GET['delete'])) {
        $productId = $_GET['delete'];
        deleteProduct($conn, $productId);
    }
} else {
    echo "Prosimy zalogować się, aby zobaczyć swoje produkty.";
}

$conn->close();
?>

    
   
   
   
</tbody>
</table>
</section>
        

        




</main> 
    </body>
 


    <footer>@</footer>
</html>

