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

    $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE username='$username'")
    or die('query failed');

    if(mysqli_num_rows($select_users) > 0){
        $fetch_users = mysqli_fetch_assoc($select_users);
    }
} else {
    header("location:http://localhost/project/log.php");
    exit(); // Dodajemy exit(), aby zapobiec dalszemu wykonywaniu kodu
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
    <ul>
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

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if(isset($_POST['id_product'])) {
                $id_product = $_POST['id_product'];
                $status = $_POST['status'];

                // Aktualizacja statusu zamówienia w bazie danych
                $update_query = "UPDATE `cart` SET status='$status' WHERE id_product=$id_product";
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
                <th>id_user</th>
                <th>Number of order</th>
                <th>Produkt</th>
                <th>quantity</th>
                <th>Status</th>
                <th>Akcja</th>
            </tr>
            <?php
            $orders_query = "SELECT * FROM cart";
            $result = $conn->query($orders_query);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["user_id"] . "</td>";
                    echo "<td>" . $row["id_product"] . "</td>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["quantity"] . "</td>";
                    echo "<td>" . $row["status"] . "</td>";
                    echo "<td>";
                    echo "<form method='post' action=''>";
                    echo "<input type='hidden' name='id_product' value='" . $row["id_product"] . "'>";
                    echo "<select name='status'>";
                    echo "<option value='accepted'>accepted</option>";
                    echo "<option value='I need a fee'>I need a fee</option>";
                    echo "<option value='rejected'>rejected</option>";
                    echo "</select>";
                    echo "<input type='submit' value='Zaktualizuj'>";
                    echo "</form>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No orders yet.</td></tr>";
            }
            ?>
        </table>
    </section>
</main>
<br>
<br>
<br>
<footer>@</footer>
</body>
</html>
