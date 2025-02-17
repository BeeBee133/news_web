<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us Section</title>
    <link rel="stylesheet" href="css/informationPage.css">
</head>

<body>
    <?php
    session_start();
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
        <p>Your are here - InformationPage</p>
    </section>
    <!-- section -->
    <section class="mission">
        <h2>Our Mission</h2>
        <p>
            At Social Media Campaigns Ltd., we are dedicated to empowering teenagers with the knowledge and tools to
            navigate social media safely. Our platform provides valuable resources, tips, and campaigns to promote
            positive digital habits.
        </p>
    </section>

    <section class="vision">
        <h2>Our Vision</h2>
        <p>
            To create a safer digital environment for teenagers by empowering them with the knowledge, tools, and
            resources to navigate social media responsibly, fostering a generation that values online safety, positive
            interactions, and digital well-being.
        </p>
    </section>

    <section class="about">
        <h2>About Us</h2>
        <div class="about-container">
            <!-- First Column -->
            <div class="about-card">
                <div class="image-placeholder"><img
                        src="../uploads/meeting-question-concept-illustration_114360-19816.avif" alt="error Image">
                </div>
                <h3>What We Do</h3>
                <p> We create educational content, host workshops, and share tips on staying safe while using social
                    media. From identifying cyberbullying to protecting personal information, our platform is designed
                    to address the real challenges teenagers face in today’s digital age.</p>
            </div>

            <!-- Second Column -->
            <div class="about-card">
                <div class="image-placeholder">
                    <div class="image-placeholder"><img src="../uploads/download.jpg" alt="error Image">
                    </div>
                </div>
                <h3> Our Approach</h3>
                <p>Through engaging campaigns, interactive resources, and expert guidance, we focus on providing
                    practical tips for online safety. Whether it’s protecting personal data or recognizing online scams,
                    we are here to educate and empower.</p>
            </div>

            <!-- Third Column -->
            <div class="about-card">
                <div class="image-placeholder">
                    <div class="image-placeholder"><img
                            src="../uploads/6030076984893589eb4eea33_AdobeStock_337053704-1024x563.jpeg"
                            alt="error Image">
                    </div>
                </div>
                <h3>Stay Connected</h3>
                <p>Become a part of the SMC family. Sign up for our monthly newsletter to get the latest updates, safety
                    tips, and stories from teenagers who have successfully overcome online challenges. Together, we can
                    create a safer digital future.</p>
            </div>
        </div>
    </section>

    <section class="legislation">
        <h2>Legislation and Guidance</h2>
        <p>It is essential to understand the relevant legislation and best practices for online social media use. Below
            are key laws and guidance to promote safe and responsible behavior online:</p>

        <h3>Relevant Legislation</h3>
        <ul>
            <li><strong>General Data Protection Regulation (GDPR):</strong> Protects user privacy and governs the use of
                personal data online.</li>
            <li><strong>Children's Online Privacy Protection Act (COPPA):</strong> Ensures the safety of children under
                13 when using online platforms.</li>
            <li><strong>Defamation Act:</strong> Protects individuals from false or damaging statements made online.
            </li>
        </ul>

        <h3>Best Practice Guidance</h3>
        <ul>
            <li>Always review privacy settings on social media platforms to control who can view your content.</li>
            <li>Do not share personal information publicly, such as your home address or phone number.</li>
            <li>Report and block any accounts engaging in harassment or inappropriate behavior.</li>
            <li>Be mindful of the content you share and its impact on others.</li>
            <li>Regularly update passwords and use two-factor authentication for added security.</li>
        </ul>

        <p>By following these guidelines and adhering to the legislation, you can enjoy a safer and more secure online
            experience.</p>
    </section>

    <?php require_once("footer.php") ?>
</body>

</html>