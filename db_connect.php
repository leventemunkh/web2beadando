<?php
$servername = "localhost";
$username = "root"; // vagy a beállított felhasználónév
$password = ""; // vagy a beállított jelszó
$dbname = "nb1"; // helyettesítsd az adatbázis nevével

// Kapcsolódás létrehozása
$conn = new mysqli($servername, $username, $password, $dbname);

// Kapcsolódási hiba ellenőrzése
if ($conn->connect_error) {
    die("Kapcsolódási hiba: " . $conn->connect_error);
}
?>
