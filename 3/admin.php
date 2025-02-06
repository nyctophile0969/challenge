<?php 
session_start();

if($_SESSION['role'] != "admin"){
    header( "Location: /index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
</head>
<body>
    <p>AVC{5aac9e73-42dc-45f2-9c0e-a0dccd518198}</p>
</body>
</html>