function reveal() {
    document.getElementById('addContact').classList.remove("hidden");
    document.getElementById('cancel').classList.remove("hidden");
    document.getElementById('addButton').classList.add("hidden");
}

function hide() {
    document.getElementById('addContact').classList.add("hidden");
    document.getElementById('cancel').classList.add("hidden");
    document.getElementById('addButton').classList.remove("hidden");
    document.getElementById("addContact").reset();
}

function validateId() {
    var id = document.getElementById('identity').value;
    var errorSpan = document.getElementById('idError');

    if (id.length == 0) {
        errorSpan.textContent = "ID cannot be empty.";
    } else if (isNaN(id)) {
        errorSpan.textContent = "ID must be a number";
    } else if (id.length != 8) {
        errorSpan.textContent = "ID must be at least 8 digits long";
    } else {
        errorSpan.textContent = "";
    }
}

function validateName() {
    var firstName = document.getElementById('firstName').value;
    var lastName = document.getElementById('lastName').value;
    var firstNameError = document.getElementById('firstNameError');
    var lastNameError = document.getElementById('lastNameError');
    var namePattern = /^[a-zA-Z ]+$/;

    if (firstName.length == 0 && lastName.length == 0) {
        firstNameError.textContent = "Both names cannot be empty at the same time.";
        lastNameError.textContent = "Both names cannot be empty at the same time.";
    } else {
        if (firstName.length > 0 && !namePattern.test(firstName)) {
            firstNameError.textContent = "Name must only contain letters.";
        } else if (firstName.length > 30) {
            firstNameError.textContent = "Name must be within 30 characters long.";
        } else {
            firstNameError.textContent = "";
        }
        if (lastName.length > 0 && !namePattern.test(lastName)) {
            lastNameError.textContent = "Name must only contain letters.";
        } else if (lastName.length > 30) {
            lastNameError.textContent = "Name must be within 30 characters long.";
        } else {
            lastNameError.textContent = "";
        }
    }
}

function validateEmail() {
    var email = document.getElementById('email').value;
    var emailPattern = /^[a-zA-Z0-9.]+@[a-zA-Z.]+\.[a-zA-Z]{2,6}$/;
    var emailError = document.getElementById('emailError');

    if (email.length > 0 && !emailPattern.test(email)) {
        emailError.textContent = "Invalid email format.";
    } else if (email.length > 50) {
        emailError.textContent = "Email must be within 50 characters.";
    } else {
        emailError.textContent = "";
    }
}

function validateContact() {
    var contact = document.getElementById('contact').value;
    var contactError = document.getElementById('contactError');

    if (isNaN(contact)) {
        contactError.textContent = "Contact number must only contain numbers.";
    } else if (contact.length > 0 && contact.length != 11) {
        contactError.textContent = "Contact number must be 11 digits long.";
    } else {
        contactError.textContent = "";
    }
}

function validateForm() {
    var id = document.getElementById('identity').value, idError = document.getElementById('idError');
    var firstName = document.getElementById('firstName').value, firstNameError = document.getElementById('firstNameError');
    var lastName = document.getElementById('lastName').value, lastNameError = document.getElementById('lastNameError');
    var namePattern = /^[a-zA-Z ]+$/;
    var email = document.getElementById('email').value;
    var emailPattern = /^[a-zA-Z0-9.]+@[a-zA-Z.]+\.[a-zA-Z]{2,6}$/;
    var contact = document.getElementById('contact').value, contactError = document.getElementById('contactError');

    // Validates ID
    if (id.length == 0) {
        idError.textContent = "ID cannot be empty.";
        return false;
    } else if (isNaN(id)) {
        idError.textContent = "ID must be a number";
        return false;
    } else if (id.length != 8) {
        idError.textContent = "ID must be at least 8 characters long";
        return false;
    } else {
        idError.textContent = "";
    }

    // Validates names
    if (firstName.length == 0 && lastName.length == 0) {
        firstNameError.textContent = "Both names cannot be empty at the same time.";
        lastNameError.textContent = "Both names cannot be empty at the same time.";
        return false;
    } else {
        if (firstName.length > 0 && !namePattern.test(firstName)) {
            firstNameError.textContent = "Name must only contain letters.";
            return false;
        } else if (firstName.length > 30) {
            firstNameError.textContent = "Name must be within 30 characters long.";
            return false;
        } else {
            firstNameError.textContent = "";
        }
        if (lastName.length > 0 && !namePattern.test(lastName)) {
            lastNameError.textContent = "Name must only contain letters.";
            return false;
        } else if (lastName.length > 30) {
            lastNameError.textContent = "Name must be within 30 characters long.";
            return false;
        } else {
            lastNameError.textContent = "";
        }
    }

    // Validates email
    if (email.length > 0 && !emailPattern.test(email)) {
        emailError.textContent = "Invalid email format.";
        return false;
    } else if (email.length > 50) {
        emailError.textContent = "Email must be within 50 characters.";
        return false;
    } else {
        emailError.textContent = "";
    }

    // Validates contact
    if (isNaN(contact)) {
        contactError.textContent = "Contact number must only contain numbers.";
        return false;
    } else if (contact.length > 0 && contact.length != 11) {
        contactError.textContent = "Contact number must be 11 digits long.";
        return false;
    } else {
        contactError.textContent = "";
    }

    return true;
}
