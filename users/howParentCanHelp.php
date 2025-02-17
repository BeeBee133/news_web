<?php
require_once("../db_connection.php"); // Include database connection

// Fetch articles from the database
$query = "SELECT * FROM howparentcanhelp";
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
    <title>How Parents Can Help</title>
    <link rel="stylesheet" href="css/howParentCanHelp.css">
</head>

<body>
    <?php require_once("navLogined.php") ?>
    <!-- Location-shower Section -->
    <section class="location-shower">
        <p>Your are here - How Parent Can Help Page</p>
    </section>
    <!-- howParentCanHelp Section -->
    <section class="howParentsSections">

        <h1>How Parent Can Help</h1>
        <?php
        // Loop through each article fetched from the database
        $index = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            // Set the class as "even" or "odd" based on the loop iteration
            $class = ($index % 2 === 0) ? "even" : "odd";

            // Display the article with the title above the image and paragraph
            echo "
            <div class='article $class'>
                <h2>" . htmlspecialchars($row['title']) . "</h2>
                <img src='" . htmlspecialchars($row['image']) . "' alt='Article Image'>
                <p>" . nl2br(htmlspecialchars($row['content'])) . "</p>
            </div>";

            $index++;
        }
        ?>
    </section>
    <?php require_once("footer.php") ?>
</body>

</html>

<?php
// Close the database connection
mysqli_close($conn);
?>