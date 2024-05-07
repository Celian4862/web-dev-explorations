<?php
    // Establish a connection to the database
    $db = mysqli_connect('localhost', 'root', '', 'test');

    // Check if the connection was successful
    if (!$db) {
        die('Oops! Connection failed.<br />' . mysqli_connect_error());
    }

    echo "<script>console.log(\"Connected successfully.\\n\");</script>";

    // Define the SQL query to create the table if it doesn't exist
    $sql = "CREATE TABLE IF NOT EXISTS contact_list (
        id INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        firstname VARCHAR(30) NOT NULL,
        lastname VARCHAR(30) NOT NULL,
        email VARCHAR(50) NOT NULL,
        contact VARCHAR(11) NOT NULL
    )";

    // Execute the SQL query
    if (mysqli_query($db, $sql)) {
        echo "<script>console.log(\"Table MyGuests created successfully\\n\");</script>";
    } else {
        echo "<script>console.log(\"Error creating table: \\n\");</script>" . mysqli_error($db);
    }

    // Close the database connection
    mysqli_close($db);
?>
