<?php
session_start();
$pageTitle = "Menu";
include 'header.php';
?>
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