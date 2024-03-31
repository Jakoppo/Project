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
          <a href="admin_panel.php">Dr.Hous CoffeeShop</a>
        </div>
        </div>
        </header>
    <nav>
        <ul >
            <li><a href="logout.php">Logout</a></li>
        </ul>
        <ul class="user">
        <li><p>username: <span><?php echo $fetch_users['username'];?></span></p></li>
        </ul>
    </nav>

    <main>
    <section>
    <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test3";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sprawdzenie, czy formularz został wysłany
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sprawdzenie, czy zostało wybrane zamówienie
    if(isset($_POST['order_id'])) {
        // Pobranie danych z formularza
        $order_id = $_POST['order_id'];
        $status = $_POST['status'];

        // Aktualizacja statusu zamówienia w bazie danych
        $update_query = "UPDATE orders SET status='$status' WHERE id=$order_id";
        if ($conn->query($update_query) === TRUE) {
            echo "Status zamówienia został zaktualizowany pomyślnie.";
        } else {
            echo "Błąd podczas aktualizacji statusu zamówienia: " . $conn->error;
        }
    }
}
?>
    <table border="1">
        <tr>
            <th>Numer zamówienia</th>
            <th>Produkt</th>
            <th>Status</th>
            <th>Akcja</th>
        </tr>
        <?php
        // Pobranie zamówień z bazy danych
        $orders_query = "SELECT * FROM orders";
        $result = $conn->query($orders_query);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["product_name"] . "</td>";
                echo "<td>" . $row["status"] . "</td>";
                echo "<td>";
                echo "<form method='post' action=''>";
                echo "<input type='hidden' name='order_id' value='" . $row["id"] . "'>";
                echo "<select name='status'>";
                echo "<option value='Przyjęte'>Przyjęte</option>";
                echo "<option value='Oczekujące'>Oczekujące</option>";
                echo "<option value='Odrzucone'>Odrzucone</option>";
                echo "</select>";
                echo "<input type='submit' value='Zaktualizuj'>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Brak dostępnych zamówień.</td></tr>";
        }
        ?>
    </table>
</body>
</html>
    














            </section>
</main> 
    </body>
 

    <br>
    <br>
    <br>
    <footer>@</footer>
</html>
