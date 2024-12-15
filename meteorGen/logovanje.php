<?php
/**
 * Created by PhpStorm.
 * User: x
 * Date: 1.12.24.
 * Time: 13.36
 */

// Podešavanje
$logFile = __DIR__ . '/log.txt'; // Fajl za logovanje
$baseDir = __DIR__ . '/work'; // Bazni direktorijum za korisničke radne foldere

// Funkcija za logovanje
function logMessage($message) {
    global $logFile;
    file_put_contents($logFile, date('Y-m-d H:i:s') . " - $message\n", FILE_APPEND);
}

// Logovanje korisnika putem e-mail adrese
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Neispravna e-mail adresa.";
        logMessage("Neispravna e-mail adresa pokušaj logovanja: $email");
        exit;
    }

    // Kreiranje radnog direktorijuma na osnovu e-mail adrese
    $userDir = $baseDir . '/' . $email;

    if (!file_exists($userDir)) {
        mkdir($userDir, 0777, true);
        logMessage("Kreiran radni direktorijum za: $email");
    }

    // Prikaz radnog foldera
    echo "Radni folder za korisnika $email: $userDir<br>";

    // Kreiranje tar.gz arhive
    $zipFile = $userDir . '/files.tar.gz';

    // Komanda za arhiviranje
    $command = "tar -czf $zipFile -C $userDir .";

    exec($command, $output, $returnVar);
    echo $output;
    if ($returnVar !== 0) {
        echo "Greška prilikom arhiviranja.";
        logMessage("Greška prilikom arhiviranja za: $email");
        exit;
    }

    echo "Arhiva kreirana: $zipFile<br>";
    logMessage("Arhiva kreirana za: $email");

    // Slanje e-maila
    $to = $email;
    $subject = "Vaša arhiva";
    $message = "Poštovani,\n\nU prilogu se nalazi vaša arhiva.\n\nPozdrav!";
    $headers = "From: noreply@example.com";

    $fileContent = file_get_contents($zipFile);
    $boundary = md5(uniqid(time()));

    $headers .= "\nMIME-Version: 1.0\n";
    $headers .= "Content-Type: multipart/mixed; boundary=\"$boundary\"\n";

    $body = "--$boundary\n";
    $body .= "Content-Type: text/plain; charset=\"utf-8\"\n";
    $body .= "Content-Transfer-Encoding: 7bit\n\n";
    $body .= $message . "\n\n";

    $body .= "--$boundary\n";
    $body .= "Content-Type: application/gzip; name=\"" . basename($zipFile) . "\"\n";
    $body .= "Content-Transfer-Encoding: base64\n";
    $body .= "Content-Disposition: attachment; filename=\"" . basename($zipFile) . "\"\n\n";
    $body .= chunk_split(base64_encode($fileContent)) . "\n";
    $body .= "--$boundary--";

    if (mail($to, $subject, $body, $headers)) {
        echo "E-mail uspešno poslat korisniku $email<br>";
        logMessage("E-mail uspešno poslat korisniku: $email");

        // Brisanje fajlova nakon uspešnog slanja
//        array_map('unlink', glob("$userDir/*"));
        echo "Svi fajlovi su obrisani iz foldera $userDir<br>";
        logMessage("Fajlovi obrisani iz foldera: $userDir");
    } else {
        echo "Greška prilikom slanja e-maila.";
        logMessage("Greška prilikom slanja e-maila za: $email");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logovanje i Arhiviranje</title>
</head>
<body>
<h1>Logovanje sa e-mail adresom</h1>
<form method="POST">
    <label for="email">E-mail adresa:</label>
    <input type="email" id="email" name="email" required>
    <button type="submit">Loguj se</button>
</form>
</body>
</html>
