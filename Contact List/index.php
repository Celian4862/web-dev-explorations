<!DOCTYPE html>
<html lang='en'>
    <head>
        <meta charset='UTF-8' name='viewport' content='width=device-width, initial-scale=1'>
        <title>Contact List</title>
        <link rel='stylesheet' type='text/css' href='style.css'>
        <script defer src='script.js'></script>
    </head>
    <body>
        <?php require 'createTable.php'; ?>
        <h1>Contact List</h1>
        <header class='sticky'>
            <div class='center'>
                <button class='block center' id='addButton' onclick='reveal()'>Add a contact</button>
                <button class='block center hidden' id='cancel' type='button' onclick='event.preventDefault(); hide();'>Cancel</button>
            </div>

            <div id='addContact' class='flex-container hidden' style='padding: 3%;'>
                <form class='center' action='<?php echo 'createRecord.php';?>' method='POST' onsubmit='return validateForm()'>
                    <div>
                        <label for='id'>ID:</label>
                        <input type='text' id='id' name='id' oninput='validateId()' required><br />
                        <span class='error-message' id='idError'></span>
                        <br />
                    </div>

                    <div>
                        <label for='firstName'>First Name:</label>
                        <input type='text' id='firstName' name='firstName' oninput='validateName()' required><br />
                        <span class='error-message' id='firstNameError'></span>
                        <br />
                    </div>

                    <div>
                        <label for='lastName'>Last Name:</label>
                        <input type='test' id='lastName' name='lastName' oninput='validateName()' required><br />
                        <span class='error-message' id='lastNameError'></span>
                        <br />
                    </div>

                    <div>
                        <label for='email'>Email Address:</label>
                        <input type='email' id='email' name='email' oninput='validateEmail()' required><br />
                        <span class='error-message' id='emailError'></span>
                        <br />
                    </div>

                    <div>
                        <label for='contact'>Contact Number:</label>
                        <input type='tel' id='contact' name='contact' oninput='validateContact()' required><br />
                        <span class='error-message' id='contactError'></span>
                        <br />
                    </div>

                    <input type='submit' value='Submit' class='block' style='margin: 2% auto;'>
                </form>
            </div>
        </header>
        <table class='center collapse'>
            <tr>
                <!-- It would certainly be better to make the arrows change direction whenever they are pressed, alongside changing their function. -->
                <th>ID <a id='id_asc' class='no-underline' href='index.php?sort=id&direction=asc'>⬆️</a>
                    <a id='id_des' class='no-underline' href='index.php?sort=id&direction=desc'>⬇️</a></th>
                <th>First Name <a id='firstName_asc' class='no-underline' href='index.php?sort=firstname&direction=asc'>⬆️</a>
                    <a id='firstName_des' class='no-underline' href='index.php?sort=firstname&direction=desc'>⬇️</a></th>
                <th>Last Name <a id='lastName_asc' class='no-underline' href='index.php?sort=lastname&direction=asc' >⬆️</a>
                    <a id='lastName_des' class='no-underline' href='index.php?sort=lastname&direction=desc' >⬇️</a></th>
                <th>Email Address <a id='email_asc' class='no-underline' href='index.php?sort=email&direction=asc'>⬆️</a>
                    <a id='email_des' class='no-underline' href='index.php?sort=email&direction=desc'>⬇️</a></th>
                <th>Contact Number <a class='no-underline' href='index.php?sort=contact&direction=asc'>⬆️</a>
                    <a class='no-underline' href='index.php?sort=contact&direction=desc'>⬇️</a></th>
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
                        echo "<tr>\n\t\t\t\t";
                        echo "<td>" . $padded_id . "</td>\n\t\t\t\t";
                        echo "<td>" . $row['firstname'] . "</td>\n\t\t\t\t";
                        echo "<td>" . $row['lastname'] . "</td>\n\t\t\t\t";
                        echo "<td>" . $row['email'] . "</td>\n\t\t\t\t";
                        echo "<td>" . $row['contact'] . "</td>\n\t\t\t\t";
                        // Add a new cell with an update button
                        echo "<td>\n\t\t\t\t\t";
                        echo "<form method='POST' action='update.php'>\n\t\t\t\t\t\t";
                        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>\n\t\t\t\t\t\t";
                        echo "<input type='submit' value='Update'>\n\t\t\t\t\t";
                        echo "</form>\n\t\t\t\t";
                        echo "</td>\n\t\t\t\t";
                        // Add a new cell with a delete button
                        echo "<td>\n\t\t\t\t\t";
                        echo "<form method='POST' action='delete.php'>\n\t\t\t\t\t\t";
                        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>\n\t\t\t\t\t\t";
                        echo "<input type='submit' value='Delete'>\n\t\t\t\t\t";
                        echo "</form>\n\t\t\t\t";
                        echo "</td>\n\t\t\t";
                        echo "</tr>\n\t\t\t";
                    }
                }
                $conn->close();
            ?>
        </table>
    </body>
</html>
