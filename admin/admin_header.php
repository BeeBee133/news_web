<!-- admin_header.php -->
<?php session_start() ?>

<link rel="stylesheet" href="css/admin_header.css">
<div class="header">
    <div class="logo">
        <span>Social Media Campaing (SMC)</span>
    </div>
    <div class="admin">
        <span>👤</span>
        <span>
            <?php
            // Display the username from session data if logged in
            if (isset($_SESSION['user_data']['username'])) {
                echo $_SESSION['user_data']['username'];
            } else {
                echo "Guest"; // Default text if no user data is found
            }
            ?>
        </span>
        <div style="width:50px;"></div>
    </div>
</div>