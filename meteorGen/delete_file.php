<?php
/**
 * Created by PhpStorm.
 * User: x
 * Date: 26.11.24.
 * Time: 12.21
 */

$e_mail = 'n_ilija@yahoo.com';
$workDir = __DIR__ . '/work/' . $e_mail;
$fileName = $_GET['file'] ?? '';
$filePath = $workDir . '/' . $fileName;

if (file_exists($filePath)) {
    if (unlink($filePath)) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Neuspešno brisanje fajla.']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Fajl ne postoji.']);
}
?>
