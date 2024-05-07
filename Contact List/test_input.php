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