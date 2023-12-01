<?php

if (isset($_POST['submit'])) {
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

    // Eksekusi pdftk command
    $outputFile = 'output.pdf';
    $command = "pdftk $pdfFile cat $pagesToKeep output $outputFile";
    exec($command, $output, $status);

    // Cek keberhasilan eksekusi
    if ($status === 0 && file_exists($outputFile)) {
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . basename($outputFile) . '"');
        readfile($outputFile);

        // Hapus file output setelah diunduh
        unlink($outputFile);
        exit();
    } else {
        die('Failed to process PDF file.');
    }
}

?>
