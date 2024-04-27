<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Contact List</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <?php
            include "test.php";
            echo "Hello<br />";
            $conn = mysqli_connect("localhost", "root", "", "test");
            if (!$conn) {
                die("Connection failed.<br />". mysqli_connect_error());
            }
            echo "Connected successfully<br />";
        ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Email Address</th>
                <th>Contact Number</th>
            </tr>
            <tr>
                <td>21103130</td>
            </tr>
        </table>
    </body>
</html>