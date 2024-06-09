<?php
include "includes/connection.php";
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>HEY, this is a dashboard</h1>
</body>
</html>