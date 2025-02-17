<?php
// Include database connection
include('../db_connection.php');

// Start session
session_start();
if (isset($_SESSION['user_data'])) {
    unset($_SESSION['user_data']);
}

$error_message = ''; // Variable to hold error messages

// Define lockout period (10 minutes)
define('LOCKOUT_TIME', 600); // 10 minutes in seconds (600)

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if a login attempt is in progress
    $_SESSION['login_attempted'] = true;

    // Get and sanitize user input
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check if the account is locked (based on failed attempts)
    if (isset($_SESSION['failed_attempts']) && $_SESSION['failed_attempts'] >= 3) {
        $time_since_last_failed = time() - $_SESSION['last_failed_attempt'];

        // If less than 10 minutes have passed since the last failed attempt, lock account
        if ($time_since_last_failed < LOCKOUT_TIME) {
            $lockout_time = LOCKOUT_TIME - $time_since_last_failed;
            $minutes_left = ceil($lockout_time / 60); // Get minutes remaining
            $error_message = "Your account is locked due to multiple failed login attempts. Please try again in $minutes_left minutes.";
            $error_color = 'red'; // Lock message in red color
        } else {
            // Reset failed attempts after lockout period has passed
            $_SESSION['failed_attempts'] = 0;
            unset($_SESSION['last_failed_attempt']);
        }
    }

    if (empty($error_message)) {
        // Query to verify email and password
        $query = "SELECT * FROM members WHERE email = '$email' AND password = '$password'";
        $result = mysqli_query($conn, $query);

        if (
            mysqli_num_rows($result) == 1
        ) {
            // Fetch user details
            $user = mysqli_fetch_assoc($result);

            // Create an associative array to store user details
            $user_data = [
                'user_id' => $user['id'],
                'email' => $user['email'],
                'username' => $user['name'],
                'usertype' => $user['usertype'],
                'subscription' => $user['subscription'] // Add subscription status here
            ];

            // Store user details in session variable as an associative array
            $_SESSION['user_data'] = $user_data;

            // Reset failed attempts on successful login
            $_SESSION['failed_attempts'] = 0;

            // Check usertype and subscription status for redirection
            if ($user['usertype'] == 0) {
                // Redirect to admin dashboard
                header('Location: ../admin/dashboard.php');
            } elseif ($user['usertype'] == 1) {
                if ($user['subscription'] == 0) {
                    // Redirect to index.php if user is subscribed = 0
                    header('Location: index.php');
                } else {
                    // Redirect to home.php if user is subscribed = 1
                    header('Location: home.php');
                }
            }
            exit;
        } else {
            // Increment failed attempts and update last failed attempt timestamp
            $_SESSION['failed_attempts'] = isset($_SESSION['failed_attempts']) ? $_SESSION['failed_attempts'] + 1 : 1;
            $_SESSION['last_failed_attempt'] = time();

            $error_message = "Invalid email or password.";
            $error_color = 'red'; // Error message in red color
        }
    }
} else {
    // If the page is not being refreshed, reset the login attempted flag
    if (!isset($_SESSION['login_attempted'])) {
        // Reset failed attempts and last failed attempt on a fresh page load
        $_SESSION['failed_attempts'] = 0;
        unset($_SESSION['last_failed_attempt']);
    }

    // Reset the login_attempted flag to allow for future attempts
    unset($_SESSION['login_attempted']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>

<body>
    <div class="login-container">
        <h2>Welcome Back</h2>
        <h1>Login</h1>
        <form method="POST" action="">
            <label for="email">Email address</label>
            <input type="email" id="email" name="email" placeholder="Email address" required>
            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Password" required>

            <!-- Show the error message for invalid credentials in red color -->
            <?php if (!empty($error_message) && $error_color == 'red') : ?>
                <p class="error red"><?= $error_message ?></p>
            <?php endif; ?>

            <!-- Show failed attempt count and last failed attempt time in orange color -->
            <?php if (isset($_SESSION['failed_attempts']) && $_SESSION['failed_attempts'] >= 1 && !isset($lockout_time)) : ?>
                <p class="info">Failed login attempts: <?= $_SESSION['failed_attempts'] ?></p>
            <?php endif; ?>

            <!-- Show last failed attempt time in orange color -->
            <?php if (isset($_SESSION['last_failed_attempt'])) : ?>
                <p class="info">Last failed attempt: <?= date("Y-m-d H:i:s", $_SESSION['last_failed_attempt']) ?></p>
            <?php endif; ?>

            <div class="signup-link">
                <p>Don’t have an account? <a href="signup.php">Sign up</a></p>
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
</body>

</html>