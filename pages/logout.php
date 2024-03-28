<?php
session_start();
// Zniszcz zmienną sesji
session_destroy();
// Przekieruj użytkownika do strony logowania
header("Location:http://localhost/project/log.php");
exit;
?>