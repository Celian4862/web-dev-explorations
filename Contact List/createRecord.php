<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = test_input($_POST["identity"]);
        $firstName = test_input($_POST["firstName"]);
        $lastName = test_input($_POST["lastName"]);
        $email = test_input($_POST["email"]);
        $contact = test_input($_POST["contact"]);
    
        $firstName = empty($firstName) ? NULL : $firstName;
        $lastName = empty($lastName) ? NULL : $lastName;
        $email = empty($email) ? NULL : $email;
        $contact = empty($contact) ? NULL : $contact;
    
        $stmt = $conn->prepare("INSERT INTO contact_list (id, firstname, lastname, email, contact) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issss", $id, $firstName, $lastName, $email, $contact);
        if ($stmt->execute()) {
            echo "<script>console.log(\"New record created successfully\\n\");</script>";
        } else {
            error_log("Error: " . $stmt->error);
            echo "<script>console.log(\"An error occurred. Please try again later.\");</script>";
        }
        mysqli_close($conn);
        $_POST["firstName"] = $_POST["lastName"] = $_POST["email"] = $_POST["contact"] = "";
        header("Location: index.php");
        exit();
    }