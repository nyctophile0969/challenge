<?php
session_start();

$curl = curl_init();
// Jika pengguna sudah login, arahkan ke halaman notes
if (isset($_SESSION['user_id'])) {
    header('Location: admin.php');
    exit;
}

// Kirim laporan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $database = new SQLite3('/database/reports.db');

    $name = $_POST['username'];
    $content = $_POST['content'];

    $query = $database->prepare("INSERT INTO reports (name, content) VALUES (:name, :content)");
    $query->bindValue(':name', $name, SQLITE3_TEXT);
    $query->bindValue(':content', $content, SQLITE3_TEXT);
    $query->execute();

    // Send Request To Bot
    $query = $database->prepare("SELECT id FROM reports WHERE name=:name");
    $query->bindValue(':name', $name, SQLITE3_TEXT);
    $result = $query->execute();
    
    $id =  $result->fetchArray(SQLITE3_ASSOC)['id'];

    curl_setopt($curl, CURLOPT_URL, "http://bot:3000");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, "url=http://proxy/view_report.php?id=".$id);
    curl_exec($curl);
    curl_close($curl);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lapormin!</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }
        h1 {
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
            resize: none;
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
        .links {
            margin-top: 20px;
        }
        .links a {
            text-decoration: none;
            color: #fff;
            background-color: #007bff;
            padding: 10px 20px;
            border-radius: 5px;
            margin: 0 10px;
        }
        .links a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <header class="links">
        <a href="login.php">Login Admin</a>
    </header>
    <h1>Lapor Admin</h1>
    <p>Laporin keluhanmu dan akan langsung dibaca dengan mimin.</p>

    <form method="POST">
        <label for="username">Nama:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="content">Isi Laporan:</label>
        <textarea id="content" name="content" required></textarea>
        <br>
        <button type="submit">Kirim Laporan</button>
    </form>
</body>
</html>