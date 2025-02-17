<?php
// Start session for messages


// Include database connection
include '../db_connection.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    // Handle file upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        $fileType = mime_content_type($_FILES['image']['tmp_name']);

        if (in_array($fileType, $allowedTypes)) {
            $imageName = time() . '_' . basename($_FILES['image']['name']);
            $imagePath = '../uploads/' . $imageName;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
                // Insert into database
                $query = "INSERT INTO howparentcanhelp (title, image, content) 
                          VALUES ('$title', '$imagePath', '$description')";
                if (mysqli_query($conn, $query)) {
                    $_SESSION['success_message'] = "Newsletter added successfully!";
                    header("Location: " . $_SERVER['PHP_SELF']);
                    exit();
                } else {
                    $_SESSION['error_message'] = "Database error: " . mysqli_error($conn);
                }
            } else {
                $_SESSION['error_message'] = "Error uploading the image.";
            }
        } else {
            $_SESSION['error_message'] = "Invalid file type. Only JPEG, PNG, and GIF are allowed.";
        }
    } else {
        $_SESSION['error_message'] = "Please upload an image.";
    }
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>How Parents Can Help Add</title>
    <link rel="stylesheet" href="css/addHowParentsCanHelpPage.css">
</head>

<body>
    <?php include 'admin_header.php'; ?>
    <?php include 'admin_nav.php'; ?>

    <div class="content">
        <h1>How Parents Can Help Add</h1>

        <?php
        // Success message banner
        if (isset($_SESSION['success_message'])) {
            echo '<div class="success-banner" id="success-banner">' . $_SESSION['success_message'] . '</div>';
            unset($_SESSION['success_message']);
        }
        ?>

        <form class="form-container" action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Upload Photo</label>
                <div class="image-upload">
                    <div class="image-preview" id="image-preview">Image</div>
                    <input type="file" name="image" id="image-upload" accept="image/*" required>
                </div>
            </div>
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" placeholder="Title" required>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" rows="5" placeholder="Description" required></textarea>
            </div>
            <div class="button-group">
                <button type="reset" class="btn btn-cancel">Cancel</button>
                <button type="submit" class="btn btn-confirm">Confirm</button>
            </div>
        </form>

        <?php
        // Error message
        if (isset($_SESSION['error_message'])) {
            echo '<div class="error-message">' . $_SESSION['error_message'] . '</div>';
            unset($_SESSION['error_message']);
        }
        ?>
    </div>

    <script>
        // JavaScript for image preview
        document.getElementById('image-upload').addEventListener('change', function(event) {
            var file = event.target.files[0];
            var imagePreview = document.getElementById('image-preview');

            if (file && file.type.startsWith('image/')) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.style.backgroundImage = 'url(' + e.target.result + ')';
                    imagePreview.style.backgroundSize = 'cover';
                    imagePreview.textContent = '';
                };
                reader.readAsDataURL(file);
            } else {
                imagePreview.style.backgroundImage = '';
                imagePreview.textContent = 'Image';
            }
        });

        // JavaScript for fading out success banner
        window.onload = function() {
            const successBanner = document.getElementById('success-banner');
            if (successBanner) {
                setTimeout(() => {
                    successBanner.style.opacity = '0';
                    setTimeout(() => successBanner.remove(), 1000); // Remove after fade-out
                }, 2000);
            }
        };
    </script>
</body>

</html>