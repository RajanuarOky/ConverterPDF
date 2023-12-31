<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $inputFile = $_FILES["inputFile"]["tmp_name"];
    $outputFormat = $_POST["outputFormat"];

    $outputFile = "converter." . $outputFormat;

    // Command untuk konversi
    if ($outputFormat == "doc" || $outputFormat == "pptx" || $outputFormat == "jpg" || $outputFormat == "xlsx" || $outputFormat == "pdf") {
        system("unoconv -f $outputFormat -o $outputFile $inputFile");

        // Set header untuk auto download
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $outputFile . '"');
        header('Cache-Control: no-cache, no-store, must-revalidate');
        header('Pragma: no-cache');
        header('Expires: 0');


        readfile($outputFile);

        // Hapus file setelah di-download
        unlink($inputFile);
        unlink($outputFile);

        exit();
    }
}
?>
