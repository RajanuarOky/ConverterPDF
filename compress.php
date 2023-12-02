<?php
if (isset($_POST['compressPDF'])) {
    $uploadsDirectory = './';

    $pdfFile = $_FILES['pdfFile']['tmp_name'];

    // Output file dengan "_compressed" suffix
    $outputFile = $uploadsDirectory . pathinfo($_FILES['pdfFile']['name'], PATHINFO_FILENAME) . '_compressed.pdf';

    // Code pdftk untuk mengompresi PDF
    $cmd = "pdftk \"$pdfFile\" output \"$outputFile\" compress";
    exec($cmd);

    // Tampilkan pesan sukses dan tautan download
    echo "<h2>PDF Successfully Compressed</h2>";
    echo "<p>Download your compressed PDF: <a href='$outputFile' download>Download PDF</a></p>";
}
?>
