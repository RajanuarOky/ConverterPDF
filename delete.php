<?php
if (isset($_POST['submit'])) {
    $uploadsDirectory = './';
    $pdfFile = $_FILES['pdfFile']['tmp_name'];
    $pagesToKeep = $_POST['pagesToKeep'];

    // Validasi input file
    if (!file_exists($pdfFile) || !is_uploaded_file($pdfFile)) {
        die('Invalid PDF file.');
    }

    // Validasi input halaman
    if (empty($pagesToKeep)) {
        die('Please enter pages to keep.');
    }

    // Command pdftk
    $outputFile = $uploadsDirectory . pathinfo($_FILES['pdfFile']['name'], PATHINFO_FILENAME) . '_delete.pdf';
    $command = "pdftk \"$pdfFile\" cat $pagesToKeep output \"$outputFile\"";
    exec($command, $output, $status);

    // Cek keberhasilan eksekusi
    if ($status === 0 && file_exists($outputFile)) {
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
    } else {
        die('Failed to process PDF file.');
    }
}
?>
