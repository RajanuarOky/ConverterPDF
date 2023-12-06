<?php
if (isset($_POST['compressPDF'])) {
    $uploadsDirectory = './';
    $pdfFile = $_FILES['pdfFile']['tmp_name'];

    $outputFile = $uploadsDirectory . pathinfo($_FILES['pdfFile']['name'], PATHINFO_FILENAME) . '_compressed.pdf';

    // Code pdftk untuk mengompresi PDF
    $cmd = "pdftk \"$pdfFile\" output \"$outputFile\" compress";
    exec($cmd);

    // Set header untuk auto download
    header('Content-Type: application/pdf');
    header('Content-Disposition: attachment; filename="' . basename($outputFile) . '"');
    header('Cache-Control: no-cache, no-store, must-revalidate');
    header('Pragma: no-cache');
    header('Expires: 0');
    
    // Output file ke browser
    readfile($outputFile);
    
    // Hapus file setelah di-download
    unlink($pdfFile);
    unlink($outputFile);

    exit();
    }else {
        die('Failed to process PDF file.');
    }
?>
