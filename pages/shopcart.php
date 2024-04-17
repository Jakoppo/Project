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
    if(isset($_POST['update_cart'])){
        $update_quantity = $_POST['cart_quantity'];
        $update_id = $_POST['cart_id'];
        mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_quantity' WHERE id_product = '$update_id'") or die('query failed');
        $message[] = 'cart quantity updated successfully!';
     }
}
if(isset($_GET['remove'])){
    $remove_id = $_GET['remove'];
    mysqli_query($conn, "DELETE FROM `cart` WHERE id_product = '$remove_id'") or die('query failed');
    header('location:shopcart.php');
 }
   
 if(isset($_GET['delete_all'])){
    mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
    header('location:shopcart.php');
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
      $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id='$user_id'") or die('query failed');
      $grand_total = 0;
      if(mysqli_num_rows($cart_query) > 0){
         while($fetch_cart = mysqli_fetch_assoc($cart_query)){
   ?>
      <tr>
        <td><?php echo $fetch_cart['status']; ?></td>
         <td><img src="/project/img/<?php echo $fetch_cart['image']; ?>" height="100" alt=""></td>
         <td><?php echo $fetch_cart['name']; ?></td>
         <td>$<?php echo $fetch_cart['price']; ?>/-</td>
         <td>
            <form action="" method="post">
               <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id_product']; ?>">
               <input type="number" min="1" name="cart_quantity" value="<?php echo $fetch_cart['quantity']; ?>">
               <input type="submit" name="update_cart" value="aktualizuj" class="option-btn">
            </form>
         </td>
         <td>$<?php echo $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?>/-</td>
         <td><a href="shopcart.php?remove=<?php echo $fetch_cart['id_product']; ?>" class="delete-btn" onclick="return confirm('czy napewno?');">usuń</a></td>
      </tr>
   <?php
      $grand_total += $sub_total;
         }
      }else{
         echo '<tr><td style="padding:20px; text-transform:capitalize;" colspan="6">brak produktów</td></tr>';
      }
   ?>
   <tr class="table-bottom">
      <td colspan="4">pełna cena :</td>
      <td>$<?php echo $grand_total; ?>/-</td>
      <td><a href="shopcart.php?delete_all" onclick="return confirm('delete all from cart?');" class="delete-btn <?php echo ($grand_total > 1)?'':'disabled'; ?>">usuń wszystko</a></td>
   </tr>
</tbody>
</table>

<div class="cart-btn">  
   <a href="#" class="btn <?php echo ($grand_total > 1)?'':'disabled'; ?>">przejdz do płatności</a>
</div>
            </section>
        

        




</main> 
    </body>
 


    <footer>@</footer>
</html>

