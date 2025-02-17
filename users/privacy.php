<!DOCTYPE html>
<html lang="en">
<?php
session_start();
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy</title>
    <link rel="stylesheet" href="css/privacy.css">
</head>

<body>
    <?php
    // Include the appropriate navigation based on user session
    if ($_SESSION['user_data']['subscription'] == 1) {
        // If the user is logged in, include navLogined.php
        require_once("navLogined.php");
    } else {
        // If the user is not logged in, include nav.php
        require_once("nav.php");
    }
    ?>
    <!-- Location-shower Section -->
    <section class="location-shower">
        <p>Your are here - Privacy & Policy Page</p>
    </section>
    <div class="container">
        <h1>Privacy Policy</h1>
        <p>Your privacy is important to us. This Privacy Policy explains how we collect, use, and protect your
            information.</p>

        <h2>Information We Collect</h2>
        <p>We may collect personal information such as your name, email address, and other contact details when you use
            our services.</p>

        <h2>How We Use Your Information</h2>
        <p>We use your information to provide and improve our services, communicate with you, and comply with legal
            obligations.</p>

        <h2>Sharing Your Information</h2>
        <p>We do not share your personal information with third parties except as necessary to provide our services or
            as required by law.</p>

        <h2>Your Rights</h2>
        <p>You have the right to access, update, or delete your personal information. Contact us if you wish to exercise
            these rights.</p>

    </div>
    <?php require_once("footer.php") ?>
</body>