<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sticky Navigation Bar</title>
    <link rel="stylesheet" href="css/navLogined.css">
</head>

<body>

    <nav class="navbar">
        <a href="#" class="logo">
            <img src="../uploads/AdobeStock_425055558.jpeg" alt="Logo">
            SMC
        </a>
        <ul class="menu">
            <li><a href="home.php">Home</a></li>
            <li><a href="socialMediaApp.php">Social Media Apps</a></li>
            <li><a href="informationPage.php">Information</a></li>
            <li><a href="howParentCanHelp.php">How Parents Can Help</a></li>
            <li><a href="livestreaming.php">Livestreaming</a></li>
            <li><a href="howToStaySafeOnline.php">How to Stay Safe Online</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="login.php">Logout</a></li>
        </ul>
        <!-- Hamburger Menu -->
        <div class="hamburger">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </nav>
    <?php require_once("heroSection.php") ?>

    <script>
    // Select the hamburger and menu
    const hamburger = document.querySelector('.hamburger');
    const menu = document.querySelector('.menu');

    // Check if the elements exist
    if (hamburger && menu) {
        hamburger.addEventListener('click', () => {
            console.log('Hamburger clicked!');
            menu.classList.toggle('active');
        });
    } else {
        console.error('Hamburger or menu not found!');
    }
    </script>
</body>

</html>