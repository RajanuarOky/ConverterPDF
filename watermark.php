<?php
if (isset($_POST['addWatermark'])) {
    $uploadsDirectory = './';

    $pdfFile = $_FILES['pdfFile']['tmp_name'];
    $watermarkFile = $_FILES['watermarkFile']['tmp_name'];

    // Validasi input file
    if (!file_exists($pdfFile) || !is_uploaded_file($pdfFile) || !file_exists($watermarkFile) || !is_uploaded_file($watermarkFile)) {
        die('Invalid PDF or watermark file.');
    }

    $outputFile = $uploadsDirectory . pathinfo($_FILES['pdfFile']['name'], PATHINFO_FILENAME) . '_watermark.pdf';

    // Code pdftk untuk menambahkan watermark
    $cmd = "pdftk \"$pdfFile\" background \"$watermarkFile\" output \"$outputFile\"";
    exec($cmd);

    // Set header untuk auto download
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="' . basename($outputFile) . '"');
    header('Cache-Control: no-cache, no-store, must-revalidate');
    header('Pragma: no-cache');
    header('Expires: 0');

    readfile($outputFile);

    // Hapus file setelah di-download
    unlink($pdfFile);
    unlink($watermarkFile);
    unlink($outputFile);

    exit();
} else {
    die('Failed to process PDF file.');
}
?>
