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
          <a href="user_panel.php">Dr.Hous CoffeeShop</a>
        </div>
        </div>
        </header>
    <nav>
        <ul >
            <li><a href="">Drugs</a></li>
            <li><a href="">Supplies</a></li>
            <li><a href="">Books</a></li>
            <li><a href="">Medical Clinics we advise</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
        <ul class="user">
        <li><p>username: <span><?php echo $fetch_users['username'];?></span></p></li>
        </ul>
    </nav>

    <main>
        <div class="container">   
            <section>
                <h1>Tabel</h1>
            </section>
        

        




</main> 
    </body>
 


    <footer>@</footer>
</html>

