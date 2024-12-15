<?php
/**
 * Created by PhpStorm.
 * User: x
 * Date: 24.11.24.
 * Time: 10.00
 */

session_start();

// Provera da li je e-mail prosleđen putem GET-a
$e_mail = $_GET['email'] ?? null;

// Provera da li postoji radni direktorijum za korisnika
$userWorkDir = __DIR__ . '/work/' . $e_mail;
if (!$e_mail || !file_exists($userWorkDir)) {
    // Ako korisnik nije registrovan
    echo "<h1>Pristup odbijen</h1>";
    echo "<p>Korisnik nije registrovan. Molimo vas da se registrujete pre nastavka.</p>";
    exit();
} else {
    $_SESSION["e_mail"] = $e_mail;
}

// Ako je korisnik registrovan, može nastaviti sa generisanjem
echo "<h4>Dobrodošli, $e_mail</h4>";

// Ovde ide logika za generisanje aplikacije...

/*if (!file_exists($userWorkDir)) {
    mkdir($userWorkDir, 0777, true);
}*/

// Poruka o statusu
$statusMessage = "";

// Obrada podataka kada je forma poslata
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Prikupljanje podataka iz POST zahteva
    $keys = ['collection', 'title', 'modalTitleAdd', 'modalTitleView', 'modalTitleEdit', 'modalTitleDelete', 'growlSuccessAdd', 'growlSuccessEdit', 'growlSuccessDelete'];
    $values = $_POST['values'];
    $fieldNames = $_POST['fieldNames'] ?? [];
    $fieldTypes = $_POST['fieldTypes'] ?? [];

    // Kreiranje sadržaja za fajl
    $content = "";
    for ($i = 0; $i < count($keys); $i++) {
        $content .= $keys[$i] . '=' . (!empty($values[$i]) ? $values[$i] : $keys[$i]) . "\n";
    }
    $content .= "---\n";

    // Dodavanje polja (ime polja i tip)
    for ($i = 0; $i < count($fieldNames); $i++) {
        $fieldName = $fieldNames[$i];
        $fieldType = $fieldTypes[$i];
        if (!empty($fieldName) && !empty($fieldType)) {
            $content .= $fieldName . ',' . $fieldType . "\n";
        }
    }

//    echo $content;
    // Upisivanje u fajl
    $filePath = $userWorkDir . '/' . $values[0] . '.txt';
    $writeSuccess = file_put_contents($filePath, $content);

// Postavljanje statusne poruke
    if ($writeSuccess === false) {
        $statusMessage = "Greška pri upisu u fajl." . $filePath;
    } else {
        $statusMessage = "Podaci su uspešno sačuvani u: " . $filePath;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unos i Upis Podataka</title>
    <style>
        body {
            transform: scale(0.8); /* Smanjenje na 80% */
            transform-origin: top left; /* Poreklom skaliranja */
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 5px;
        }
        th, td {
            border: 1px solid #4d90fe;
            padding: 2px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        h4 {
            text-align: right;
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

        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        input[type="text"], select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        .col1 {
            width: 25%; /* Prva kolona zauzima 60% širine */
        }
        .col2 {
            width: auto; /* Druga kolona zauzima onoliko koliko treba */
        }
        select {
            width: auto; /* Selektor zauzima minimalnu širinu potrebnu za sadržaj */
        }


        .add-row-btn {
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
        }
        .add-row-btn:hover {
            background-color: #0056b3;
        }
        .submit-btn {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }
        .submit-btn:hover {
            background-color: #218838;
        }
        .status {
            margin: 20px 0;
            font-weight: bold;
            color: #007BFF;
        }
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
<?php
if (file_exists($userWorkDir)) {

$files = array_values(array_filter(scandir($userWorkDir), function ($file) use ($userWorkDir) {
    return is_file($userWorkDir . '/' . $file) && pathinfo($file, PATHINFO_EXTENSION) === 'txt';
}));
//echo var_dump($files);
if ($files) {
?>
    <h3>Lista Fajlova</h3>
<!--<div id="file-list" class="file-list"></div>-->

<table id="file-grid" style="width: 50%">
                <thead>
                <tr>

                    <th>Naziv Fajla</th>
                    <th>Akcije</th>

                </tr>
                </thead>
                <tbody>
                <!-- Dinamički redovi će biti dodati ovde putem PHP-a -->
                <?php
                /*    $e_mail = 'n_ilija@yahoo.com';
                    $userWorkDir = __DIR__ . '/work/' . $e_mail;*/

                /*    if (file_exists($userWorkDir)) {*/

                foreach ($files as $file) {
                    echo '<tr>';
                    echo '<td style="width: 67%">' . htmlspecialchars($file) . '</td>';
                    echo '<td>';
                    echo '<button class="edit-btn" onclick="loadFile(\'' . $file . '\')">Edit</button> ';
                    echo '<button class="delete-btn" onclick="deleteFile(\'' . $file . '\')">Delete</button>';
                    echo '</td>';
                    echo '</tr>';
                }
                echo '<button class="generate-btn" onclick="generateFiles()">Generiši</button>';

                ?>
                </tbody>

                <?php
                }
                }
    ?>


</table>

<h3>Grid za Unos Podataka</h3>
<!-- Status poruka -->
<?php if (!empty($statusMessage)): ?>
    <div class="status"><?php echo $statusMessage; ?></div>
<?php endif; ?>

<!-- Forma za unos podataka -->
<form method="POST">
    <!-- Prva tabela: Zaglavlje -->
    <table id="data-table">
        <thead>
        <tr>
            <th>Zaglavlje:</th>
        </tr>
        </thead>
        <tbody>
        <!-- Zaglavlje fajla sa placeholderima (max 3 reda) -->
        <tr>
            <td><input type="text" name="values[]" placeholder="collection" value="colfile"></td>
            <td><input type="text" name="values[]" placeholder="title" value="My Application Title"></td>
        </tr>
        <tr>
            <td><input type="text" name="values[]" placeholder="modalTitleAdd" value="Add New Entry"></td>
            <td><input type="text" name="values[]" placeholder="modalTitleView" value="View Entry"></td>
            <td><input type="text" name="values[]" placeholder="modalTitleEdit" value="Edit Entry"></td>
            <td><input type="text" name="values[]" placeholder="modalTitleDelete" value="Delete Entry"></td>
        </tr>
        <tr>
            <td><input type="text" name="values[]" placeholder="growlSuccessAdd" value="Successfully added!"></td>
            <td><input type="text" name="values[]" placeholder="growlSuccessEdit" value="Successfully edited!"></td>
            <td><input type="text" name="values[]" placeholder="growlSuccessDelete" value="Successfully deleted!"></td>
        </tr>
        </tbody>
    </table>

    <!-- Separator: Druga tabela -->
    <table id="data-red" style="width: 50%">
        <thead>
        <th>Ime Polja</th>
        <th>Tip Polja</th>

<!--        <th class="col1">Ime Polja</th>
        <th class="col2">Tip Polja</th>-->
        </thead>
        <tbody>
        <!-- Detaljni redovi sa dropdown-om za tip polja -->
        <tr>
            <td><input type="text" name="fieldNames[]" placeholder="Ime Polja"></td>
            <td>
                <select name="fieldTypes[]">
                    <option value="txt">txt</option>
                    <option value="mail">mail</option>
                    <option value="number">number</option>
                    <option value="password">password</option>
                    <option value="date">date</option>
                    <option value="checkbox">checkbox</option>
                    <option value="radio">radio</option>
                </select>
            </td>
        </tr>
        </tbody>
    </table>

    <!-- Dugmad -->
    <button type="button" class="add-row-btn" onclick="addRow()">Dodaj Polje</button>
    <button type="submit" class="submit-btn">Sačuvaj</button>
</form>
<script>
    function addRow() {
        const table = document.querySelector('#data-red tbody');
        const row = document.createElement('tr');

        row.innerHTML = `
                <td><input type="text" name="fieldNames[]" placeholder="Ime Polja"></td>
                <td>
                    <select name="fieldTypes[]">
                        <option value="txt">txt</option>
                        <option value="mail">mail</option>
                        <option value="number">number</option>
                        <option value="password">password</option>
                        <option value="date">date</option>
                        <option value="checkbox">checkbox</option>
                        <option value="radio">radio</option>
                    </select>
                </td>
            `;
        table.appendChild(row);
    }

    // Dinamičko učitavanje liste fajlova
/*    window.onload = function () {
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
    };*/
    // Funkcija za učitavanje fajla (dummy primer)
    function loadFile_(fileName) {
        alert(`Učitavanje fajla: ${fileName}`);
        // Ovde možete dodati logiku za učitavanje i prikaz podataka fajla
    }
    // Učitavanje podataka iz fajla
    function loadFile(fileName) {
        fetch(`load_file.php?file=${fileName}`)
            .then(response => response.json())
    .then(data => {
            // Popunjavanje zaglavlja
            const headerTable = document.getElementById('data-table').getElementsByTagName('tbody')[0];
        headerTable.innerHTML = ''; // Čišćenje postojećih podataka

        const headerValues = [
            data.header.collection,
            data.header.title,
            data.header.modalTitleAdd,
            data.header.modalTitleView,
            data.header.modalTitleEdit,
            data.header.modalTitleDelete,
            data.header.growlSuccessAdd,
            data.header.growlSuccessEdit,
            data.header.growlSuccessDelete
        ];

        // Dodavanje redova u zaglavlje
        headerTable.innerHTML = `
                <tr>
                    <td><input type="text" name="values[]" placeholder="collection" value="${headerValues[0]}"></td>
                    <td><input type="text" name="values[]" placeholder="title" value="${headerValues[1]}"></td>
                </tr>
                <tr>
                    <td><input type="text" name="values[]" placeholder="modalTitleAdd" value="${headerValues[2]}"></td>
                    <td><input type="text" name="values[]" placeholder="modalTitleView" value="${headerValues[3]}"></td>
                    <td><input type="text" name="values[]" placeholder="modalTitleEdit" value="${headerValues[4]}"></td>
                    <td><input type="text" name="values[]" placeholder="modalTitleDelete" value="${headerValues[5]}"></td>
                </tr>
                <tr>
                    <td><input type="text" name="values[]" placeholder="growlSuccessAdd" value="${headerValues[6]}"></td>
                    <td><input type="text" name="values[]" placeholder="growlSuccessEdit" value="${headerValues[7]}"></td>
                    <td><input type="text" name="values[]" placeholder="growlSuccessDelete" value="${headerValues[8]}"></td>
                </tr>
            `;

        // Popunjavanje redova sa poljima
        const fieldTable = document.getElementById('data-red').getElementsByTagName('tbody')[0];
        fieldTable.innerHTML = ''; // Čišćenje postojećih redova

        data.fields.forEach(row => {
            const newRow = fieldTable.insertRow(-1); // Dodavanje novog reda na kraj tabele
        const keyCell = newRow.insertCell(0);
        const valueCell = newRow.insertCell(1);

        keyCell.innerHTML = `<input type="text" name="fieldNames[]" value="${row.key}">`;
        valueCell.innerHTML = `
                    <select name="fieldTypes[]">
                        <option value="txt" ${row.type === 'txt' ? 'selected' : ''}>txt</option>
                        <option value="mail" ${row.type === 'mail' ? 'selected' : ''}>mail</option>
                        <option value="number" ${row.type === 'number' ? 'selected' : ''}>number</option>
                        <option value="password" ${row.type === 'password' ? 'selected' : ''}>password</option>
                        <option value="date" ${row.type === 'date' ? 'selected' : ''}>date</option>
                        <option value="checkbox" ${row.type === 'checkbox' ? 'selected' : ''}>checkbox</option>
                        <option value="radio" ${row.type === 'radio' ? 'selected' : ''}>radio</option>
                    </select>`;
    });
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
        fetch('generate_files_.php', { method: 'GET' }) // Koristimo GET zbog PHP 7.4 kompatibilnosti
            .then(response => response.json())
    .then(result => {
            if (result.success) {
            alert('Generisanje fajlova je uspešno završeno.');
        } else {
            alert(`Greška: ${result.error}`);
        }
    })
    .catch(error => console.error('Greška prilikom generisanja fajlova:', error));

        fetch('zip_mail_.php', { method: 'GET' }) // Koristimo GET zbog PHP 7.4 kompatibilnosti
            .then(response => response.json())
    .then(result => {
            if (result.success) {
//            alert('Slanje fajlova izvršeno.');
            alert (result.success);
        } else {
            alert(`Greška: ${result.error}`);
        }
    })
    .catch(error => console.error('Greška prilikom slanja fajlova:', error));
    }

</script>
</body>
</html>