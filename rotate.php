<?php
if (isset($_POST['rotatePDF'])) {
    $uploadsDirectory = './';

    $pdfFile = $_FILES['pdfFile']['tmp_name'];
    $rotationAngle = $_POST['rotationAngle'];

    // Validasi file input
    if (!file_exists($pdfFile) || !is_uploaded_file($pdfFile)) {
        die('File PDF tidak valid.');
    }

    // Validasi sudut rotasi
    if (!in_array($rotationAngle, ['90', '180', '270'])) {
        die('Sudut rotasi tidak valid.');
    }

    $outputFile = $uploadsDirectory . pathinfo($_FILES['pdfFile']['name'], PATHINFO_FILENAME) . '_rotated.pdf';

    // Kode qpdf untuk merotasi PDF
    $cmd = "qpdf \"$pdfFile\" --rotate=$rotationAngle -- \"$outputFile\"";
    exec($cmd);

    // Set header untuk mengunduh secara otomatis
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="' . basename($outputFile) . '"');
    header('Cache-Control: no-cache, no-store, must-revalidate');
    header('Pragma: no-cache');
    header('Expires: 0');

    readfile($outputFile);

    // Hapus file setelah diunduh
    unlink($pdfFile);
    unlink($outputFile);

    exit();
}
?>
