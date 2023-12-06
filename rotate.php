<?php
if (isset($_POST['rotatePDF'])) {
    $uploadsDirectory = './';

    $pdfFile = $_FILES['pdfFile']['tmp_name'];
    $rotationAngle = $_POST['rotationAngle'];

    // Validasi input file
    if (!file_exists($pdfFile) || !is_uploaded_file($pdfFile)) {
        die('Invalid PDF file.');
    }

    // Validasi sudut rotasi
    if (!in_array($rotationAngle, ['90', '180', '270'])) {
        die('Invalid rotation angle.');
    }

    $outputFile = $uploadsDirectory . pathinfo($_FILES['pdfFile']['name'], PATHINFO_FILENAME) . '_rotated.pdf';

    // Code pdftk untuk merotasi PDF
    $cmd = "pdftk \"$pdfFile\" cat 1-end$rotationAngle output \"$outputFile\"";
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
    unlink($outputFile);

    exit();
}
?>
