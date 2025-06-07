<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "espace_ensi";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
  die("Échec de connexion : " . $conn->connect_error);
}
?>
