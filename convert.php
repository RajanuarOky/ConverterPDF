<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Menggunakan command line untuk konversi file, pastikan tool konversi sudah terinstal di server Linux
    $inputFile = $_FILES["inputFile"]["tmp_name"];
    $outputFormat = $_POST["outputFormat"];
    
    // Tentukan nama file output sesuai kebutuhan
    $outputFile = "converter." . $outputFormat;
    
    // Contoh command untuk konversi PDF ke Word menggunakan pdftotext
    if ($outputFormat == "doc") {
        system("pdftotext $inputFile $outputFile");
    } elseif ($outputFormat == "txt") {
        // Contoh command untuk konversi Excel ke Word menggunakan tool lain (misalnya unoconv)
        system("unoconv -f $outputFormat -o $outputFile $inputFile");
    }

    // Redirect ke halaman hasil konversi
    header("Location: result.php?outputFile=$outputFile");
    exit();
}
?>

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
