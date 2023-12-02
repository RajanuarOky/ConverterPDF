<?php
if (isset($_POST['securePDF'])) {
    $uploadsDirectory = './';

    $pdfFile = isset($_FILES['pdfFile']['tmp_name']) ? $_FILES['pdfFile']['tmp_name'] : null;
    $password = $_POST['password'];

    $outputFile = $uploadsDirectory . 'secured_pdf.pdf';

    // Code pdftk untuk mengamankan PDF dengan password
    $cmd = "pdftk \"$pdfFile\" output \"$outputFile\" owner_pw $password";
    exec($cmd);

    // Tampilkan pesan sukses dan tautan download
    echo "<h2>PDF Successfully Secured with Password</h2>";
    echo "<p>Download your secured PDF: <a href='$outputFile' download>Download PDF</a></p>";
}
?>
