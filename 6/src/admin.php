<?php
session_start();
$is_admin = isset($_COOKIE['kamu_admin']) && ($_COOKIE['kamu_admin'] === "benar");

if(!$is_admin){
    if (!isset($_SESSION['user_id'])) {
        header('Location: login.php');
        exit;
    }
}

$database = new SQLite3('/database/reports.db');

// Ambil catatan milik user
$query = $database->prepare("SELECT * FROM reports");
$result = $query->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes</title>
    <style>
        body{

            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        header{
            padding: 20px;
            align-items: end;
        }
        div {
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1, h2 {
            color: #333;
        }

        form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            width: 350px;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            margin-top: 10px;
        }

        input, textarea {
            width: calc(100% - 20px);
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        textarea {
            min-height: 100px;
        }

        button {
            background-color: #007bff;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
            transition: background 0.3s ease;
            width: 100%;
        }

        button:hover {
            background-color: #0056b3;
        }

        ul {
            list-style-type: none;
            padding: 0;
            width: 350px;
        }

        li {
            background: #fff;
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
        }

        a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
        }

        a:hover {
            text-decoration: underline;
        }

        a.logout{
            background-color: #007bff;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
            transition: background 0.3s ease;
            width: 100%;
            text-decoration: none;
        }

        a.logout:hover{
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <header>
        <a href="/logout.php" class="logout">Logout</a>
    </header>
    <div>      
        <h2>AVC{3cbf792b-0cce-4e0e-889f-7f3b7ab8da28}</h2>
        <h2>Daftar Laporan</h2>
        <ul>
            <?php while ($note = $result->fetchArray(SQLITE3_ASSOC)): ?>
                <li>
                    <p>From: <a href="view_report.php?id=<?= htmlspecialchars($note['id']) ?>"><?= htmlspecialchars($note['name']) ?></a></p>
                </li>
                <?php endwhile; ?>
            </ul>
    </div>
</body>
</html>