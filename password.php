<?php
if (isset($_POST['securePDF'])) {
    $uploadsDirectory = './';

    $pdfFile = isset($_FILES['pdfFile']['tmp_name']) ? $_FILES['pdfFile']['tmp_name'] : null;
    $password = $_POST['password'];

    // Validasi input file
    if (!file_exists($pdfFile) || !is_uploaded_file($pdfFile)) {
        die('Invalid PDF file.');
    }

    $outputFile = $uploadsDirectory . pathinfo($_FILES['pdfFile']['name'], PATHINFO_FILENAME) . '_secured.pdf';

    // Code pdftk untuk mengamankan PDF dengan password
    $cmd = "pdftk \"$pdfFile\" output \"$outputFile\" owner_pw $password";
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
}else {
    die('Failed to process PDF file.');
}
?>
