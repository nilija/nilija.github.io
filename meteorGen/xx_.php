<?php
/**
 * Created by PhpStorm.
 * User: x
 * Date: 26.11.24.
 * Time: 12.44
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Fajlova</title>
    <style>
table {
    width: 100%;
    border-collapse: collapse;
        margin-bottom: 20px;
        }
        th, td {
    border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
    background-color: #f4f4f4;
        }
        button {
    padding: 8px 15px;
            color: white;
            border: none;
            cursor: pointer;
        }
        .edit-btn {
    background-color: #007BFF;
        }
        .delete-btn {
    background-color: #DC3545;
        }
        .generate-btn {
    background-color: #28A745;
            margin-top: 20px;
            display: block;
            width: 150px;
        }
        button:hover {
    opacity: 0.9;
}
    </style>
</head>
<body>
    <h1>Lista Fajlova</h1>
    <table id="file-grid">
        <thead>
            <tr>
                <th>Naziv Fajla</th>
                <th>Akcije</th>
            </tr>
        </thead>
        <tbody>
            <!-- Dinamički redovi će biti dodati ovde putem PHP-a -->
            <?php
            $e_mail = 'n_ilija@yahoo.com';
            $workDir = __DIR__ . '/work/' . $e_mail;

            if (file_exists($workDir)) {
                $files = array_values(array_filter(scandir($workDir), function ($file) use ($workDir) {
                    return is_file($workDir . '/' . $file) && pathinfo($file, PATHINFO_EXTENSION) === 'txt';
                }));

                foreach ($files as $file) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($file) . '</td>';
                    echo '<td>';
                    echo '<button class="edit-btn" onclick="loadFile(\'' . $file . '\')">Edit</button> ';
                    echo '<button class="delete-btn" onclick="deleteFile(\'' . $file . '\')">Delete</button>';
                    echo '</td>';
                    echo '</tr>';
                }
            }
            ?>
</tbody>
</table>
<button class="generate-btn" onclick="generateFiles()">Generiši</button>

<script>
    // Funkcija za učitavanje fajla (Edit)
    function loadFile(fileName) {
        alert(`Učitavanje fajla: ${fileName}`);
        // Dodajte logiku za učitavanje i popunjavanje podataka
        fetch(`load_file.php?file=${fileName}`)
            .then(response => response.json())
    .then(data => {
            console.log(data); // Dodajte logiku za prikaz podataka u formi
    })
    .catch(error => console.error('Greška prilikom učitavanja fajla:', error));
    }

    // Funkcija za brisanje fajla (Delete)
    function deleteFile(fileName) {
        if (confirm(`Da li ste sigurni da želite da obrišete fajl: ${fileName}?`)) {
            fetch(`delete_file.php?file=${fileName}`, { method: 'GET' }) // PHP 7.4 ne podržava DELETE metodu uvek lako
                .then(response => response.json())
        .then(result => {
                if (result.success) {
                alert(`Fajl "${fileName}" je uspešno obrisan.`);
                location.reload(); // Osvežavanje stranice
            } else {
                alert(`Greška: ${result.error}`);
            }
        })
        .catch(error => console.error('Greška prilikom brisanja fajla:', error));
        }
    }

    // Funkcija za generisanje fajlova (Generate)
    function generateFiles() {
        fetch('generate_files.php', { method: 'GET' }) // Koristimo GET zbog PHP 7.4 kompatibilnosti
            .then(response => response.json())
    .then(result => {
            if (result.success) {
            alert('Generisanje fajlova je uspešno završeno.');
        } else {
            alert(`Greška: ${result.error}`);
        }
    })
    .catch(error => console.error('Greška prilikom generisanja fajlova:', error));
    }
</script>
</body>
</html>
