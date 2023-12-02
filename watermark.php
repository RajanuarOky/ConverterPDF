<?php
if (isset($_POST['addWatermark'])) {
    $uploadsDirectory = './';

    $pdfFile = $_FILES['pdfFile']['tmp_name'];
    $watermarkFile = $_FILES['watermarkFile']['tmp_name'];

    $outputFile = $uploadsDirectory . 'output_with_watermark.pdf';

    // Code pdftk untuk menambahkan watermark
    $cmd = "pdftk \"$pdfFile\" background \"$watermarkFile\" output \"$outputFile\"";
    exec($cmd);

    // Tampilkan pesan sukses dan tautan download
    echo "<h2>PDF Successfully Watermarked</h2>";
    echo "<p>Download your watermarked PDF: <a href='$outputFile' download>Download PDF</a></p>";
}
?>
