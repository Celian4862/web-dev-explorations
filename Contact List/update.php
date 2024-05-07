<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="style.css">
        <script defer src="script.js"></script>
    </head>
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

        $id = $row['id']; // Needed later for validation
    ?>
    <body>
        <h1>Update Record</h1>
        <div class='flex-container' style='padding: 3%;'>
            <form class='center' action='save_update.php' method='POST' onsubmit='return validateForm()'>
                    <input type='hidden' id='id' name='id' value='<?php echo $row['id'] ?>'>

                <div>
                    <label for='firstName'>First Name:</label>
                    <input type='text' id='firstName' name='firstName' value='<?php echo $row['firstname'] ?>' oninput='validateName()' required><br />
                    <span class='error-message' id='firstNameError'></span>
                    <br />
                </div>

                <div>
                    <label for='lastName'>Last Name:</label>
                    <input type='test' id='lastName' name='lastName' value='<?php echo $row['lastname'] ?>' oninput='validateName()' required><br />
                    <span class='error-message' id='lastNameError'></span>
                    <br />
                </div>

                <div>
                    <label for='email'>Email Address:</label>
                    <input type='email' id='email' name='email' value='<?php echo $row['email'] ?>' oninput='validateEmail()' required><br />
                    <span class='error-message' id='emailError'></span>
                    <br />
                </div>

                <div>
                    <label for='contact'>Contact Number:</label>
                    <input type='tel' id='contact' name='contact' value='<?php echo $row['contact'] ?>' oninput='validateContact()' required><br />
                    <span class='error-message' id='contactError'></span>
                    <br />
                </div>
                <div class='flex-container spaced'>
                    <input type='button' value='Cancel' onclick='window.location.href="index.php"'>
                    <input type='submit' value='Submit'>
                </div>
            </form>
        </div>
    </body>
</html>