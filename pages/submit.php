<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test3";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Połączenie nieudane: " . $conn->connect_error);
}


$nazwa = $_POST['nazwa'];
$cena = $_POST['cena'];
$ilosc = $_POST['ilosc'];
$user_id = $_POST['user_id'];

$sql = "INSERT INTO cart (name, price, quantity, user_id) VALUES ('$nazwa', '$cena', '$ilosc', '$user_id')";

if ($conn->query($sql) === TRUE) {
    header("location:http://localhost/Project/pages/user_panel.php");
} else {
    echo "Błąd: " . $sql . "<br>" . $conn->error;
}


$conn->close();
?>
