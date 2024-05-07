<?php
    $conn = mysqli_connect("localhost", "root", "", "test");
    $id = $_GET['id'];

    $checkIdQuery = "SELECT id FROM contact_list WHERE id = $id";
    $result = mysqli_query($conn, $checkIdQuery);

    if (mysqli_num_rows($result) > 0) {
        echo "exists";
    } else {
        echo "not_exists";
    }