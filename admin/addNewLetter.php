<?php
// Start the session to store messages

// Include database connection
include '../db_connection.php';

// Check if the form is submitted and process the data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['description']);

    // Handle file upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif']; // Allowed MIME types
        $fileType = mime_content_type($_FILES['image']['tmp_name']);

        if (in_array($fileType, $allowedTypes)) {
            // Generate a unique name for the image
            $imageName = time() . '_' . basename($_FILES['image']['name']);
            $imageTmp = $_FILES['image']['tmp_name'];
            $imagePath = '../uploads/' . $imageName;

            // Move the uploaded file to the uploads directory
            if (move_uploaded_file($imageTmp, $imagePath)) {
                // Insert data into the database
                $query = "INSERT INTO newsletters (title, image1, content) 
                          VALUES ('$title', '$imagePath', '$content')";
                if (mysqli_query($conn, $query)) {
                    // Set success message in session if the record is inserted
                    $_SESSION['success_message'] = "Newsletter added successfully!";
                    header("Location: " . $_SERVER['PHP_SELF']);
                    exit();
                } else {
                    $_SESSION['error_message'] = "Database error: " . mysqli_error($conn);
                }
            } else {
                $_SESSION['error_message'] = "Error uploading image.";
            }
        } else {
            // Display error message for invalid file type
            $_SESSION['error_message'] = "Only Image File Are allowed";
        }
    } else {
        // Display error message if no file is uploaded or an error occurs
        $_SESSION['error_message'] = "Only Image File Are allowed";
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
    <title>New Letters Add</title>
    <link rel="stylesheet" href="css/addNewLetter.css">
</head>

<body>
    <?php include 'admin_header.php'; ?>
    <?php include 'admin_nav.php'; ?>

    <div class="content">
        <h1>New Letters Add</h1>

        <?php
        // Display messages from the session
        if (isset($_SESSION['error_message'])) {
            echo '<div class="message error-message" id="message">' . $_SESSION['error_message'] . '</div>';
            unset($_SESSION['error_message']);
        }

        if (isset($_SESSION['success_message'])) {
            echo '<div class="message success-message" id="message">' . $_SESSION['success_message'] . '</div>';
            unset($_SESSION['success_message']);
        }
        ?>

        <form class="form-container" action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Upload Photo</label>
                <div class="image-upload">
                    <div class="image-preview" id="imagePreview">Image</div>
                    <input type="file" name="image" id="imageInput" accept="image/*" required>
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
                <button type="reset" class="btn btn-cancel" id="cancelBtn">Cancel</button>
                <button type="submit" class="btn btn-confirm">Confirm</button>
            </div>
        </form>
    </div>

    <script>
        // Hide message after 2 seconds
        setTimeout(function() {
            const message = document.getElementById('message');
            if (message) {
                message.classList.add('hidden');
            }
        }, 2000);

        // Preview image when selected
        document.getElementById('imageInput').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('imagePreview');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.style.backgroundImage = `url(${e.target.result})`;
                    preview.textContent = ''; // Clear the text inside the preview
                    preview.style.backgroundSize = 'cover'; // Ensure the image covers the box
                    preview.style.backgroundPosition = 'center'; // Center the image
                };
                reader.readAsDataURL(file);
            }
        });

        // Reset preview when cancel button is clicked
        document.getElementById('cancelBtn').addEventListener('click', function() {
            const preview = document.getElementById('imagePreview');
            preview.style.backgroundImage = ''; // Remove background image
            preview.textContent = 'Image'; // Reset the text
        });

        imageUpload.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                // Check if the selected file is an image
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreview.style.backgroundImage = 'url(' + e.target.result + ')';
                        imagePreview.textContent = '';
                    };
                    reader.readAsDataURL(file);
                } else {
                    alert('Only image files are allowed!');
                    resetPreview();
                }
            }
        });
    </script>
</body>

</html>