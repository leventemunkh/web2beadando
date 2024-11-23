<?php
// Adatbázis kapcsolat
$servername = "localhost";
$username = "root";
$password = "";
$database = "nb1";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Kapcsolat hiba: " . $conn->connect_error);
}

// Felhasználó regisztráció feldolgozása
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $felhasznalonev = $_POST['felhasznalonev'];
    $email = $_POST['email'];
    $jelszo = password_hash($_POST['jelszo'], PASSWORD_DEFAULT); // Jelszó titkosítása

    $sql = "INSERT INTO felhasznalok (felhasznalonev, email, jelszo) VALUES ('$felhasznalonev', '$email', '$jelszo')";

    if ($conn->query($sql) === TRUE) {
        echo "Sikeres regisztráció!";
    } else {
        echo "Hiba: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regisztráció</title>
</head>

<body>
    <h2>Felhasználói Regisztráció</h2>
    <form action="register.php" method="post">
        <label for="felhasznalonev">Felhasználónév:</label>
        <input type="text" name="felhasznalonev" id="felhasznalonev" required><br><br>

        <label for="email">E-mail:</label>
        <input type="email" name="email" id="email" required><br><br>

        <label for="jelszo">Jelszó:</label>
        <input type="password" name="jelszo" id="jelszo" required><br><br>

        <input type="submit" value="Regisztráció">
    </form>
</body>

</html>