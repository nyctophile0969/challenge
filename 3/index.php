<?php 
session_start();
try {
    $db_file = '/database/database.db';
    $database = new SQLite3($db_file);

    if (isset($_POST['username'], $_POST['password'])){
        $username = $_POST["username"];
        $password = $_POST["password"];
        $query = "SELECT username, password FROM users WHERE username = '$username' AND password = '$password'";
        $result = $database->query($query);

        if ($row = $result->fetchArray(SQLITE3_ASSOC)){
            $_SESSION["role"] = "admin";
            header("Location: /admin.php");
        }else{
            echo "Login Failed";
        }
    }
}
catch (Exception $e) {
    // Tangkap exception dan tampilkan pesan error beserta query
    echo "Error: " . $e->getMessage() . "\n";
    echo "Query: " . $query . "\n";
}
    
$database->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</head>
<body>
    <form action="" method="post">
        <label for="username">Username : </label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Password : </label>
        <input type="text" id="password" name="password" required>
        <br>
        <button type="submit">Submit</button>
    </form>
</body>
</html>