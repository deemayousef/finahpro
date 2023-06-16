<?php
session_start();
require_once 'config.php';

// Check if user is not logged in, redirect to login page
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
    $result = mysqli_query($connection, $sql);

    if ($result) {
        header("Location: home.php");
        exit;
    } else {
        $addError = "Failed to add the record. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Add Record</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
    <div class="container">
        <h2>Add Record</h2>
        <?php if (isset($addError)) : ?>
            <div><?php echo $addError; ?></div>
        <?php endif; ?>
        <form method="post" action="">
            <div>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Add</button>
            <a href="home.php">Cancel</a>
        </form>
    </div>
</body>

</html>
