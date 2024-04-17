<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="css/stylelog.css">
</head>
<body>
  <div class="container">
    <form class="login-form" action="" method="post"> 
      <h2>Logowanie</h2>
      <input type="text" name="username" placeholder="Nazwa" required> 
      <input type="password" name="password" placeholder="Hasło" required>
      <button type="submit">Zaloguj</button>
      <p>Nie masz konta? <a href="pages/rejestr.php">Rejestracja</a></p>
    </form>
  </div>
</body>
</html>
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

if(isset($_POST['username'], $_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    
    $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $row['username'];
        $_SESSION['usertype'] = $row['usertype'];
        $_SESSION['user_id'] = $row['user_id']; 

       
        if($_SESSION['usertype'] == 'admin') {
            header("Location: pages/admin_panel.php");
        } else {
            header("Location: pages/user_panel.php");
        }
        exit();
    } else {
        echo "Invalid username or password";
    }

    $stmt->close();
}
$conn->close();
?>
