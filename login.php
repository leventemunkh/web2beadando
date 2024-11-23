<?php
session_start();

// Adatbázis kapcsolat
$servername = "localhost";
$username = "root";
$password = "";
$database = "nb1";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Kapcsolat hiba: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $jelszo = $_POST['jelszo'];

    $sql = "SELECT * FROM felhasznalok WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        if (password_verify($jelszo, $user['jelszo'])) {
            $_SESSION['felhasznalonev'] = $user['felhasznalonev'];
            $_SESSION['szerepkor'] = $user['szerepkor'];
            echo "Sikeres bejelentkezés! Üdv, " . $_SESSION['felhasznalonev'];

            header("Location: index.php");
            exit;
        } else {
            echo "Hibás jelszó!";
        }
    } else {
        echo "Nincs ilyen felhasználó!";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bejelentkezés</title>
</head>

<body>
    <h2>Felhasználói Bejelentkezés</h2>
    <form action="login.php" method="post">
        <label for="email">E-mail:</label>
        <input type="email" name="email" id="email" required><br><br>

        <label for="jelszo">Jelszó:</label>
        <input type="password" name="jelszo" id="jelszo" required><br><br>

        <input type="submit" value="Bejelentkezés">
    </form>
</body>

</html>