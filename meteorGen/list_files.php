<?php
/**
 * Created by PhpStorm.
 * User: x
 * Date: 24.11.24.
 * Time: 14.18
 */
// Definišemo radni direktorijum za čuvanje fajlova

$e_mail = 'n_ilija@yahoo.com';
$workDir = __DIR__ . '/work/' . $e_mail;
//$workDir = '/var/www/delovizatraktore_rs/docroot/meteorGen/work';
if (file_exists($workDir)) {
    $files = array_values(array_filter(scandir($workDir), function($file) use ($workDir) {
        return is_file($workDir . '/' . $file) && pathinfo($file, PATHINFO_EXTENSION) === 'txt';
    }));
    echo json_encode($files);
} else {
    echo json_encode([]);
}
?>
