<?php
if (isset($_POST['merge'])) {
    $uploadsDirectory = './';

    $file1 = $_FILES['file1']['tmp_name'];
    $file2 = $_FILES['file2']['tmp_name'];

    // Validasi input file
    if (!file_exists($file1) || !is_uploaded_file($file1) || !file_exists($file2) || !is_uploaded_file($file2)) {
        die('Invalid PDF files.');
    }

    $outputFile = $uploadsDirectory . pathinfo($_FILES['file1']['name'], PATHINFO_FILENAME) . '_'. pathinfo($_FILES['file2']['name'], PATHINFO_FILENAME) .'_merge.pdf';

    // Code Merge pdftknya
    $cmd = "pdftk \"$file1\" \"$file2\" cat output \"$outputFile\"";
    exec($cmd);

    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="' . basename($outputFile) . '"');
    header('Cache-Control: no-cache, no-store, must-revalidate');
    header('Pragma: no-cache');
    header('Expires: 0');

    readfile($outputFile);

    // Hapus file setelah diunduh
    unlink($file1);
    unlink($file2);
    unlink($outputFile);

    exit();
}else {
        die('Failed to process PDF file.');
    }
?>
