<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uploadDir = "./";
    $uploadFile = $uploadDir . basename($_FILES["pdfFile"]["name"]);

    if (move_uploaded_file($_FILES["pdfFile"]["tmp_name"], $uploadFile)) {
        $rotationAngle = $_POST["rotationAngle"];
        $outputFile = $uploadDir . "rotated_" . time() . ".pdf";

        $command = "pdftk $uploadFile cat 1-end$rotationAngle output $outputFile";
        shell_exec($command);

        // Provide a link to download the rotated PDF
        echo "<h2>PDF Rotated Successfully!</h2>";
        echo "<p>Download your rotated PDF: <a href='$outputFile' download>Download</a></p>";
    } else {
        echo "<h2>Failed to upload file.</h2>";
    }
}

?>
