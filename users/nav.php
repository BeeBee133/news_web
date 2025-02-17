<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Centered Navigation Bar</title>
    <link rel="stylesheet" href="css/nav.css">
</head>

<body>
    <nav class="navbar">
        <!-- Logo Section -->
        <div class="logo">
            <img src="../uploads/AdobeStock_425055558.jpeg" alt="Logo">
            <span>SMC</span>
        </div>

        <!-- Navigation Links Centered -->
        <ul class="nav-links">
            <li><a href="index.php">Home</a></li>
            <li><a href="informationPage.php">Information</a></li>
            <li><a href="login.php">Logout</a></li>
        </ul>

        <!-- Search Box on the Right -->
        <div class="search-box">
            <input type="text" placeholder="Search...">
            <button><i>🔍</i></button>
        </div>

        <!-- Hamburger Menu for mobile -->
        <div class="hamburger" id="hamburger">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </nav>

    <?php require_once("heroSection.php") ?>

    <script>
    const hamburger = document.getElementById('hamburger');
    const navLinks = document.querySelector('.nav-links');

    hamburger.addEventListener('click', () => {
        navLinks.classList.toggle('active');
    });
    </script>
</body>

</html>