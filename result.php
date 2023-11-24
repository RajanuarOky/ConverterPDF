<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["outputFile"])) {
    $outputFile = $_GET["outputFile"];
    echo "<h1>Hasil Konversi</h1>";
    echo "<p>File hasil konversi: <a href='$outputFile' download>Download</a></p>";
} else {
    header("Location: index.html");
    exit();
}
?>
