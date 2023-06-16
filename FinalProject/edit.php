<?php
session_start();
require_once 'config.php';

// Check if user is not logged in, redirect to login page
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

// Check if the record ID is provided
if (!isset($_GET['id'])) {
    header("Location: home.php");
    exit;
}

$id = $_GET['id'];

// Fetch the record from the database
$sql = "SELECT * FROM users WHERE id = '$id'";
$result = mysqli_query($connection, $sql);

if (!$result) {
    die("Error: " . mysqli_error($connection));
}

$row = mysqli_fetch_assoc($result);

if (!$row) {
    header("Location: home.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];

    // Update the record in the database
    $sql = "UPDATE users SET username = '$username', email = '$email' WHERE id = '$id'";
    $result = mysqli_query($connection, $sql);

    if ($result) {
        header("Location: home.php");
        exit;
    } else {
        $editError = "Update failed. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Record</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
    <div class="container">
        <h2>Edit Record</h2>
        <?php if (isset($editError)) : ?>
            <div><?php echo $editError; ?></div>
        <?php endif; ?>
        <form method="post" action="">
            <div>
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?php echo $row['username']; ?>" required>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required>
            </div>
            <button type="submit">Update</button>
            <a href="home.php">Cancel</a>
        </form>
    </div>
</body>

</html>
