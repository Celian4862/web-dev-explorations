<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
        <title>Contact List</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <table class="center collapse">
            <tr>
                <th>ID</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Email Address</th>
                <th>Contact Number</th>
            </tr>
            <?php
                $conn = mysqli_connect("localhost", "root", "", "test");
                if (!$conn) {
                    die("Connection failed.<br />". mysqli_connect_error());
                }
                echo "
                    <script>
                        console.log(\"Connected successfully.\\n\");
                    </script>
                ";
                $sql = "CREATE TABLE MyGuests (
                    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    firstname VARCHAR(30) NOT NULL,
                    lastname VARCHAR(30) NOT NULL,
                    email VARCHAR(50),
                    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                )";
                if (mysqli_query($conn, $sql)) {
                    echo "Table MyGuests created successfully";
                } else {
                    echo "Error creating table: " . mysqli_error($conn);
                }
            ?>
        </table>
    </body>
</html>