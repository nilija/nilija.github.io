<?php
/**
 * Created by PhpStorm.
 * User: x
 * Date: 26.11.24.
 * Time: 12.27
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
            <!-- Dinamički redovi će se dodavati ovde -->
        </tbody>
    </table>
    <button class="generate-btn" onclick="generateFiles()">Generiši</button>

    <script>
// Funkcija za učitavanje liste fajlova
window.onload = function () {
    fetch('list_files.php') // Pretpostavlja se da ova PHP skripta vraća JSON sa listom fajlova
    .then(response => response.json())
                .then(files => {
        const fileGrid = document.querySelector('#file-grid tbody');
        fileGrid.innerHTML = ''; // Čisti tabelu pre dodavanja novih redova

        files.forEach(file => {
            const row = fileGrid.insertRow(-1); // Dodavanje reda na kraj tabele
            const fileNameCell = row.insertCell(0);
            const actionsCell = row.insertCell(1);

            // Popunjavanje naziva fajla
            fileNameCell.textContent = file;

            // Dodavanje akcija (Edit i Delete)
            actionsCell.innerHTML = `
                            <button class="edit-btn" onclick="loadFile('${file}')">Edit</button>
                            <button class="delete-btn" onclick="deleteFile('${file}')">Delete</button>
                        `;
        });
                })
                .catch(error => console.error('Greška prilikom učitavanja fajlova:', error));
        };

        // Funkcija za učitavanje fajla (Edit)
        function loadFile(fileName) {
            alert(`Učitavanje fajla: ${fileName}`);
            // Ovde poziv load_file.php i popunjavanje forme
        }

        // Funkcija za brisanje fajla (Delete)
        function deleteFile(fileName) {
            if (confirm(`Da li ste sigurni da želite da obrišete fajl: ${fileName}?`)) {
                fetch(`delete_file.php?file=${fileName}`, { method: 'DELETE' })
                    .then(response => response.json())
                    .then(result => {
                    if (result.success) {
                        alert(`Fajl "${fileName}" je uspešno obrisan.`);
                        window.location.reload(); // Osvežava stranicu da bi prikazala ažuriranu listu fajlova
                    } else {
                        alert(`Greška: ${result.error}`);
                    }
                })
                    .catch(error => console.error('Greška prilikom brisanja fajla:', error));
            }
        }

        // Funkcija za generisanje fajlova (Generate)
        function generateFiles() {
            fetch('generate_files.php', { method: 'POST' })
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
