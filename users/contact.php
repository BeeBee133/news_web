<?php
// Include the database connection
require_once('../db_connection.php');

// Start session to use user data
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get user input from the form
    $phoneNumber = $_POST['phoneNumber'];
    $content = $_POST['content'];
    $userId = $_SESSION['user_data']['user_id'];  // Assuming user is logged in and user data is in session

    // Insert the data into the 'contact' table
    $sql = "INSERT INTO contact (user_id, phNo, content) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iss', $userId, $phoneNumber, $content);

    // Execute the query
    if ($stmt->execute()) {
        $message = "Your message has been sent successfully!";
        $messageClass = 'success';
    } else {
        $message = "There was an error sending your message. Please try again.";
        $messageClass = 'error';
    }

    // Close the prepared statement
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="css/contact.css">
</head>

<body>
    <?php require_once("navLogined.php") ?>
    <!-- Location-shower Section -->
    <section class="location-shower">
        <p>Your are here - Contact Page</p>
    </section>
    <div class="box">
        <h1>Contact Us</h1>
        <div class="contact-container">
            <div class="contact-box">
                <h2>Get in Touch</h2>
                <p>Contact our team</p>

                <!-- Display success or error message -->
                <?php if (isset($message)) : ?>
                <p class="<?php echo $messageClass; ?>"><?php echo $message; ?></p>
                <?php endif; ?>

                <!-- Contact form -->
                <form action="contact.php" method="post">
                    <input type="text" name="phoneNumber" placeholder="Phone Number" required>
                    <textarea name="content" placeholder="What can we help with?" rows="5" required></textarea>
                    <button type="submit">Send</button>
                </form>
                <p><a href="privacy.php">Our Privacy and Policy </a></p>
            </div>
        </div>
    </div>
    <?php require_once("footer.php") ?>

    <script>
    // Automatically fade out the success message after 2 seconds
    window.onload = function() {
        const successMessage = document.querySelector('.success-message');
        if (successMessage) {
            setTimeout(() => {
                successMessage.style.display = 'none';
            }, 2000); // 2 seconds
        }
    };
    </script>
</body>

</html>