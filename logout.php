<?php
session_start();
$pageTitle = "Logout";
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
session_start();
session_unset();
session_destroy(); // Munkamenet lezárása

header("Location: index.php");
exit;

