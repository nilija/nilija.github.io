<?php
/**
 * Created by PhpStorm.
 * User: x
 * Date: 7.12.24.
 * Time: 08.43
 */

/*$output = shell_exec('ls -la');
echo "<pre>$output</pre>";

$output = proc_open('ls -la');
echo "<pre>$output</pre>";

$output = system('ls -la');
echo "<pre>$output</pre>";*/
$e_mail = $_SESSION["e_mail"];

$folderName = __DIR__ . '/work/' . $e_mail; // Folder koji želite proslediti
$workDir = __DIR__;
// Komanda za generisanje (prilagodite putanju do `mtemplateCopy`)

$scriptPath = "$workDir/./mtemplateCopy_"; // Zameni sa stvarnom putanjom skripte

// Komanda koja se izvršava
$command = "$scriptPath '$folderName'";
//echo $command;
//die;
// Opcije za ulaz, izlaz i greške
$descriptorspec = [
    0 => ["pipe", "r"],  // Standardni ulaz (read)
    1 => ["pipe", "w"],  // Standardni izlaz (write)
    2 => ["pipe", "w"]   // Standardne greške (write)
];

// Pokretanje procesa
$process = proc_open($command, $descriptorspec, $pipes);

if (is_resource($process)) {
    $output = stream_get_contents($pipes[1]); // Čitanje izlaza
    fclose($pipes[1]);

    $errors = stream_get_contents($pipes[2]); // Čitanje grešaka
    fclose($pipes[2]);

    $return_value = proc_close($process);

    echo json_encode([
        'success' => $return_value === 0,
        'output' => $output,
        'errors' => $errors,
    ]);
} else {
    echo json_encode(['success' => false, 'error' => 'Neuspešno pokretanje procesa.']);
}
?>

