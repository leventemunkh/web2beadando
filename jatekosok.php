<?php
session_start();
$pageTitle = "Játékosok";
include 'header.php';



// Adatbázis kapcsolat
require 'db_connect.php';

// Játékosok lekérdezése
$sql = "SELECT l.utonev, l.vezeteknev, l.mezszam, k.csapatnev, p.nev AS poszt, l.ertek 
        FROM labdarugo l
        JOIN klub k ON l.klubid = k.id
        JOIN poszt p ON l.posztid = p.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle ?? 'Webalkalmazás'; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/custom-theme.css"> <!-- Custom styles if any -->
</head>
<body>

<div class="container">
    <h2>Játékosok listája</h2>
    <table>
        <thead>
            <tr>
                <th>Név</th>
                <th>Mezszám</th>
                <th>Klub</th>
                <th>Pozíció</th>
                <th>Érték (millió)</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['utonev'] . ' ' . $row['vezeteknev']); ?></td>
                    <td><?php echo htmlspecialchars($row['mezszam']); ?></td>
                    <td><?php echo htmlspecialchars($row['csapatnev']); ?></td>
                    <td><?php echo htmlspecialchars($row['poszt']); ?></td>
                    <td><?php echo htmlspecialchars($row['ertek']); ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>
