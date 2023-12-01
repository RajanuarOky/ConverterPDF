<?php
if (isset($_POST['merge'])) {
    $uploadsDirectory = './';

    $file1 = $_FILES['file1']['tmp_name'];
    $file2 = $_FILES['file2']['tmp_name'];

    $outputFile = $uploadsDirectory . 'combined.pdf';

    // Use pdftk to merge PDFs
    $cmd = "pdftk \"$file1\" \"$file2\" cat output \"$outputFile\"";
    exec($cmd);

    echo "PDF files merged successfully. <a href='$outputFile' download>Download Combined PDF</a>";
}
?>
