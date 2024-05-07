<?php
    // Get the ID of the row to delete
    $id = $_POST['id'];

    // Establish a connection to the database
    $db = new mysqli('localhost', 'root', '', 'test');

    // Check if the connection was successful
    if ($db->connect_error) {
        die("Oops! Connection failed: " . $db->connect_error);
    }

    // Prepare a delete query
    $query = "DELETE FROM contact_list WHERE id = ?";

    // Bind the ID to the query
    $statement = $db->prepare($query);
    $statement->bind_param("i", $id);

    // Execute the query
    $statement->execute();

    // Close the statement and the database connection
    $statement->close();
    $db->close();

    // Redirect back to the index page
    header("Location: index.php");
    exit;
?>
