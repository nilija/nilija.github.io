/**
 * Created by x on 15.12.24..
 */

// Dynamic validation function
function validateInputs() {
    let errorCount = 0;

    // Iterate through all input fields in the form
    document.querySelectorAll('input').forEach(input => {
        const id = input.id;
    const type = input.type;
    const value = input.value.trim();
    let errorMessage = '';

    // Validate based on input type
    switch (type) {
        case 'text':
            if (value.length < 2) {
                errorMessage = `Field with ID ${id} requires at least 2 characters.`;
            }
            break;

        case 'email':
            const emailRegex = /^[^@\s]+@[^@\s]+\.[^@\s]+$/;
            if (!emailRegex.test(value)) {
                errorMessage = `Field with ID ${id} requires a valid email address.`;
            }
            break;

        case 'number':
            if (isNaN(value) || value === '') {
                errorMessage = `Field with ID ${id} requires a valid number.`;
            }
            break;

        case 'password':
            if (value.length < 6) {
                errorMessage = `Field with ID ${id} requires at least 6 characters.`;
            }
            break;

        case 'checkbox':
            if (!input.checked) {
                errorMessage = `Checkbox with ID ${id} must be checked.`;
            }
            break;

        case 'radio':
            const name = input.name;
            if (!document.querySelector(`input[name="${name}"]:checked`)) {
                errorMessage = `At least one option in the radio group ${name} must be selected.`;
            }
            break;

        case 'date':
            if (!value) {
                errorMessage = `Field with ID ${id} requires a valid date.`;
            }
            break;

        default:
            // Additional input types can be handled here
            break;
    }

    // Display error if validation fails
    if (errorMessage) {
        errorCount++;
        console.error(errorMessage); // Log the error to the console
        // Display the error message to the user
        alert(errorMessage); // Optional: Replace with your preferred notification library
    }
});

    return errorCount === 0; // Returns true if no errors
}

// Example usage on form submit
document.querySelector('form').addEventListener('submit', function (event) {
    event.preventDefault(); // Prevent form submission
    if (validateInputs()) {
        console.log('All inputs are valid. Form can be submitted.');
    } else {
        console.log('Validation failed. Correct the errors.');
    }
});


