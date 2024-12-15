<?php
/**
 * Created by PhpStorm.
 * User: x
 * Date: 23.11.24.
 * Time: 10.46
 */

// Podešavanje direktorijuma
$workDir = __DIR__ . '/work'; // Radni folder
$outputDir = __DIR__ . '/output'; // Folder za izlaz
$scriptPath = '/path/to/mtemplateCopy'; // Putanja do mtemplateCopy skripte
$downloadDir = __DIR__ . '/downloads'; // Folder za preuzimanje

// Provera i kreiranje radnih direktorijuma
if (!file_exists($workDir)) mkdir($workDir, 0777, true);
if (!file_exists($outputDir)) mkdir($outputDir, 0777, true);
if (!file_exists($downloadDir)) mkdir($downloadDir, 0777, true);

// Funkcija za kreiranje/uređivanje .txt fajla
function createOrEditTxt($fileName, $content) {
    global $workDir;
    $filePath = $workDir . '/' . $fileName;
    file_put_contents($filePath, $content);
}

// Funkcija za pokretanje generisanja Meteor aplikacije
function generateMeteorApp($folderName) {
    global $scriptPath, $outputDir;
    $command = "node $scriptPath $outputDir/$folderName";
    exec($command, $output, $returnVar);
    return $returnVar === 0 ? true : implode("\n", $output);
}

// Funkcija za kompresiju u tar.gz
function compressToTarGz($folderName) {
    global $outputDir, $downloadDir;
    $source = $outputDir . '/' . $folderName;
    $destination = $downloadDir . '/' . $folderName . '.tar.gz';
    $command = "tar -czf $destination -C $outputDir $folderName";
    exec($command, $output, $returnVar);
    return $returnVar === 0 ? $destination : implode("\n", $output);
}

// Funkcija za preuzimanje fajla
function downloadFile($filePath) {
    if (file_exists($filePath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
        header('Content-Length: ' . filesize($filePath));
        readfile($filePath);
        exit;
    } else {
        echo "Fajl ne postoji!";
    }
}

// Obrada unosa iz forme
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fileName = $_POST['file_name'] ?? 'default.txt';
    $content = $_POST['file_content'] ?? '';
    $folderName = $_POST['folder_name'] ?? 'MyApp';

    // Kreiranje/uređivanje .txt fajla
    createOrEditTxt($fileName, $content);

    // Generisanje Meteor aplikacije
    $generationStatus = generateMeteorApp($folderName);
    if ($generationStatus === true) {
        // Kompresija generisanih podataka
        $compressedFile = compressToTarGz($folderName);
        if (file_exists($compressedFile)) {
            downloadFile($compressedFile);
        } else {
            echo "Došlo je do greške prilikom kompresije.";
        }
    } else {
        echo "Greška prilikom generisanja aplikacije: $generationStatus";
        echo "Greška prilikom generisanja aplikacije: $folderName";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generator Meteor Aplikacije</title>
</head>
<body>
<h1>Generator Meteor Aplikacije</h1>
<form method="POST">
    <label for="file_name">Ime .txt fajla:</label><br>
    <input type="text" id="file_name" name="file_name" value="collection.txt" required><br><br>

    <label for="file_content">Sadržaj fajla:</label><br>
    <textarea id="file_content" name="file_content" rows="10" cols="50" required>Unesite podatke ovde...</textarea><br><br>

    <label for="folder_name">Ime izlaznog foldera:</label><br>
    <input type="text" id="folder_name" name="folder_name" value="MyApp" required><br><br>

    <button type="submit">Generiši Meteor Aplikaciju</button>
</form>
</body>
</html>
