<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="../css/stylelog.css">
</head>
<body>
  <div class="container">
  <form class="register-form" action="rejestr.php" method="post">
  <h2>Rejestracja</h2>
  <input type="text" name="username" placeholder="Nazwa" required>
  <input type="password" name="password" placeholder="Hasło" required>
  <input type="password" name="confirm_password" placeholder="Potwierdz hasło" required>
  <button type="submit">Rejestruj</button>
  <p>Masz już konto? <a href="../log.php">Logowanie</a></p>
</form>
  </div>
</body>
</html>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test3";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form data is set
if(isset($_POST['username'], $_POST['password'], $_POST['confirm_password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        die("Passwords do not match");
    }
    // Dodanie kolumny `usertype` i przypisanie wartości `user`
    $sql = "INSERT INTO users (username, password, usertype) 
            VALUES (?, ?, 'user')";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        echo "<h2>Registration successful</h2>";
        header("location:rejestr.php");
    } 
    else {
        echo "Error during registration: " . $conn->error;
    }

    $stmt->close();
} 
$conn->close();
?>



