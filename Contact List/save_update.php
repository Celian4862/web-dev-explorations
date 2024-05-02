<?php
    // Connect to the database
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'test';
    $conn = new mysqli($servername, $username, $password, $dbname);

    require 'test_input.php';

    // Get the 'id' and the new data from the POST parameters
    $id = $_POST['id'];
    $firstName = test_input($_POST["firstName"]);
    $lastName = test_input($_POST["lastName"]);
    $email = test_input($_POST["email"]);
    $contact = test_input($_POST["contact"]);

    // Update the row in the database
    $stmt = $conn->prepare("UPDATE contact_list SET lastname=?, firstname=?, email=?, contact=? WHERE id=$id");
    $stmt->bind_param("ssss", $firstName, $lastName, $email, $contact);
    if ($stmt->execute()) {
        echo "<script>console.log(\"Record updated successfully\\n\");</script>";
    } else {
        error_log("Error: " . $stmt->error);
        echo "<script>console.log(\"Error updating record.\");</script>";
    }
    
    header("Location: index.php");

    $conn->close();
    exit();