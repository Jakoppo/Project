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

<?php
session_start();

if(isset($_POST['username'])) {
    $_SESSION['username'] = $_POST['username'];

}
if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
} else {
    header("location:http://localhost/project/log.php");
}
?>
