<?php
/**
 * Created by PhpStorm.
 * User: x
 * Date: 23.11.24.
 * Time: 12.12
 */

// Putanja do direktorijuma gde će biti sačuvani podaci
$workDir = __DIR__ . '/work';
// Provera i kreiranje direktorijuma ako ne postoji
if (!file_exists($workDir)) {
    if (!mkdir($workDir, 0777, true)) {
        echo "Greška: Nije moguće kreirati direktorijum.";
        exit;
    }
}

// Prikupljanje podataka sa forme
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Preuzimanje vrednosti iz forme
    $keys = ['collection', 'title', 'modalTitleAdd', 'modalTitleView', 'modalTitleEdit', 'modalTitleDelete', 'growlSuccessAdd', 'growlSuccessEdit', 'growlSuccessDelete'];
    $fields = ['fieldName1', 'fieldName2', 'fieldName3'];

    $values = $_POST['values'];
    $fieldTypes = $_POST['fieldType'];

    // Kreiranje sadržaja za .txt fajl
    $content = '';
    for ($i = 0; $i < count($keys); $i++) {
        $content .= $keys[$i] . '=' . (!empty($values[$i]) ? $values[$i] : $keys[$i]) . "\n";
    }
    $content .= "---\n";

    // Dodavanje polja i tipova polja
    for ($i = 0; $i < count($fields); $i++) {
        $content .= $fields[$i] . ',' . $fieldTypes[$i] . "\n";
    }
echo $content;
    // Upisivanje u fajl
    $filePath = $workDir . '/' . $values[0] . '.txt';
    $writeSuccess = file_put_contents($filePath, $content);

    if ($writeSuccess === false) {
        echo "Greška prilikom upisa u fajl.". $filePath;
    } else {
        echo "Podaci su uspešno sačuvani u: " . $filePath;
    }

    if ($writeSuccess === false) {
        echo "Greška pri upisu u fajl." . $filePath;
    } else {
        // Preusmeravanje nazad na formu za unos nove kolekcije
        header("Location: /docroot/meteorGen/x.php");
        exit;
    }
}
?>

