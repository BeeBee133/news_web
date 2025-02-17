<?php
require_once("../db_connection.php"); // Include database connection
session_start();
// Fetch articles from the database
$query = "SELECT * FROM howparentcanhelp";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

?>
<?php
// Get the user ID from the session
$user_id = intval($_SESSION['user_data']['user_id']);

// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['subscribe'])) {
    // Update the subscription status in the database
    $query = "UPDATE members SET subscription = 1 WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            // Subscription updated successfully
            $message = "User has been successfully subscribed!";
        } else {
            $message = "Failed to update subscription. Please try again.";
        }

        mysqli_stmt_close($stmt);
    } else {
        die("Database error: " . mysqli_error($conn));
    }

    mysqli_close($conn);
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learning to Grow Together</title>
    <link rel="stylesheet" href="css/index.css">
</head>

<body>
    <?php require_once("nav.php") ?>
    <!-- Location-shower Section -->
    <section class="location-shower">
        <p>Your are here - Home Page</p>
    </section>

    <!-- Operation Section -->
    <section id="operation-section" class="operation-section">
        <div class="operation-container">
            <label for="read-to">Read To - </label>
            <select id="dropdown" name="read-to" onchange="navigateToLink()">
                <option value="services">Services</option>
                <option value="howParentsSections">How Parent Can Help</option>
                <option value="tips-section">Tips-section</option>
                <option value="newsletters">Newsletters</option>
                <option value="teen-brain">Teen-brain and Social Media</option>
            </select>
            <div class="operation-search-box">
                <input type="text" id="search" name="search" placeholder="Search...">
                <button class="search-btn">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            <button class="search-now-btn">Search Now</button>
        </div>
    </section>

    <section class="services" id="services">
        <h1>Services</h1>
        <!-- <?php echo $_SESSION['user_data']['user_id'] ?> -->
        <div class="service-grid">
            <div class="service-box">
                <img src="../uploads/Social-Media-Safety.png" alt="Placeholder image representing the service provided">
                <h3>Social Media Safety Tips</h3>
                <p>Access valuable insights and strategies to protect your privacy and avoid risks on social media
                    platforms.</p>
            </div>
            <div class="service-box">
                <img src="../uploads/interactWorkShop.webp" alt="Placeholder image representing the service provided">
                <h3>Interactive Workshops</h3>
                <p>Participate in engaging online sessions designed to teach you how to use social media
                    responsibly.
                </p>
            </div>
            <div class="service-box">
                <img src="../uploads/WhatsApp+Image+2023-05-02+at+1.07.56+PM.jpeg" alt="Placeholder image representing the service provided">
                <h3>Parental Guides</h3>
                <p>Explore resources to help parents support their teenagers in maintaining safe social media
                    habits.
                </p>
            </div>
            <div class="service-box">
                <img src="../uploads/images.png" alt="Placeholder image representing the service provided">
                <h3>Cybersecurity Basics</h3>
                <p>Learn fundamental cybersecurity practices to safeguard your personal information online.</p>
            </div>
            <div class="service-box">
                <img src="../uploads/64d1b1cb181c1b149ad39fab_get-course-blog-main-image-4.webp" alt="Placeholder image representing the service provided">
                <h3>Community Support</h3>
                <p> Join a community of like-minded individuals sharing tips and experiences for staying safe
                    online.
                </p>
            </div>
            <div class="service-box">
                <img src="../uploads/istockphoto-1131233305-612x612.jpg" alt="Placeholder image representing the service provided">
                <h3>Monthly Newsletter</h3>
                <p>Sign up to receive the latest updates, tips, and resources directly in your inbox every month..
                </p>
            </div>
        </div>
    </section>


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

    <section class="tips-section" id="tips-section">
        <h1>Tips for Safety Use</h1>
        <ul>
            <li><strong>Protect Your Personal Information:</strong>Never share sensitive details like your full name,
                home address, phone number, or financial information on social media platforms. Be cautious about
                oversharing even small details that could reveal more than you intended. This helps safeguard your
                privacy and prevent identity theft.</li>
            <li><strong>Use Strong Passwords: </strong>Always create passwords that are at least 12 characters long and
                include a mix of uppercase letters, lowercase letters, numbers, and special characters. Avoid using
                easily guessed passwords like birthdays or names. Enable two-factor authentication for an extra layer of
                security on your accounts.</li>
        </ul>

        <img src="../uploads/saftyTip.jpg" alt="Placeholder Image">

        <ul>
            <li><strong>Be Aware of Scams: </strong>Stay alert to phishing attempts through messages, emails, or fake
                profiles. Scammers may try to trick you into revealing personal information or clicking harmful links.
                Verify sources before taking any action online, especially with unsolicited offers or requests.</li>
            <li><strong>Adjust Privacy Settings: </strong>Regularly review and update the privacy settings on all your
                social media profiles. Limit who can view your posts and personal information to friends or trusted
                individuals only. This helps control your online visibility and protects you from strangers.</li>
            <li><strong>Think Before You Post:</strong> Understand that everything shared on social media can become
                public, even with privacy settings. Avoid posting anything you wouldn't want your parents, teachers, or
                future employers to see. Think critically about how your content reflects on you.</li>
        </ul>
    </section>

    <?php if (isset($message)) : ?>
        <script>
            alert('<?php echo $message; ?>');
        </script>
    <?php endif; ?>

    <section class="subscribe-plan" id="newsletters">
        <h1>Subscribe Plan</h1>
        <div class="plan-container">
            <div class="plan-box unsubscribe">
                <h2>Unsubscribe</h2>
                <ul>
                    <li>Limited Views</li>
                    <li>No New Letters</li>
                    <li>No Live Streaming</li>
                    <li>No How to Stay Safe Online</li>
                    <li>Don't allow contact with admin</li>
                </ul>
                <p class="price">Free</p>
            </div>
            <div class="plan-box subscribe">
                <h2>Monthly Subscribe</h2>
                <ul>
                    <li>Unlimited Views</li>
                    <li>New Letters</li>
                    <li>Live Streaming</li>
                    <li>How to Stay Safe Online</li>
                    <li>Allow contact with admin</li>
                </ul>
                <p class="price">10,000 MMK</p>
                <form method="POST" action="">
                    <input type="hidden" name="user_id" value="1"> <!-- Replace 1 with actual user ID -->
                    <button type="submit" name="subscribe" class="subscribe-button">Subscribe</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Teen Brain Section -->
    <section id="teen-brain" class="teen-brain-section">
        <h2>Teen Brain and The Social Media</h2>
        <div class="teen-brain-content">
            <div class="teen-brain-image">
                <img src="../uploads/06b1b8c5296a92feab0e6da02b6a9da4.jpg" alt="teen Brain Placeholder">
            </div>
            <div class="teen-brain-text">
                <ul>
                    <li>Adolescent Brain Sensitivity to Social Rewards: During adolescence, the brain becomes
                        particularly sensitive to social rewards like likes, comments, and shares, making social media
                        more engaging.</li>
                    <li>Cyberbullying and Mental Health Concerns: The rise of online bullying can cause significant
                        emotional harm to teens, leading to anxiety, depression, and a distorted self-image.</li>
                    <li>Online Personas vs. Real-Life Identity: Teens often craft idealized versions of themselves
                        online, which may lead to a disconnect between their real-life identity and digital persona.
                    </li>
                    <li>Impact of Social Media on Emotional Regulation: Social media interactions, particularly negative
                        ones, can trigger intense emotional responses, affecting teens’ ability to regulate feelings
                        like frustration and sadness.
                    </li>
                    <li>The Role of Social Media in Relationship Building: While social media can foster connections
                        with peers, it may also make it harder for teens to build meaningful, in-person relationships
                        due to over-reliance on digital communication.
                    </li>
                    <li>Distorted Reality and Unrealistic Expectations: Social media platforms often present a distorted
                        reality of success, beauty, and happiness, which can lead to unrealistic expectations for teens
                        about their lives.
                    </li>
                </ul>
            </div>
        </div>
    </section>



    <script>
        function navigateToLink() {
            var selectedOption = document.getElementById('dropdown').value;
            if (selectedOption) {
                // Change the URL hash to the selected section ID
                window.location.hash = selectedOption;
            }
        }
    </script>
    <?php require_once("footer.php") ?>

</body>

</html>