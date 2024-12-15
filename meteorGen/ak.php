<?php
/**
 * Created by PhpStorm.
 * User: x
 * Date: 3.12.24.
 * Time: 14.39
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Optimizovani Grid</title>
    <style>
body {
    font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f9f9f9;
        }
        h1 {
    text-align: center;
            color: #0056b3;
            margin-bottom: 20px;
            font-size: 1.5em;
        }
        .container {
    display: grid;
    grid-template-columns: 2fr 1fr;
            gap: 10px;
        }
        .section {
    background: white;
    padding: 10px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            height: fit-content;
        }
        table {
    width: 100%;
    border-collapse: collapse;
        }
        th, td {
    border: 1px solid #ddd;
            padding: 5px; /* Smanjen padding */
            font-size: 0.85em; /* Manji font */
            text-align: left;
        }
        th {
    background-color: #f4f4f4;
        }
        input, select, button {
    padding: 6px; /* Smanjen padding */
            font-size: 0.85em; /* Manji font */
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
    background-color: #28a745;
            color: white;
            cursor: pointer;
        }
        button:hover {
    background-color: #218838;
        }
        .add-row-btn {
    margin-top: 5px;
            padding: 5px 10px;
        }
        .submit-btn {
    margin-top: 10px;
            padding: 5px 10px;
        }
        .file-list {
    height: 150px; /* Ograničena visina za listu fajlova */
            overflow-y: auto;
            margin-bottom: 10px;
        }
        .file-list a {
    display: block;
    margin: 2px 0;
            font-size: 0.85em;
        }
    </style>
</head>
<body>
    <h1>Optimizovani Grid za Unos Podataka</h1>
    <div class="container">
        <!-- Leva sekcija: Grid i lista fajlova -->
        <div class="section">
            <h2>Lista Fajlova</h2>
            <div id="file-list" class="file-list">
                <!-- Dinamički generisani linkovi ka fajlovima -->
            </div>
            <h2>Grid za Unos Podataka</h2>
            <form method="POST">
                <table>
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
                <h3>Dodavanje Polja</h3>
                <table id="data-red">
                    <thead>
                        <tr>
                            <th>Ime Polja</th>
                            <th>Tip Polja</th>
                        </tr>
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
                <button type="button" class="add-row-btn" onclick="addRow()">Dodaj Polje</button>
                <button type="submit" class="submit-btn">Sačuvaj</button>
            </form>
        </div>

        <!-- Desna sekcija: Placeholder za druge sadržaje -->
        <div class="section">
            <h2>Informacije o Projektu</h2>
            <p>
Meteor Web Generator je alat za generisanje personalizovanih aplikacija baziranih na Meteor.js i MongoDB.
Omogućava jednostavno i brzo kreiranje aplikacija uz prilagodljive kolekcije podataka i korisničke interfejse.
            </p>
        </div>
    </div>

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
    </script>
</body>
</html>
