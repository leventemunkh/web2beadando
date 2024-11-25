<?php
session_start();
$pageTitle = "Menu";
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
// 1. Adatbázis kapcsolat létrehozása
$servername = "localhost";
$username = "root";
$password = "";
$database = "nb1";

// Kapcsolat létrehozása
$conn = new mysqli($servername, $username, $password, $database);

// Ellenőrizzük a kapcsolatot
if ($conn->connect_error) {
    die("Kapcsolat hiba: " . $conn->connect_error);
}

// 2. Menüpontok lekérdezése rekurzív módon
function getMenu($parent_id = NULL)
{
    global $conn;
    $sql = "SELECT * FROM menupontok WHERE parent_id " . ($parent_id === NULL ? "IS NULL" : "= $parent_id") . " ORDER BY sorrend";
    $result = $conn->query($sql);
    $menu = [];

    while ($row = $result->fetch_assoc()) {
        $row['children'] = getMenu($row['id']); // Rekurzív hívás az alá tartozó menüpontokra
        $menu[] = $row;
    }
    return $menu;
}

// 3. Menüpontok megjelenítése HTML-ben
function renderMenu($menu)
{
    echo "<ul>";
    foreach ($menu as $item) {
        echo "<li><a href='{$item['url']}'>{$item['nev']}</a>";
        if (!empty($item['children'])) {
            renderMenu($item['children']); // Rekurzív megjelenítés az alá tartozó menüpontokra
        }
        echo "</li>";
    }
    echo "</ul>";
}

// 4. Menü lekérése és megjelenítése
$menu = getMenu();
renderMenu($menu);

// Kapcsolat bezárása
$conn->close();

<?php include 'footer.php'; ?>