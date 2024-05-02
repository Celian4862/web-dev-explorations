<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Testing XSS</title>
        <style>
            body {
                background-color: black;
                color: white;
            }
        </style>
    </head>
    <body>
        <!-- Input localhost/web-dev-explorations/testing_XSS.php/%22%3E%3Cscript%3Ealert('XSS')%3C/script%3E -->
        <!-- Input: localhost/web-dev-explorations/testing_XSS.php/%22%3E%3Cscript%3Edocument.body.style.backgroundColor%20=%20%22red%22;%3C/script%3E -->
        <!-- Input: localhost/web-dev-explorations/testing_XSS.php/%22%3E%3Cscript%3Ewindow.onload%20=%20function()%20%7B%20document.getElementById('output').innerText%20=%20%22You're%20dead%20meat.%22;%20%7D;%3C/script%3E -->
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <input type="text" name="name" placeholder="Enter your name">
            <input type="submit" name="submit" value="Submit">
        </form>
        <p id="output">Hello!</p>
    </body>
</html>
