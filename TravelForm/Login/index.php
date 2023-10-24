<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login | Travel Notes</title>
    </head>
    <body>
        <h1>Login</h1><br>
        <h3>Enter User Details:</h3>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for='email'>Your Email:</label>
            <input name='email' id='email' type="email">
            <br>
            <label for='password'>Password:</label>
            <input name='password' id='password' type='password'>
            <br>
            <button type="submit" name="submit">Submit</button>
        </form>
    </body>
</html>