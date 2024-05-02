<?php
    // Connect to the database
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'test';
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Get the 'id' and the new data from the POST parameters
    $id = $_POST['id'];
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];

    // Update the row in the database
    $sql = "UPDATE contact_list SET lastname='$lastname', firstname='$firstname', email='$email', contact='$contact' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $conn->close();