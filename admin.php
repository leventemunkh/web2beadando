<?php
session_start();
$pageTitle = "Admin";
include 'header.php';
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

<div class="container my-4">
<?php
include 'check_role.php';

// Admin szerepkör ellenőrzése
checkRole('admin');
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Oldal</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Admin Felület</h1>
    </header>
    <div class="container">
        <h2>Üdvözöljük az Admin Oldalon!</h2>
        <p>Ez az oldal csak admin szerepkörű felhasználók számára érhető el.</p>
        
        <ul>
            <li><a href="felhasznalok_kezeles.php">Felhasználók kezelése</a></li>
            <li><a href="adatbazis_statisztikak.php">Adatbázis statisztikák megtekintése</a></li>
        </ul>

        <p><a href="logout.php">Kijelentkezés</a></p>
    </div>
</body>
</html>

<?php include 'footer.php'; ?>