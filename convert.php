<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //command line untuk konversi file
    $inputFile = $_FILES["inputFile"]["tmp_name"];
    $outputFormat = $_POST["outputFormat"];
    
    //nama file output
    $outputFile = "converter." . $outputFormat;
    
    //command untuk konversi
    if ($outputFormat == "doc") {
        system("unoconv -f $outputFormat -o $outputFile $inputFile");
    } elseif ($outputFormat == "pptx") {
        system("unoconv -f $outputFormat -o $outputFile $inputFile");
    }elseif ($outputFormat == "jpg") {
        system("unoconv -f $outputFormat -o $outputFile $inputFile");
    }elseif ($outputFormat == "xlsx") {
        system("unoconv -f $outputFormat -o $outputFile $inputFile");
    }elseif ($outputFormat == "pdf") {
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
