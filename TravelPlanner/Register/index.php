<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register | Travel Planner</title>
    </head>
    <body>
        <header><a href="../index.php">Travel Planner</a></header>
        <h1>Registration Form</h1>
        <h3>Enter Details:</h3>
        <form action="action.php" method="post">
            <label for="name">Name: </label>
            <input name="name" type="text" autofocus><br>
            <label for='email'>Email*: </label>
            <input name='email' id='email' type="email" required><br>
            <label for='password'>Password*: </label>
            <input name='password' id='password' type='password' required><br>
            <br>
            <button type="submit">Submit</button>
        </form>
    </body>
</html>