<?php
    // Connect to the database
    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'test';
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Get the 'id' from the POST parameters
    $id = $_POST['id'];

    // Fetch the current data for this row
    $sql = "SELECT * FROM contact_list WHERE id = $id";
    $result = $conn->query($sql);
    $row = mysqli_fetch_assoc($result);

    // Display the data in a form
    echo "<form method='POST' action='save_update.php'>";
    echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
    echo "<input type='text' name='lastname' value='" . $row['lastname'] . "'>";
    echo "<input type='text' name='firstname' value='" . $row['firstname'] . "'>";
    echo "<input type='text' name='email' value='" . $row['email'] . "'>";
    echo "<input type='text' name='contact' value='" . $row['contact'] . "'>";
    echo "<input type='submit' value='Save'>";
    echo "</form>";

    $conn->close();