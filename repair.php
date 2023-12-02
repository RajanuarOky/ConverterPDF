<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $targetDir = "./";
    $targetFile = $targetDir . basename($_FILES["pdfFile"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));


    if ($fileType != "pdf") {
        echo "Hanya file PDF yang diizinkan.";
        $uploadOk = 0;
    }

    if ($_FILES["pdfFile"]["size"] > 5000000) {
        echo "Maaf, file Anda terlalu besar.";
        $uploadOk = 0;
    }

    // Periksa jika $uploadOk diatur ke 0 karena kesalahan
    if ($uploadOk == 0) {
        echo "Maaf, file Anda tidak diunggah.";
    } else {
        if (move_uploaded_file($_FILES["pdfFile"]["tmp_name"], $targetFile)) {
            $outputFile = "outputrepair.pdf";
            $command = "pdftk $targetFile output $outputFile";
            exec($command);

            echo "File PDF berhasil diperbaiki. <a href='$outputFile'>Unduh file</a>";
        } else {
            echo "Kesalahan saat mengunggah file Anda.";
        }
    }
}
?>
