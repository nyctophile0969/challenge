<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$database = new SQLite3('/database/notes.db');
$user_id = $_SESSION['user_id'];

// Tambahkan catatan baru
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $query = $database->prepare("INSERT INTO notes (user_id, title, content) VALUES (:user_id, :title, :content)");
    $query->bindValue(':user_id', $user_id, SQLITE3_INTEGER);
    $query->bindValue(':title', $title, SQLITE3_TEXT);
    $query->bindValue(':content', $content, SQLITE3_TEXT);
    $query->execute();
}

// Ambil catatan milik user
$query = $database->prepare("SELECT * FROM notes WHERE user_id = :user_id");
$query->bindValue(':user_id', $user_id, SQLITE3_INTEGER);
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

        <h1>Catatan Saya</h1>
        <form method="POST">
            <label for="title">Judul:</label>
            <input type="text" id="title" name="title" required>
            <br>
            <label for="content">Isi:</label>
            <textarea id="content" name="content" required></textarea>
            <br>
            <button type="submit">Tambah Catatan</button>
        </form>
        
        <h2>Daftar Catatan</h2>
        <ul>
            <?php while ($note = $result->fetchArray(SQLITE3_ASSOC)): ?>
                <li>
                    <a href="view_note.php?id=<?= htmlspecialchars($note['id']) ?>"><?= htmlspecialchars($note['title']) ?></a>
                </li>
                <?php endwhile; ?>
            </ul>
    </div>
</body>
</html>