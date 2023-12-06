<?php

if (isset($_POST['submit'])) {
    $pdfFile = $_FILES['pdfFile']['tmp_name'];
    $startPage = (int)$_POST['startPage'];
    $endPage = (int)$_POST['endPage'];

    // Validasi input file
    if (!file_exists($pdfFile) || !is_uploaded_file($pdfFile)) {
        die('Invalid PDF file.');
    }

    // Validasi input halaman
    if ($startPage <= 0 || $endPage <= 0 || $startPage > $endPage) {
        die('Invalid page range.');
    }

    // command pdftk
    $outputFile = 'split.pdf';
    $command = "pdftk $pdfFile cat $startPage-$endPage output $outputFile";
    exec($command, $output, $status);

    if ($status === 0 && file_exists($outputFile)) {
        // Set header untuk download
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . basename($outputFile) . '"');
        header('Cache-Control: no-cache, no-store, must-revalidate');
        header('Pragma: no-cache');
        header('Expires: 0');

        // Output file ke browser
        readfile($outputFile);

        // Hapus file setelah diunduh
        unlink($pdfFile);
        unlink($outputFile);


        exit();
    } 
} else {
    die('Failed to process PDF file.');
}

?>
