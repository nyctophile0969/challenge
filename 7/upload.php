<html>
<body>

<h3>Image File Upload Stats: </h3>

<?php
    if ($_FILES["file"]["error"]) {
        header("Location: index.html");
        die();
    } else {
        // Ambil ekstensi file asli
        $fileExtension = pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);

        // Generate nama file random menggunakan uniqid() dan tambahkan ekstensi file
        $randomFileName = uniqid() . "." . $fileExtension;

        // Tampilkan informasi file
        echo "Name: " . $_FILES["file"]["name"];
        echo "<br>Size: " . $_FILES["file"]["size"];

        // Pindahkan file ke folder uploads dengan nama file random
        move_uploaded_file($_FILES["file"]["tmp_name"], "uploads/" . $randomFileName);

        // Tampilkan link ke file yang diupload
        echo "<br>File Uploaded to <a href='uploads/" . $randomFileName . "'>Here</a>";
    }
?>

</body>
</html>