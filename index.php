<?php
session_start();
?>

<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kezdőoldal</title>
</head>

<body>
    <h2>Kezdőoldal</h2>

    <?php
    if (isset($_SESSION['felhasznalonev'])) {
        echo "<p>Üdvözlünk, " . $_SESSION['felhasznalonev'] . "!</p>";
        echo "<p>Szerepköröd: " . $_SESSION['szerepkor'] . "</p>";
        echo "<a href='logout.php'>Kijelentkezés</a>";
    } else {
        echo "<p>Üdvözöljük a weboldalon! Kérjük, <a href='login.php'>jelentkezz be</a> a folytatáshoz.</p>";
    }
    ?>
</body>

</html>