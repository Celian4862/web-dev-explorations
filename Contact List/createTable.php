<?php
    $conn = mysqli_connect('localhost', 'root', '', 'test');
    if (!$conn) {
        die('Connection failed.<br />'. mysqli_connect_error());
    }
    echo "
        <script>
            console.log(\"Connected successfully.\\n\");
        </script>
    ";
    $sql = "CREATE TABLE IF NOT EXISTS contact_list (
        id INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        firstname VARCHAR(30) NOT NULL,
        lastname VARCHAR(30) NOT NULL,
        email VARCHAR(50) NOT NULL,
        contact VARCHAR(11) NOT NULL
        -- reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    if (mysqli_query($conn, $sql)) {
        echo "<script>console.log(\"Table MyGuests created successfully\\n\");</script>";
    } else {
        echo "<script>console.log(\"Error creating table: \\n\");</script>" . mysqli_error($conn);
    }