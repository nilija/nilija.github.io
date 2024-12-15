<?php
/**
 * Created by PhpStorm.
 * User: x
 * Date: 23.11.24.
 * Time: 12.08
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
    <form id="data-form" method="POST" action="save_data.php">
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
                    <td><label for="collection">Collection</label></td>
                    <td><input type="text" name="values[]" id="collection" value="colfile"></td>
                </tr>
                <tr>
                    <td><label for="title">Title</label></td>
                    <td><input type="text" name="values[]" id="title" value="My Application Title"></td>
                </tr>
                <tr>
                    <td><label for="modalTitleAdd">Modal Title Add</label></td>
                    <td><input type="text" name="values[]" id="modalTitleAdd" value="Add New Entry"></td>
                </tr>
                <tr>
                    <td><label for="modalTitleView">Modal Title View</label></td>
                    <td><input type="text" name="values[]" id="modalTitleView" value="View Entry"></td>
                </tr>
                <tr>
                    <td><label for="modalTitleEdit">Modal Title Edit</label></td>
                    <td><input type="text" name="values[]" id="modalTitleEdit" value="Edit Entry"></td>
                </tr>
                <tr>
                    <td><label for="modalTitleDelete">Modal Title Delete</label></td>
                    <td><input type="text" name="values[]" id="modalTitleDelete" value="Delete Entry"></td>
                </tr>
                <tr>
                    <td><label for="growlSuccessAdd">Growl Success Add</label></td>
                    <td><input type="text" name="values[]" id="growlSuccessAdd" value="Successfully added!"></td>
                </tr>
                <tr>
                    <td><label for="growlSuccessEdit">Growl Success Edit</label></td>
                    <td><input type="text" name="values[]" id="growlSuccessEdit" value="Successfully edited!"></td>
                </tr>
                <tr>
                    <td><label for="growlSuccessDelete">Growl Success Delete</label></td>
                    <td><input type="text" name="values[]" id="growlSuccessDelete" value="Successfully deleted!"></td>
                </tr>
                <!-- Separator -->
                <tr>
                    <td colspan="2" style="text-align: center; font-weight: bold;">---</td>
                </tr>
                <!-- Polja -->
                <tr>
                    <td><label for="fieldName1">Field Name 1</label></td>
                    <td><input type="text" name="values[]" id="fieldName1" value="txt"></td>
                </tr>
                <tr>
                    <td><label for="fieldName2">Field Name 2</label></td>
                    <td><input type="text" name="values[]" id="fieldName2" value="txt"></td>
                </tr>
                <tr>
                    <td><label for="fieldName3">Field Name 3</label></td>
                    <td><input type="text" name="values[]" id="fieldName3" value="mail"></td>
                </tr>
            </tbody>
        </table>
        <button type="button" class="add-row-btn" onclick="addRow()">Dodaj Polje</button>
        <button type="submit" class="submit-btn">Pošaljite</button>
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
