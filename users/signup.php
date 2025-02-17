<?php
// Include the database connection file
include '../db_connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize form data
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirmPassword = mysqli_real_escape_string($conn, $_POST['confirm-password']);

    // Check if passwords match
    if ($password !== $confirmPassword) {
        echo "<script>alert('Passwords do not match!');</script>";
    } else {
        // Insert data into the database without hashing the password
        $sql = "INSERT INTO members (name, email, phNo, password, usertype, subscription)
                VALUES ('$username', '$email', '$phone', '$password', 1, 0)";

        if (mysqli_query($conn, $sql)) {
            echo "<script>alert('Account created successfully!'); window.location.href = 'login.php';</script>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-Up Form</title>
    <link rel="stylesheet" href="css/signup.css">
</head>

<body>
    <div class="signup-container">
        <a href="login.php" class="go-back">
            <span class="go-back-icon">&#8592;</span> Go Back
        </a>
        <h2>Please enter your details</h2>
        <h1>Create an account</h1>
        <form method="POST" action="signup.php">
            <label for="username">Enter Your Username</label>
            <input type="text" id="username" name="username" placeholder="Enter Your Username" required>
            <label for="email">Enter Your Email</label>
            <input type="email" id="email" name="email" placeholder="Enter Your Email" required>
            <label for="phone">Enter Your Phone Number</label>
            <input type="tel" id="phone" name="phone" placeholder="Enter Your Phone Number" required>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Password" required>
            <label for="confirm-password">Confirm Password</label>
            <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm Password" required>
            <button type="submit">Create Account</button>
        </form>
    </div>
</body>

</html>