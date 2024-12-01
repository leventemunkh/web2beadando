<?php
session_start();
$pageTitle = "Játékosok";
include 'header.php';

// Adatbázis kapcsolat
require 'db_connect.php';

// Játékosok lekérdezése
$sql = "SELECT j.nev AS jatekos_nev, k.nev AS klub_nev, j.pozicio 
        FROM jatekosok j
        LEFT JOIN klubok k ON j.klub_id = k.id";
$result = $conn->query($sql);
?>

<h2>Játékosok listája</h2>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Név</th>
            <th>Klub</th>
            <th>Pozíció</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['jatekos_nev']); ?></td>
                <td><?php echo htmlspecialchars($row['klub_nev']); ?></td>
                <td><?php echo htmlspecialchars($row['pozicio']); ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php include 'footer.php'; ?>
