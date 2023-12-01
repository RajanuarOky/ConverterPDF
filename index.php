<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Merge PDF</title>
</head>
<body>
    <h1>Merge PDF</h1>
    
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <label for="file1">Select PDF File 1:</label>
        <input type="file" name="file1" accept=".pdf" required><br>

        <label for="file2">Select PDF File 2:</label>
        <input type="file" name="file2" accept=".pdf" required><br>

        <button type="submit" name="merge">Merge PDF</button>
    </form>
</body>
</html>
