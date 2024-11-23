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

// Klubok száma
$klubok_szama = 0;
$sql = "SELECT COUNT(*) as count FROM klub";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $klubok_szama = $row['count'];
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kezdőoldal - NB I Labdarúgóklubok</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            color: #333;
            line-height: 1.6;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1,
        h2,
        h3 {
            color: #444;
        }

        a {
            color: #333;
            text-decoration: none;
        }

        a:hover {
            color: #007bff;
        }
    </style>
</head>

<body>
    <header>
        <h1>NB I Labdarúgóklubok Információs Portál</h1>
    </header>
    <div class="container">
        <?php
        // Ellenőrizzük, hogy a felhasználó be van-e jelentkezve
        if (!isset($_SESSION['felhasznalonev'])) {
            // Bejelentkezés és regisztrációs lehetőség megjelenítése, ha nincs bejelentkezve
            echo "<h2>Bejelentkezés vagy Regisztráció</h2>";
            echo "<p>Üdvözöljük az oldalunkon! Kérjük, <a href='login.php'>jelentkezz be</a> vagy <a href='register.php'>regisztrálj</a> a további funkciók eléréséhez.</p>";
        } else {
            // Főoldal tartalma megjelenítése, ha a felhasználó be van jelentkezve
            echo "<p>Üdvözöljük, " . $_SESSION['felhasznalonev'] . "!</p>";
            echo "<p><a href='logout.php'>Kijelentkezés</a></p>";

            echo "<h2>Bemutatkozás</h2>";
            echo "<p>Ez az oldal az NB I-es labdarúgóklubok és játékosok részletes adatbázisát tartalmazza. Itt megtekintheti a csapatokat, a játékosokat, és különböző statisztikákat is elérhet.</p>";

            echo "<h3>Mi található az oldalon?</h3>";
            echo "<ul>";
            echo "<li><strong>Klubok:</strong> Jelenleg <strong>$klubok_szama</strong> klub adatai találhatók meg az adatbázisban.</li>";
            echo "<li><strong>Játékosok:</strong> Böngésszen az NB I játékosainak részletes adatai között.</li>";
            echo "<li><strong>Statisztikák:</strong> Tekintse meg a csapatok és játékosok teljesítménystatisztikáit.</li>";
            echo "</ul>";

            echo "<h3>Funkciók</h3>";
            echo "<p>Az oldal különféle funkciókat kínál, például:</p>";
            echo "<ul>";
            echo "<li><a href='klubok.php'>Klubok listája</a> - Az NB I-es klubok listájának megtekintése.</li>";
            echo "<li><a href='jatekosok.php'>Játékosok listája</a> - Az összes játékos adatainak böngészése.</li>";
            echo "<li><a href='statisztikak.php'>Statisztikák</a> - A legfrissebb statisztikai adatok megtekintése.</li>";
            echo "</ul>";
        }
        ?>
    </div>
</body>

</html>