<?php
/**
 * Created by PhpStorm.
 * User: x
 * Date: 24.11.24.
 * Time: 14.26
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Fajlova</title>
    <style>
        .file-list a {
    display: block;
    margin: 5px 0;
            color: blue;
            text-decoration: none;
        }
        .file-list a:hover {
    text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Lista Fajlova</h1>
    <div id="file-list" class="file-list"></div>

    <script>
// Dinamičko učitavanje liste fajlova
window.onload = function () {
    fetch('list_files.php') // Pretpostavlja se da ova PHP skripta vraća JSON sa listom fajlova
    .then(response => response.json())
                .then(files => {
        const fileList = document.getElementById('file-list');
        files.forEach(file => {
            const fileLink = document.createElement('a'); // Kreiranje <a> elementa
            fileLink.textContent = file; // Postavljanje imena fajla
            fileLink.href = '#'; // Link (ili prava putanja do fajla ako je potrebno)
            fileLink.onclick = (event) => {
                event.preventDefault(); // Sprečavanje podrazumevanog ponašanja
                loadFile(file); // Poziva funkciju za učitavanje fajla
            };
                        fileList.appendChild(fileLink); // Dodavanje linka u div
                    });
                })
                .catch(error => console.error('Greška prilikom učitavanja fajlova:', error));
        };

        // Funkcija za učitavanje fajla (dummy primer)
        function loadFile(fileName) {
            alert(`Učitavanje fajla: ${fileName}`);
            // Ovde možete dodati logiku za učitavanje i prikaz podataka fajla
        }
    </script>
</body>
</html>
