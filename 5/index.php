<?php
// Vulnerable Local File Inclusion (LFI)
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    include($page); // Rentan terhadap LFI
} else {
    echo "Silakan pilih halaman: <a href='?page=home.php'>Home</a> | <a href='?page=about.php'>About</a>";
}
?>