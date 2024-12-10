<?php
session_start();

// Wenn der Benutzer bereits eingeloggt ist, leite ihn zum Dashboard weiter
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - ToDo App</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Registrieren</h1>
        <form action="auth.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="register">Registrieren</button>
        </form>
        <p>Du hast bereits einen Account? <a href="login.php">Hier einloggen</a>.</p>
    </div>
</body>
</html>
