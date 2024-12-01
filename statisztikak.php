<?php
session_start();
$pageTitle = "Statisztikák";
include 'header.php';

// Adatbázis kapcsolat
require 'db_connect.php';

// Klub statisztikák
$sql_klub = "SELECT k.csapatnev, COUNT(l.id) AS jatekosok_szama 
             FROM klub k
             LEFT JOIN labdarugo l ON k.id = l.klubid
             GROUP BY k.id";

// Pozíció statisztikák
$sql_pozicio = "SELECT p.nev AS poszt, COUNT(l.id) AS darab 
                FROM poszt p
                LEFT JOIN labdarugo l ON p.id = l.posztid
                GROUP BY p.id";

$result_klub = $conn->query($sql_klub);
$result_pozicio = $conn->query($sql_pozicio);
?>

<div class="container">
    <h2>Statisztikák</h2>

    <h3>Játékosok száma klubonként</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Klub</th>
                <th>Játékosok száma</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result_klub->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['csapatnev']); ?></td>
                    <td><?php echo htmlspecialchars($row['jatekosok_szama']); ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <h3>Pozíciók eloszlása</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Pozíció</th>
                <th>Darab</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result_pozicio->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['poszt']); ?></td>
                    <td><?php echo htmlspecialchars($row['darab']); ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>
