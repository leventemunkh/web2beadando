<?php
session_start();
$pageTitle = "Logout";
include 'header.php';

session_unset();
session_destroy(); // Munkamenet lezárása

header("Location: index.php");
exit;
?>
<?php include 'footer.php'; ?>
