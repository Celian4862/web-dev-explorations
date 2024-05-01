<?php
    // Get the ID of the row to delete
    $id = $_POST['id'];

    // Connect to the database
    $mysqli = new mysqli('localhost', 'root', '', 'test');

    // Check the connection
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Prepare a delete statement
    $stmt = $mysqli->prepare("DELETE FROM contact_list WHERE id = ?");

    // Bind the ID to the statement
    $stmt->bind_param("i", $id);

    // Execute the statement
    $stmt->execute();

    // Close the statement and the connection
    $stmt->close();
    $mysqli->close();

    // Redirect back to the index page
    header("Location: index.php");
    exit;