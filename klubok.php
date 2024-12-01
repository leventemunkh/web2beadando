<?php
session_start();
$pageTitle = "Klubok";
include 'header.php';

// Adatbázis kapcsolat
require 'db_connect.php';

// Klubok lekérdezése
$sql = "SELECT id, csapatnev FROM klub";
$result = $conn->query($sql);
?>

<div class="container">
    <h2>Klubok listája</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Azonosító</th>
                <th>Klub neve</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['csapatnev']); ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>
