<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputFile = $_FILES["pdfFile"]["tmp_name"];
    $outputFormat = "pdf";

    $outputFile = pathinfo($_FILES['pdfFile']['name'], PATHINFO_FILENAME) . '_repair.' . $outputFormat;

    $targetDir = "./";
    $targetFile = $targetDir . basename($_FILES["pdfFile"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    if ($fileType != "pdf") {
        echo "Hanya file PDF yang diizinkan.";
        $uploadOk = 0;
    }

    // Periksa jika $uploadOk diatur ke 0 karena kesalahan
    if ($uploadOk == 0) {
        echo "Maaf, file Anda tidak diunggah.";
    } else {
        if (move_uploaded_file($_FILES["pdfFile"]["tmp_name"], $targetFile)) {
            $command = "pdftk $targetFile output $outputFile";
            exec($command);

            // Set header untuk auto unduh
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="' . $outputFile . '"');
            header('Cache-Control: no-cache, no-store, must-revalidate');
            header('Pragma: no-cache');
            header('Expires: 0');

            // Output file ke browser
            readfile($outputFile);

            // Hapus file setelah di-unduh
            unlink($targetFile);
            unlink($outputFile);

            exit();
    } else {
        die('Failed to process PDF file.');
    }
}
}
?>
