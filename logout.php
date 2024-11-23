<?php
session_start();
session_unset();
session_destroy(); // Munkamenet lezárása

header("Location: index.php");
exit;
