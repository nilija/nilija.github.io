<?php
/**
 * Created by PhpStorm.
 * User: x
 * Date: 23.11.24.
 * Time: 11.05
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grid za Unos Podataka</title>
    <style>
body {
    font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
    width: 100%;
    border-collapse: collapse;
        }
        th, td {
    border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
    background-color: #f4f4f4;
        }
        input[type="text"] {
    width: 100%;
    padding: 8px;
            box-sizing: border-box;
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
    </style>
</head>
<body>
    <h1>Grid za Unos Podataka</h1>

    <!-- Forma za unos podataka -->
    <form id="data-form" method="POST">
        <table id="data-table">
            <thead>
                <tr>
                    <th>Ključ</th>
                    <th>Vrednost</th>
                </tr>
            </thead>
            <tbody>
                <!-- Zaglavlje fajla -->
                <tr>
                    <td><input type="text" name="keys[]" value="collection" readonly></td>
                    <td><input type="text" name="values[]" value="colfile"></td>
                </tr>
                <tr>
                    <td><input type="text" name="keys[]" value="title" readonly></td>
                    <td><input type="text" name="values[]" value="My Application Title"></td>
                </tr>
                <tr>
                    <td><input type="text" name="keys[]" value="modalTitleAdd" readonly></td>
                    <td><input type="text" name="values[]" value="Add New Entry"></td>
                </tr>
                <tr>
                    <td><input type="text" name="keys[]" value="modalTitleView" readonly></td>
                    <td><input type="text" name="values[]" value="View Entry"></td>
                </tr>
                <tr>
                    <td><input type="text" name="keys[]" value="modalTitleEdit" readonly></td>
                    <td><input type="text" name="values[]" value="Edit Entry"></td>
                </tr>
                <tr>
                    <td><input type="text" name="keys[]" value="modalTitleDelete" readonly></td>
                    <td><input type="text" name="values[]" value="Delete Entry"></td>
                </tr>
                <tr>
                    <td><input type="text" name="keys[]" value="growlSuccessAdd" readonly></td>
                    <td><input type="text" name="values[]" value="Successfully added!"></td>
                </tr>
                <tr>
                    <td><input type="text" name="keys[]" value="growlSuccessEdit" readonly></td>
                    <td><input type="text" name="values[]" value="Successfully edited!"></td>
                </tr>
                <tr>
                    <td><input type="text" name="keys[]" value="growlSuccessDelete" readonly></td>
                    <td><input type="text" name="values[]" value="Successfully deleted!"></td>
                </tr>
                <!-- Separator -->
                <tr>
                    <td colspan="2" style="text-align: center; font-weight: bold;">---</td>
                </tr>
                <!-- Polja -->
                <tr>
                    <td><input type="text" name="keys[]" value="fieldName1"></td>
                    <td><input type="text" name="values[]" value="txt"></td>
                </tr>
                <tr>
                    <td><input type="text" name="keys[]" value="fieldName2"></td>
                    <td><input type="text" name="values[]" value="txt"></td>
                </tr>
                <tr>
                    <td><input type="text" name="keys[]" value="fieldName3"></td>
                    <td><input type="text" name="values[]" value="mail"></td>
                </tr>
            </tbody>
        </table>
        <button type="button" class="add-row-btn" onclick="addRow()">Dodaj Polje</button>
        <button type="submit" class="submit-btn">Pošalji</button>
    </form>

    <script>
        function addRow() {
            const table = document.getElementById('data-table').getElementsByTagName('tbody')[0];
            const newRow = table.insertRow(-1);

            const keyCell = newRow.insertCell(0);
            const valueCell = newRow.insertCell(1);

            keyCell.innerHTML = '<input type="text" name="keys[]" placeholder="Ime polja">';
            valueCell.innerHTML = '<input type="text" name="values[]" placeholder="Tip polja">';
        }
    </script>
</body>
</html>
