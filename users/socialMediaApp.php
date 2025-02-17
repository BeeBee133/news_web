<?php
require_once("../db_connection.php"); // Include database connection

// Fetch data from the socialmediaapp table
$query = "SELECT * FROM socialmediaapp";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Media Section</title>
    <link rel="stylesheet" href="css/socialMediaApp.css">
</head>

<body>
    <?php require_once("navLogined.php") ?>
    <section>
        <!-- Location-shower Section -->
        <section class="location-shower">
            <p>Your are here - Social Media Page</p>
        </section>
        <!-- social Media section -->
        <h2>Social Media</h2>
        <div class="social-media-container">
            <?php
            // Loop through each row in the result and create a card for each social media app
            while ($row = mysqli_fetch_assoc($result)) {
                // Escape any special characters for security
                $image_url = htmlspecialchars($row['image']);
                $login_link = htmlspecialchars($row['loginlink']);
                $privacy_link = htmlspecialchars($row['privacylink']);
                $name = htmlspecialchars($row['name']);

                echo '<div class="social-card">';
                // Set the image as the background for the image placeholder
                echo '<div class="image-placeholder" style="background-image: url(\'' . $image_url . '\');"></div>';
                echo '<h3>' . $name . '</h3>';
                // "Login" is static text, but the link will come from the database
                echo '<p>Login - <a href="' . $login_link . '" target="_blank">link</a></p>';
                echo '<p>Pravicy - <a href="' . $privacy_link . '" target="_blank">link</a></p>';
                echo '</div>';
            }
            ?>
        </div>
    </section>
    <?php require_once("footer.php") ?>
</body>

</html>

<?php
// Close the database connection
mysqli_close($conn);
?>