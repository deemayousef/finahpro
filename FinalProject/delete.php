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
    // Delete the record from the database
    $sql = "DELETE FROM users WHERE id = '$id'";
    $result = mysqli_query($connection, $sql);

    if ($result) {
        header("Location: home.php");
        exit;
    } else {
        $deleteError = "Failed to delete the record. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Delete Record</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
    <div class="container">
        <h2>Delete Record</h2>
        <p>Are you sure you want to delete this record?</p>
        <table>
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                </tr>
            </tbody>
        </table>
        <?php if (isset($deleteError)) : ?>
            <div><?php echo $deleteError; ?></div>
        <?php endif; ?>
        <form method="post" action="">
            <button type="submit">Delete</button>
            <a href="home.php">Cancel</a>
        </form>
    </div>
</body>

</html>
