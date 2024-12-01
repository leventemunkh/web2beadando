<?php
session_start();
$pageTitle = "Statisztikák";
include 'header.php';

// Adatbázis kapcsolat
require 'db_connect.php';

// Statisztikák lekérdezése
$sql_klub = "SELECT k.nev AS klub_nev, COUNT(j.id) AS jatekosok_szama 
             FROM klubok k
             LEFT JOIN jatekosok j ON k.id = j.klub_id
             GROUP BY k.id";
$sql_pozicio = "SELECT pozicio, COUNT(*) AS darab FROM jatekosok GROUP BY pozicio";

$result_klub = $conn->query($sql_klub);
$result_pozicio = $conn->query($sql_pozicio);
?>

<h2>Statisztikák</h2>

<h3>Játékosok száma klubonként</h3>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Klub</th>
            <th>Játékosok száma</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result_klub->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['klub_nev']); ?></td>
                <td><?php echo htmlspecialchars($row['jatekosok_szama']); ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<h3>Pozíciók eloszlása</h3>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Pozíció</th>
            <th>Darab</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result_pozicio->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['pozicio']); ?></td>
                <td><?php echo htmlspecialchars($row['darab']); ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php include 'footer.php'; ?>
