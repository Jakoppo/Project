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
    <form class="login-form">
      <h2>Login</h2>
      <input type="text" placeholder="Username" required>
      <input type="password" placeholder="Password" required>
      <button type="submit">Login</button>
      <p>Don't have an account? <a href="pages/rejestr.php">Register here</a></p>
    </form>
  </div>
</body>
</html>

<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "baza";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Sprawdź, czy formularz został przesłany
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    // Pobierz dane z formularza
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Sprawdź, czy dane są poprawne (hardcoded credentials)
    if ($username === $valid_username && $password === $valid_password) {
        // Dane są poprawne - ustaw zmienną sesji
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username;
        header("Location: index.php"); // Przekieruj do strony powitalnej
        exit;
    } else {
        // Dane są niepoprawne - wyświetl komunikat
        echo "Nieprawidłowa nazwa użytkownika lub hasło.";
    }
}
elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login_db'])) {
    // Pobierz dane z formularza
    $username = $_POST['imie'];
    $password = $_POST['haslo'];

    // Zabezpiecz dane
    $username = stripslashes($username);
    $password = stripslashes($password);
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);

    // Zapytanie do bazy danych
    $sql = "SELECT * FROM users WHERE user='$username' AND haslo='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // Użytkownik istnieje w bazie danych - zaloguj go
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username;
        header("Location: welcome.php"); // Przekieruj do strony powitalnej
        exit;
    } else {
        // Użytkownik nie istnieje lub błędne hasło - wyświetl komunikat
        echo "Nieprawidłowa nazwa użytkownika lub hasło.";
    }
}

$conn->close();
?>