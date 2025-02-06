<?php
session_start();
$database = new SQLite3('/database/reports.db');
$report_id = $_GET['id'];

// Ambil catatan berdasarkan ID (tanpa memeriksa kepemilikan)
$query = $database->prepare("SELECT * FROM reports WHERE id = :id");
$query->bindValue(':id', $report_id, SQLITE3_INTEGER);
$result = $query->execute();
$note = $result->fetchArray(SQLITE3_ASSOC);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 20px;
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;

    }

    div{
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        width: 350px;
        margin-bottom: 20px;
    }
    a{
        background-color: #007bff;
        color: white;
        padding: 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        margin-top: 10px;
        transition: background 0.3s ease;
        width: 50px;
        text-decoration:none;
    }
    </style>
</head>
<body>
    <div>
    <?php
        if ($note) {
            echo "<h3> From: ".$note['name']."</h3>";
            echo "<p>".htmlspecialchars($note['content'])."</p>";
        } else {
            echo "Catatan tidak ditemukan.";
        }
    ?>
    </div>
    <a href="/admin.php">Back</a>
</body>
</html>