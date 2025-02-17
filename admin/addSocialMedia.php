<?php
// Start the session to store messages


// Include database connection
include '../db_connection.php';

// Check if form is submitted and process the data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $loginlink = mysqli_real_escape_string($conn, $_POST['loginlink']);
    $privacylink = mysqli_real_escape_string($conn, $_POST['privacylink']);

    // Handle file upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif']; // Allowed MIME types
        $fileType = mime_content_type($_FILES['image']['tmp_name']);

        if (in_array($fileType, $allowedTypes)) {
            // Generate unique name for the image
            $imageName = time() . '_' . basename($_FILES['image']['name']);
            $imageTmp = $_FILES['image']['tmp_name'];
            $imagePath = '../uploads/' . $imageName;

            // Move the uploaded file to the uploads directory
            if (move_uploaded_file($imageTmp, $imagePath)) {
                // Insert data into the database
                $query = "INSERT INTO socialmediaapp (name, loginlink, privacylink, image) 
                          VALUES ('$name', '$loginlink', '$privacylink', '$imagePath')";
                if (mysqli_query($conn, $query)) {
                    // Set success message in session if the record is inserted
                    $_SESSION['success_message'] = "Social Media added successfully!";
                    header("Location: " . $_SERVER['PHP_SELF']);
                    exit();
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
            } else {
                $_SESSION['error_message'] = "Error uploading image.";
                header("Location: " . $_SERVER['PHP_SELF']);
                exit();
            }
        } else {
            // Display error message for invalid file type
            $_SESSION['error_message'] = "Only image files (JPEG, PNG, GIF) are allowed!";
            header("Location: " . $_SERVER['PHP_SELF']);
            exit();
        }
    } else {
        // Display error message if no file is uploaded or an error occurs
        $_SESSION['error_message'] = "Please upload a valid image file.";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
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
    <title>Social Media Add</title>
    <link rel="stylesheet" href="css/addHowParentsCanHelpPage.css">
</head>

<body>
    <!-- Include Admin Header and Navigation -->
    <?php include 'admin_header.php'; ?>
    <?php include 'admin_nav.php'; ?>

    <div class="content">
        <h1>Social Media Add</h1>
        <!-- Form for data submission -->
        <form class="form-container" action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Upload Photo</label>
                <div class="image-upload">
                    <div class="image-preview">Image</div>
                    <input type="file" id="image-upload" name="image" accept="image/*" style="border:none;" required>
                </div>
            </div>
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" placeholder="Name" id="name" required>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Login Link</label>
                    <input type="text" name="loginlink" placeholder="Link" id="login-link" required>
                </div>
                <div class="form-group">
                    <label>Privacy Link</label>
                    <input type="text" name="privacylink" placeholder="Link" id="privacy-link" required>
                </div>
            </div>
            <div class="button-group">
                <button type="reset" class="btn btn-cancel">Cancel</button>
                <button type="submit" class="btn btn-confirm" id="confirm-button">Confirm</button>
            </div>
        </form>

        <?php
        // Display messages from the session
        if (isset($_SESSION['error_message'])) {
            echo '<div class="error-message">' . $_SESSION['error_message'] . '</div>';
            unset($_SESSION['error_message']);
        }

        if (isset($_SESSION['success_message'])) {
            echo '<div class="success-message">' . $_SESSION['success_message'] . '</div>';
            unset($_SESSION['success_message']);
        }
        ?>
    </div>

    <script>
        // Function to fade out success message
        function fadeOutMessage() {
            var successMessage = document.querySelector('.success-message');
            if (successMessage) {
                successMessage.classList.add('fade-out'); // Apply the fade-out class
                setTimeout(function() {
                    successMessage.remove(); // Remove the success message from the DOM after fade-out
                }, 1000); // Delay for fade-out to finish before removal
            }
        }

        // Function to fade out error message
        function fadeOutErrorMessage() {
            var errorMessage = document.querySelector('.error-message');
            if (errorMessage) {
                errorMessage.classList.add('fade-out'); // Apply the fade-out class
                setTimeout(function() {
                    errorMessage.remove(); // Remove the error message from the DOM after fade-out
                }, 1000); // Delay for fade-out to finish before removal
            }
        }

        // Delay fade-out for success message after 2 seconds
        setTimeout(fadeOutMessage, 2000); // Adjust time as per preference (in milliseconds)

        // Handle image file validation and display error message when user clicks "Confirm"
        document.getElementById('confirm-button').addEventListener('click', function(event) {
            var fileInput = document.getElementById('image-upload');
            var file = fileInput.files[0];
            var errorContainer = document.querySelector('.error-message');

            // Check if the file is selected and valid (image file)
            if (file && !file.type.startsWith('image/')) {
                event.preventDefault(); // Prevent form submission
                if (!errorContainer) {
                    errorContainer = document.createElement('div');
                    errorContainer.className = 'error-message';
                    document.body.appendChild(errorContainer);
                }

                // Display error message for invalid file type
                errorContainer.style.backgroundColor = '#f44336'; // Red for error
                errorContainer.textContent = 'Only image files are allowed!';

                // Fade in the error message
                errorContainer.style.opacity = '1';

                // Delay fade-out for error message after 3 seconds
                setTimeout(fadeOutErrorMessage, 3000); // Adjust time as per preference (in milliseconds)
            }
        });

        // Handle image file preview
        document.getElementById('image-upload').addEventListener('change', function(event) {
            var file = event.target.files[0];
            var imagePreview = document.querySelector('.image-preview');
            var errorContainer = document.querySelector('.error-message');

            // Reset the error message (if any)
            if (errorContainer) {
                errorContainer.remove();
            }

            // Check if the file is an image
            if (file && file.type.startsWith('image/')) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    // Set the image preview
                    imagePreview.style.backgroundImage = 'url(' + e.target.result + ')';
                    imagePreview.style.backgroundSize = 'cover';
                    imagePreview.innerHTML = ''; // Clear the "Image" text
                };
                reader.readAsDataURL(file);
            } else {
                // If file is not an image, show error message
                if (!errorContainer) {
                    errorContainer = document.createElement('div');
                    errorContainer.className = 'error-message';
                    document.body.appendChild(errorContainer);
                }

                errorContainer.style.backgroundColor = '#f44336'; // Red for error
                errorContainer.textContent = 'Only image files are allowed!';

                // Fade in the error message
                errorContainer.style.opacity = '1';

                // Delay fade-out for error message after 3 seconds
                setTimeout(fadeOutErrorMessage, 3000); // Adjust time as per preference (in milliseconds)
            }
        });

        // Reset image preview and input when "Cancel" button is clicked
        document.querySelector('.btn-cancel').addEventListener('click', function() {
            // Reset image preview
            var imagePreview = document.querySelector('.image-preview');
            imagePreview.style.backgroundImage = '';
            imagePreview.innerHTML = 'Image'; // Reset text

            // Reset file input
            document.getElementById('image-upload').value = '';
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