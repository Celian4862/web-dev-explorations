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
        ?>
        <h1 style="text-align: center;">Contact List</h1>
        <header class='sticky'>
            <div class="border flex-container spaced">
                <button class="center" id="addButton" onclick="reveal()">Add a contact</button>
                <button class="center hidden" id="cancel" type="button" onclick="event.preventDefault(); hide();">Cancel</button>

                <div>
                    <input type="text" id="search" name="search" placeholder="Search for a contact" oninput="search()">
                    <button id="clear" onclick="clearSearch()">Clear</button>
                </div>
            </div>

            <div class="flex-container">
                <form class="border center hidden" id="addContact" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" onsubmit="return validateForm()">
                    <div>
                        <label for="identity">ID:</label>
                        <input type="text" id="identity" name="identity" oninput="validateId()" required><br />
                        <span class="error-message" id="idError"></span>
                        <br />
                    </div>

                    <div>
                        <label for="firstName">First Name:</label>
                        <input type="text" id="firstName" name="firstName" oninput="validateName()" required><br />
                        <span class="error-message" id="firstNameError"></span>
                        <br />
                    </div>

                    <div>
                        <label for="lastName">Last Name:</label>
                        <input type="test" id="lastName" name="lastName" oninput="validateName()" required><br />
                        <span class="error-message" id="lastNameError"></span>
                        <br />
                    </div>

                    <div>
                        <label for="email">Email Address:</label>
                        <input type="email" id="email" name="email" oninput="validateEmail()" required><br />
                        <span class="error-message" id="emailError"></span>
                        <br />
                    </div>

                    <div>
                        <label for="contact">Contact Number:</label>
                        <input type="tel" id="contact" name="contact" oninput="validateContact()"><br />
                        <span class="error-message" id="contactError"></span>
                        <br />
                    </div>

                    <input type="submit" value="Submit">
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
                        }
                    ?>
                </form>
            </div>
        </header>
        <table class="center collapse">
            <tr>
                <!-- It would certainly be better to make the arrows change direction whenever they are pressed, alongside changing their function. -->
                <th>ID <a id="id_asc" class="no-underline" href="index.php?sort=id&direction=asc">⬆️</a>
                    <a id="id_des" class="no-underline" href="index.php?sort=id&direction=desc">⬇️</a></th>
                <th>Last Name <a id="lastName_asc" class="no-underline" href="index.php?sort=lastname&direction=asc" >⬆️</a>
                    <a id="lastName_des" class="no-underline" href="index.php?sort=lastname&direction=desc" >⬇️</a></th>
                <th>First Name <a id="firstName_asc" class="no-underline" href="index.php?sort=firstname&direction=asc">⬆️</a>
                    <a id="firstName_des" class="no-underline" href="index.php?sort=firstname&direction=desc">⬇️</a></th>
                <th>Email Address <a id="email_asc" class="no-underline" href="index.php?sort=email&direction=asc">⬆️</a>
                    <a id="email_des" class="no-underline" href="index.php?sort=email&direction=desc">⬇️</a></th>
                <th>Contact Number <a class="no-underline" href="index.php?sort=contact&direction=asc">⬆️</a>
                    <a class="no-underline" href="index.php?sort=contact&direction=desc">⬇️</a></th>
            </tr>
            <!-- Interesting thought is to add pagination, but that was not the initial plan. Still, it would be useful to try experimenting with another application someday. -->
            <?php
                /*
                // Connect to the database
                $conn = new mysqli('localhost', 'root', '', 'test');

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Define the number of results per page
                $results_per_page = 10;

                // Find out the number of results stored in database
                $sql='SELECT * FROM contact_list';
                $result = $conn->query($sql);
                $number_of_results = $result->num_rows;

                // Determine the total number of pages available
                $number_of_pages = ceil($number_of_results/$results_per_page);

                // Determine which page number visitor is currently on
                if (!isset($_GET['page'])) {
                    $page = 1;
                } else {
                    $page = $_GET['page'];
                }

                // Determine the sql LIMIT starting number for the results on the displaying page
                $this_page_first_result = ($page-1)*$results_per_page;

                // Retrieve selected results from database and display them on page
                $sql='SELECT * FROM contact_list LIMIT ' . $this_page_first_result . ',' .  $results_per_page;
                $result = $conn->query($sql);

                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["id"]. "</td><td>" . $row["lastname"]. "</td><td>" . $row["firstname"]. "</td><td>" . $row["email"]. "</td><td>" . $row["contact"]. "</td></tr>";
                }

                // Display the links to the pages
                for ($page=1;$page<=$number_of_pages;$page++) {
                    echo '<a href="index.php?page=' . $page . '">' . $page . '</a> ';
                }

                $conn->close();
                */
                // Connect to the database
                $conn = new mysqli('localhost', 'root', '', 'test');

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // SQL query to select all records from the table
                $sql = "SELECT id, firstname, lastname, email, contact FROM contact_list";

                // Check if sort query parameter is set
                if (isset($_GET['sort'])) {
                    $sql .= " ORDER BY " . $_GET['sort'];

                    if (isset($_GET['direction']) && $_GET['direction'] == 'desc') {
                        $sql .= " DESC";
                    } else {
                        $sql .= " ASC";
                    }
                }

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $padded_id = str_pad($row['id'], 8, '0', STR_PAD_LEFT); 
                        echo "<tr>";
                        echo "<td>" . $padded_id . "</td>";
                        echo "<td>" . $row['lastname'] . "</td>";
                        echo "<td>" . $row['firstname'] . "</td>";
                        echo "<td>" . $row['email'] . "</td>";
                        echo "<td>" . $row['contact'] . "</td>";
                        // Add a new cell with a delete button
                        echo "<td>";
                        echo "<form method='POST' action='delete.php'>";
                        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                        echo "<input type='submit' value='Delete'>";
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                        // Add a new cell with an update button
                        echo "<td>";
                        echo "<form method='POST' action='update.php'>";
                        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                        echo "<input type='submit' value='Update'>";
                        echo "</form>";
                        echo "</td>";
                    }
                }
                $conn->close();
            ?>
        </table>
    </body>
</html>
