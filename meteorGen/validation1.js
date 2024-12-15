/**
 * Created by x on 15.12.24..
 */
const fs = require('fs');
const path = require('path');

// Putanja do fajla koji generišemo
const outputPath = path.join(__dirname, 'validateInputs.js');

let txt = "";
txt += "function validateInputs() {" +
    + "    let errorCount = 0;" +
    + "    document.querySelectorAll('input').forEach(input => {" +
    + "        const id = input.id;" +
    + "        const type = input.type;" +
    + "        const value = input.value.trim();" +
    + "        let errorMessage = '';" +
    + "        switch (type) {" +
    + "            case 'text':" +
    + "                if (value.length < 2) {" +
    + "                    errorMessage = `Field with ID ${id} requires at least 2 characters.`;" +
    + "                }" +
    + "                break;" +
    + "            case 'email':" +
    + "                const emailRegex = /^[^@\\s]+@[^@\\s]+\\.[^@\\s]+$/;" +
    + "                if (!emailRegex.test(value)) {" +
    + "                    errorMessage = `Field with ID ${id} requires a valid email address.`;" +
    + "                }" +
    + "                break;" +
    + "            case 'number':" +
    + "                if (isNaN(value) || value === '') {" +
    + "                    errorMessage = `Field with ID ${id} requires a valid number.`;" +
    + "                }" +
    + "                break;" +
    + "            case 'password':" +
    + "                if (value.length < 6) {" +
    + "                    errorMessage = `Field with ID ${id} requires at least 6 characters.`;" +
    + "                }" +
    + "                break;" +
    + "            case 'checkbox':" +
    + "                if (!input.checked) {" +
    + "                    errorMessage = `Checkbox with ID ${id} must be checked.`;" +
    + "                }" +
    + "                break;" +
    + "            case 'radio':" +
    + "                const name = input.name;" +
    + "                if (!document.querySelector(`input[name=\\"${name}\\"]:checked`)) {" +
+ "                    errorMessage = `At least one option in the radio group ${name} must be selected.`;" +
+ "                }" +
+ "                break;" +
+ "            case 'date':" +
+ "                if (!value) {" +
+ "                    errorMessage = `Field with ID ${id} requires a valid date.`;" +
+ "                }" +
+ "                break;" +
+ "            default:" +
+ "                break;" +
+ "        }" +
+ "        if (errorMessage) {" +
+ "            errorCount++;" +
+ "            console.error(errorMessage);" +
+ "            alert(errorMessage);" +
+ "        }" +
+ "    });" +
+ "    return errorCount === 0;" +
+ "}";

fs.writeFile(outputPath, txt, (err) => {
    if (err) {
        console.error('Error writing to file:', err);
    } else {
        console.log(`JavaScript function successfully written to ${outputPath}`);
}
});
