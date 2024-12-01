<?php
session_start();
$pageTitle = "Klubok";
include 'header.php';

// Adatbázis kapcsolat
require 'db_connect.php';

// Klubok lekérdezése
$sql = "SELECT nev, varos FROM klubok";
$result = $conn->query($sql);
?>

<h2>Klubok listája</h2>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Név</th>
            <th>Város</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['nev']); ?></td>
                <td><?php echo htmlspecialchars($row['varos']); ?></td>
            </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<?php include 'footer.php'; ?>
