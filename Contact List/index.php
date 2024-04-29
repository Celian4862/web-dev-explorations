<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">
        <title>Contact List</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <script defer src="script.js"></script>
    </head>
    <body>
        <?php
            function test_input($data) {
                // Removes extra whitespace between words
                $data = preg_replace('/\s+/', ' ', $data);
                // Removes all whitespace at the beginning and end of a string
                $data = trim($data);
                // Removes all slashes
                $data = stripslashes($data);
                // Converts special characters into HTML code
                $data = htmlspecialchars($data);
                return $data;
            }
            $conn = mysqli_connect("localhost", "root", "", "test");
            if (!$conn) {
                die("Connection failed.<br />". mysqli_connect_error());
            }
            echo "
                <script>
                    console.log(\"Connected successfully.\\n\");
                </script>
            ";
            $sql = "CREATE TABLE IF NOT EXISTS contact_list (
                id INT(8) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                firstname VARCHAR(30),
                lastname VARCHAR(30),
                email VARCHAR(50),
                contact VARCHAR(11)
                -- reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )";
            if (mysqli_query($conn, $sql)) {
                echo "<script>console.log(\"Table MyGuests created successfully\\n\");</script>";
            } else {
                echo "<script>console.log(\"Error creating table: \\n\");</script>" . mysqli_error($conn);
            }
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
                exit;
            }
        ?>
        <h1 style="text-align: center;">Contact List</h1>
        <header class='sticky'>
            <button class="block center" id="addButton" onclick="reveal()">Add a contact</button>
            <button class="block center hidden" id="cancel" type="button" onclick="event.preventDefault(); hide();">Cancel</button>

            <form class="border hidden" id="addContact" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" onsubmit="return validateForm()">
                <p style="color: red;">**Required field</p>
                <p style="color: orange;">*At least one must be filled</p>

                <span style="color: red;">**</span><label for="identity">ID:</label>
                <input type="text" id="identity" name="identity" oninput="validateId()">&nbsp;
                <span style="color: red;" id="idError"></span>
                <br />

                <span style="color: orange;">*</span><label for="firstName">First Name:</label>
                <input type="text" id="firstName" name="firstName" oninput="validateName()">&nbsp;
                <span style="color: orange;" id="firstNameError"></span>
                <br />

                <span style="color: orange;">*</span><label for="lastName">Last Name:</label>
                <input type="test" id="lastName" name="lastName" oninput="validateName()">&nbsp;
                <span style="color: orange;" id="lastNameError"></span>
                <br />

                <label for="email">Email Address:</label>
                <input type="email" id="email" name="email" oninput="validateEmail()">&nbsp;
                <span style= "color: yellow;" id="emailError"></span>
                <br />

                <label for="contact">Contact Number:</label>
                <input type="tel" id="contact" name="contact" oninput="validateContact()">&nbsp;<span style="color: yellow;" id="contactError"></span>&nbsp;
                <span style="color: yellow;" id="contactError"></span>
                <br />

                <input type="submit" value="Submit">
            </form>
        </header>
        <table class="center collapse">
            <tr>
                <th>ID</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Email Address</th>
                <th>Contact Number</th>
            </tr>
            <!-- Need to figure out how to display the contents of the database -->
        </table>
    </body>
</html>
