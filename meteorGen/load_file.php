<?php
/**
 * Created by PhpStorm.
 * User: x
 * Date: 24.11.24.
 * Time: 14.20
 */

// Definišemo radni direktorijum za čuvanje fajlova
$e_mail = 'n_ilija@yahoo.com';
$workDir = __DIR__ . '/work/' . $e_mail;

// Preuzimanje imena fajla iz GET zahteva
$fileName = $_GET['file'] ?? 'collection.txt';
$filePath = $workDir . '/' . $fileName;

// Provera da li fajl postoji
if (file_exists($filePath)) {
    // Učitavanje sadržaja fajla
    $content = file($filePath, FILE_IGNORE_NEW_LINES);
    $result = [
        'header' => [],  // Zaglavlje fajla (kljuc=vrednost)
        'fields' => []   // Polja (ime, tip)
    ];

    $isFieldSection = false; // Prati prelazak na sekciju polja

    foreach ($content as $line) {
        // Preskočite prazne linije
        if (trim($line) === '') {
            continue;
        }

        // Proverite separator (---) za prelazak na sekciju polja
        if (trim($line) === '---') {
            $isFieldSection = true;
            continue;
        }

        if (!$isFieldSection) {
            // Parsiranje linija zaglavlja (kljuc=vrednost)
            if (strpos($line, '=') !== false) {
                [$key, $value] = explode('=', $line, 2);
                $result['header'][trim($key)] = trim($value);
            }
        } else {
            // Parsiranje linija polja (ime,tip)
            if (strpos($line, ',') !== false) {
                [$key, $type] = explode(',', $line, 2);
                $result['fields'][] = [
                    'key' => trim($key),
                    'type' => trim($type)
                ];
            }
        }
    }

    // Vraćanje JSON odgovora
    echo json_encode($result, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    die;
} else {
    // Vraćanje greške ako fajl ne postoji
    echo json_encode(['error' => 'Fajl ne postoji']);
    die;
}
?>

