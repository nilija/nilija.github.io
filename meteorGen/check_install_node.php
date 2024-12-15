<?php
/**
 * Created by PhpStorm.
 * User: x
 * Date: 1.12.24.
 * Time: 13.12
 */

/**
 * Proverava i instalira Node.js globalno, osiguravajući dostupnost za korisnika `www-data`.
 */

// Funkcija za izvršavanje komandi i hvatanje izlaza
function execCommand($command) {
    $output = [];
    $returnVar = 0;
    exec($command, $output, $returnVar);
    return ['output' => $output, 'returnVar' => $returnVar];
}

// Provera trenutne instalacije Node.js
echo "Proveravam trenutnu instalaciju Node.js...\n";
$result = execCommand('which node');

if ($result['returnVar'] === 0) {
    $nodePath = $result['output'][0];
    echo "Node.js je već instaliran na: $nodePath\n";
    echo "Verzija:\n";
    print_r(execCommand('node -v')['output']);
} else {
    echo "Node.js nije pronađen. Instaliram globalno...\n";

    // Dodavanje Node.js repozitorijuma i instalacija putem NodeSource
    execCommand('curl -fsSL https://deb.nodesource.com/setup_18.x | sudo -E bash -');
    $installResult = execCommand('sudo apt install -y nodejs');

    if ($installResult['returnVar'] === 0) {
        echo "Node.js je uspešno instaliran.\n";
        print_r(execCommand('node -v')['output']);
    } else {
        echo "Greška prilikom instalacije Node.js.\n";
        exit(1);
    }
}

// Osiguravanje dostupnosti za korisnika `www-data`
echo "Proveravam dostupnost za korisnika `www-data`...\n";
$result = execCommand('sudo -u www-data which node');

if ($result['returnVar'] === 0) {
    echo "Node.js je dostupan za `www-data` na: " . $result['output'][0] . "\n";
} else {
    echo "Node.js nije dostupan za `www-data`. Dodajem u \$PATH...\n";

    // Dodavanje Node.js putanje u `.bashrc` za korisnika `www-data`
    $bashrcPath = '/var/www/.bashrc';
    $nodePath = execCommand('which node')['output'][0];
    $nodeExport = "export PATH=\$PATH:" . dirname($nodePath);

    if (file_exists($bashrcPath)) {
        file_put_contents($bashrcPath, $nodeExport . PHP_EOL, FILE_APPEND);
    } else {
        file_put_contents($bashrcPath, $nodeExport . PHP_EOL);
    }

    // Učitavanje `.bashrc` za `www-data`
    execCommand("sudo -u www-data source $bashrcPath");

    // Provera ponovo
    $result = execCommand('sudo -u www-data which node');
    if ($result['returnVar'] === 0) {
        echo "Node.js je sada dostupan za `www-data` na: " . $result['output'][0] . "\n";
    } else {
        echo "Node.js i dalje nije dostupan za `www-data`. Proverite ručno.\n";
        exit(1);
    }
}

// Finalna provera verzije Node.js za `www-data`
echo "Provera verzije Node.js za `www-data`:\n";
print_r(execCommand('sudo -u www-data node -v')['output']);
?>
