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

$hiba = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $jelszo = $_POST['jelszo'];

    $sql = "SELECT * FROM felhasznalok WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Jelszó ellenőrzése
        if (password_verify($jelszo, $user['jelszo'])) {
            // Felhasználói adatok elmentése a munkamenetbe (session)
            $_SESSION['felhasznalonev'] = $user['felhasznalonev'];
            $_SESSION['szerepkor'] = $user['szerepkor'];
            $_SESSION['id'] = $user['id'];

            // Sikeres bejelentkezés után átirányítás a kezdőoldalra
            header("Location: index.php");
            exit;
        } else {
            // Hibás jelszó
            $hiba = "Hibás jelszó! Kérjük, próbáld újra.";
        }
    } else {
        // Nem létezik ilyen e-mail cím
        $hiba = "Nincs ilyen felhasználó ezzel az e-mail címmel!";
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
    <?php
    if (!empty($hiba)) {
        echo "<p style='color:red;'>$hiba</p>";
    }
    ?>
    <form action="login.php" method="post">
        <label for="email">E-mail:</label>
        <input type="email" name="email" id="email" required><br><br>

        <label for="jelszo">Jelszó:</label>
        <input type="password" name="jelszo" id="jelszo" required><br><br>

        <input type="submit" value="Bejelentkezés">
    </form>
</body>

</html>