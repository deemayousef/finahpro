<?php
session_start();
require_once 'config.php';

// Check if user is already logged in, redirect to home page
if (isset($_SESSION['username'])) {
    header("Location: home.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Handle uploaded picture
    $picture = $_FILES['picture'];
    $pictureName = $picture['name'];
    $pictureTmpName = $picture['tmp_name'];
    $pictureError = $picture['error'];

    if ($pictureError === UPLOAD_ERR_OK) {
        $pictureDestination = 'uploads/' . $pictureName;
        move_uploaded_file($pictureTmpName, $pictureDestination);
    } else {
        $pictureDestination = null; // Set default picture or handle error
    }

    $sql = "INSERT INTO users (username, email, password, picture) VALUES ('$username', '$email', '$password', '$pictureDestination')";
    $result = mysqli_query($connection, $sql);

    if ($result) {
        $_SESSION['username'] = $username;
        header("Location: home.php");
        exit;
    } else {
        $registerError = "Registration failed. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>

<body>
    <div class="container">
        <h2>Register</h2>
        <?php if (isset($registerError)) : ?>
            <div><?php echo $registerError; ?></div>
        <?php endif; ?>
        <form method="post" action="" enctype="multipart/form-data">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="file" name="picture" required>
            <button type="submit">Register</button>
        </form>
    </div>
</body>

</html>
