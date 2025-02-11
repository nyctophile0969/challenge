<?php
session_start();
$database = new SQLite3('/database/notes.db');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    // Cek apakah username sudah ada
    $checkQuery = $database->prepare("SELECT COUNT(*) as count FROM users WHERE username = :username");
    $checkQuery->bindValue(':username', $username, SQLITE3_TEXT);
    $result = $checkQuery->execute()->fetchArray(SQLITE3_ASSOC);

    if ($result['count'] > 0) {
        echo "<p style='color: red;'>Username sudah digunakan. Silakan pilih username lain.</p>";
    } else {
        // Simpan user baru ke database
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $query = $database->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        $query->bindValue(':username', $username, SQLITE3_TEXT);
        $query->bindValue(':password', $hashedPassword, SQLITE3_TEXT);
        $query->execute();

        echo "Registrasi berhasil! Silakan <a href='login.php'>login</a>.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
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
            margin-bottom: 20px;
        }

        form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            width: 300px;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
        }

        input {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        button {
            background-color: #28a745;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s ease;
        }

        button:hover {
            background-color: #218838;
        }

        p {
            margin-top: 15px;
            font-size: 14px;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>
    <h1>Register</h1>
    <form method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">Register</button>
    </form>
    <p>Sudah punya akun? <a href="login.php">Login di sini</a>.</p>
</body>
</html>
