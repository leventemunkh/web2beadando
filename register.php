<?php
session_start();
$pageTitle = "Register";
include 'header.php';

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
    $felhasznalonev = $_POST['felhasznalonev'];
    $email = $_POST['email'];
    $jelszo = password_hash($_POST['jelszo'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO felhasznalok (felhasznalonev, email, jelszo) VALUES ('$felhasznalonev', '$email', '$jelszo')";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['felhasznalonev'] = $felhasznalonev;
        $_SESSION['szerepkor'] = 'regisztralt';
        header("Location: index.php");
        exit;
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
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Regisztráció</h1>
    </header>
    <div class="container">
        <h2>Felhasználói Regisztráció</h2>
        <form action="register.php" method="post">
            <label for="felhasznalonev">Felhasználónév:</label>
            <input type="text" name="felhasznalonev" id="felhasznalonev" required>
            
            <label for="email">E-mail:</label>
            <input type="email" name="email" id="email" required>
            
            <label for="jelszo">Jelszó:</label>
            <input type="password" name="jelszo" id="jelszo" required>
            
            <input type="submit" value="Regisztráció">
        </form>
    </div>
</body>
</html>

<?php include 'footer.php'; ?>