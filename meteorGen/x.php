<?php
/**
 * Created by PhpStorm.
 * User: x
 * Date: 23.11.24.
 * Time: 12.42
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
        input[type="text"], select {
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
        .status {
            margin: 20px 0;
            font-weight: bold;
            color: #007BFF;
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
        <!-- Separator -->

        <tr>
            <th>Ime Polja</th>
            <th>Tip Polja</th>
        </tr>

        <!-- Detaljni redovi sa dropdown-om za tip polja -->
        <tr>
            <td><input type="text" name="values[]" placeholder="fieldName1" value=""></td>
            <td>
                <select name="fieldType[]">
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
        <tr>
            <td><input type="text" name="values[]" placeholder="fieldName2" value=""></td>
            <td>
                <select name="fieldType[]">
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
        <tr>
            <td><input type="text" name="values[]" placeholder="fieldName3" value=""></td>
            <td>
                <select name="fieldType[]">
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
    <button type="submit" class="submit-btn">Pošaljite</button>
</form>

<script>
    function addRow() {
        const table = document.getElementById('data-table').getElementsByTagName('tbody')[0];
        const newRow = table.insertRow(-1);

        const keyCell = newRow.insertCell(0);
        const valueCell = newRow.insertCell(1);

        keyCell.innerHTML = '<input type="text" name="keys[]" placeholder="Ime polja">';
        valueCell.innerHTML = '<select name="fieldType[]"><option value="txt">txt</option><option value="mail">mail</option><option value="number">number</option><option value="password">password</option><option value="date">date</option><option value="checkbox">checkbox</option><option value="radio">radio</option></select>';
    }
</script>
</body>
</html>

