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
    var id = document.getElementById('identity').value, idPattern = /^\d*$/;
    var idError = document.getElementById('idError');

    if (id.length == 0) {
        idError.textContent = "ID cannot be empty.";
    } else if (!idPattern.test(id)) {
        idError.textContent = "ID must be a number.";
    } else if (id.length != 8) {
        idError.textContent = "ID must be 8 digits long.";
    } else {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'check_id.php?id=' + id, true);
        xhr.timeout = 5000;
        xhr.ontimeout = function() {
            idError.textContent = 'The request for ID validation has timed out.';
        };
        xhr.onload = function() {
            if (this.status == 200 && this.responseText == 'exists') {
                idError.textContent = 'ID already exists.';
            } else {
                idError.textContent = '';
            }
        }
        xhr.send();
    }
}

function validateName() {
    var firstName = document.getElementById('firstName').value;
    var lastName = document.getElementById('lastName').value;
    var firstNameError = document.getElementById('firstNameError');
    var lastNameError = document.getElementById('lastNameError');
    var namePattern = /^[a-zA-Z ]+$/;
    var spaces = /^\s*$/;

    if (firstName.length == 0 && lastName.length == 0) {
        firstNameError.textContent = "Both names cannot be empty at the same time.";
        lastNameError.textContent = "Both names cannot be empty at the same time.";
    } else {
        if (firstName.length > 30) {
            firstNameError.textContent = "Name must be within 30 characters long.";
        } else if (firstName.length > 0) {
            if (spaces.test(firstName)) {
                firstNameError.textContent = "Name cannot be only spaces.";
            } else if (!namePattern.test(firstName)) {
                firstNameError.textContent = "Name cannot contain numbers or special characters.";
            } else {
                firstNameError.textContent = "";
            }
        } else {
            firstNameError.textContent = "";
        }
        if (lastName.length > 30) {
            lastNameError.textContent = "Name must be within 30 characters long.";
        } else if (lastName.length > 0) {
            if (spaces.test(lastName)) {
                lastNameError.textContent = "Name cannot be only spaces.";
            } else if (!namePattern.test(lastName)) {
                lastNameError.textContent = "Name cannot contain numbers or special characters.";
            } else {
                lastNameError.textContent = "";
            }
        } else {
            lastNameError.textContent = "";
        }
    }
}

function validateEmail() {
    var email = document.getElementById('email').value;
    var emailPattern = /^[a-zA-Z0-9.]+@[a-zA-Z.]+\.[a-zA-Z]{2,6}$/;
    var spaces = /^\s*$/;
    var emailError = document.getElementById('emailError');

    if (email.length > 50) {
        emailError.textContent = "Email must be within 50 characters.";
    } else if (email.length > 0) {
        if (spaces.test(email)) {
            emailError.textContent = "Email cannot be only spaces.";
        } else if (!emailPattern.test(email)) {
            emailError.textContent = "Invalid email format.";
        } else {
            emailError.textContent = "";
        }
    } else {
        emailError.textContent = "";
    }
}

function validateContact() {
    var contact = document.getElementById('contact').value;
    var contactPattern = /^\d*$/;
    var contactError = document.getElementById('contactError');

    if (!contactPattern.test(contact)) {
        contactError.textContent = "Contact number must contain only numbers.";
    } else if (contact.length > 0 && contact.length != 11) {
        contactError.textContent = "Contact number must be 11 digits long.";
    } else {
        contactError.textContent = "";
    }
}

function validateForm() {
    var id = document.getElementById('identity').value, idPattern = /^\d+$/, idError = document.getElementById('idError');
    var firstName = document.getElementById('firstName').value, firstNameError = document.getElementById('firstNameError');
    var lastName = document.getElementById('lastName').value, lastNameError = document.getElementById('lastNameError');
    var spaces = /^\s*$/;
    var namePattern = /^[a-zA-Z ]+$/;
    var email = document.getElementById('email').value;
    var emailPattern = /^[a-zA-Z0-9.]+@[a-zA-Z.]+\.[a-zA-Z]{2,6}$/;
    var contact = document.getElementById('contact').value, contactPattern = /^\d*$/, contactError = document.getElementById('contactError');
    var valid = true;

    // Validates ID
    if (id.length == 0) {
        idError.textContent = "ID cannot be empty.";
        valid = false;
    } else if (!idPattern.test(id)) {
        idError.textContent = "ID must be a number.";
        valid = false;
    } else if (id.length != 8) {
        idError.textContent = "ID must be 8 characters long.";
        valid = false;
    } else {
        if (idError.textContent == 'ID already exists.') {
            valid = false;
        } else {
            idError.textContent = "";
        }
    }

    // Validates names
    if (firstName.length == 0 && lastName.length == 0) {
        firstNameError.textContent = "Both names cannot be empty at the same time.";
        lastNameError.textContent = "Both names cannot be empty at the same time.";
        valid = false;
    } else {
        if (firstName.length > 30) {
            firstNameError.textContent = "Name must be within 30 characters long.";
            valid = false;
        } else if (firstName.length > 0) {
            if (spaces.test(firstName)) {
                firstNameError.textContent = "Name cannot be only spaces.";
                valid = false;
            } else if (!namePattern.test(firstName)) {
                firstNameError.textContent = "Name cannot contain numbers or special characters.";
                valid = false;
            } else {
                firstNameError.textContent = "";
            }
        } else {
            firstNameError.textContent = "";
        }

        if (lastName.length > 30) {
            lastNameError.textContent = "Name must be within 30 characters long.";
            valid = false;
        } else if (lastName.length > 0) {
            if (spaces.test(lastName)) {
                lastNameError.textContent = "Name cannot be only spaces.";
                valid = false;
            } else if (!namePattern.test(lastName)) {
                lastNameError.textContent = "Name cannot contain numbers or special characters.";
                valid = false;
            } else {
                lastNameError.textContent = "";
            }
        } else {
            lastNameError.textContent = "";
        }
    }

    // Validates email
    if (email.length > 50) {
        emailError.textContent = "Email must be within 50 characters.";
        valid = false;
    } else if (email.length > 0) {
        if (spaces.test(email)) {
            emailError.textContent = "Email cannot be only spaces.";
            valid = false;
        } else if (!emailPattern.test(email)) {
            emailError.textContent = "Invalid email format.";
            valid = false;
        } else {
            emailError.textContent = "";
        }
    } else {
        emailError.textContent = "";
    }

    // Validates contact
    if (!contactPattern.test(contact)) {
        contactError.textContent = "Contact number must contain only numbers.";
        valid = false;
    } else if (contact.length > 0 && contact.length != 11) {
        contactError.textContent = "Contact number must be 11 digits long.";
        valid = false;
    } else {
        contactError.textContent = "";
    }

    return valid;
}