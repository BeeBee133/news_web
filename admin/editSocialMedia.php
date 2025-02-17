<?php
include '../db_connection.php'; // Include the database connection

// Check if there's an ID passed in the URL (for editing an existing record)
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the existing social media platform data based on the ID
    $query = "SELECT * FROM socialmediaapp WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Check if a record exists
    if (mysqli_num_rows($result) == 1) {
        $platform = mysqli_fetch_assoc($result);
    } else {
        // Redirect if no record found
        header("Location: socialMedia.php");
        exit;
    }
} else {
    // Redirect if no ID is provided
    header("Location: socialMedia.php");
    exit;
}

// Handle form submission (updating the record)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $loginlink = $_POST['loginlink'];
    $privacylink = $_POST['privacylink'];

    // Handle the image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $imageName = basename($_FILES['image']['name']);
        $imagePath = "../uploads/" . $imageName;

        // Move the uploaded file to the uploads directory
        move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
    } else {
        // If no image uploaded, retain the old image
        $imageName = $platform['image'];
    }

    // Update the social media platform record in the database
    $updateQuery = "UPDATE socialmediaapp SET name = ?, loginlink = ?, privacylink = ?, image = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $updateQuery);
    mysqli_stmt_bind_param($stmt, 'ssssi', $name, $loginlink, $privacylink, $imagePath, $id);
    mysqli_stmt_execute($stmt);

    // Redirect back to the socialMedia.php page after successful update
    header("Location: socialMedia.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Social Media</title>
    <link rel="stylesheet" href="css/editSocialMedia.css">
</head>

<body>
    <?php include 'admin_header.php'; ?>
    <?php include 'admin_nav.php'; ?>

    <div class="content">
        <h1>Edit Social Media</h1>
        <form class="form-container" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Upload Photo</label>
                <div class="image-upload">
                    <div class="image-preview" id="imagePreview">
                        <img id="imagePreviewImg" src="../uploads/<?= $platform['image'] ?>" alt="Current Image" />
                    </div>
                    <input type="file" name="image" id="imageUpload" accept="image/*" onchange="previewImage(event)">
                </div>
            </div>
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" value="<?= $platform['name'] ?>" placeholder="Name" required>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Login Link</label>
                    <input type="text" name="loginlink" value="<?= $platform['loginlink'] ?>" placeholder="Link" required>
                </div>
                <div class="form-group">
                    <label>Privacy Link</label>
                    <input type="text" name="privacylink" value="<?= $platform['privacylink'] ?>" placeholder="Link" required>
                </div>
            </div>
            <div class="button-group">
                <a href="socialMedia.php"><button type="button" class="btn btn-cancel">Cancel</button></a>
                <button type="submit" class="btn btn-confirm">Confirm</button>
            </div>
        </form>
    </div>

    <script>
        function previewImage(event) {
            const input = event.target;
            const previewContainer = document.getElementById('imagePreview');
            const previewImage = document.getElementById('imagePreviewImg');

            const file = input.files[0];
            if (file) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    previewImage.src = e.target.result;
                    previewImage.style.display = 'block'; // Show the preview image
                };

                reader.readAsDataURL(file);
            } else {
                // If no file is selected, show the existing image
                previewImage.src = "../uploads/<?= $platform['image'] ?>";
                previewImage.style.display = 'block'; // Ensure the existing image is visible
            }
        }

        // Ensure the existing image is shown by default when the page loads
        window.onload = function() {
            const previewImage = document.getElementById('imagePreviewImg');
            if (previewImage.src) {
                previewImage.style.display = 'block'; // Show the existing image
            }
        };
    </script>
</body>

</html>

<?php
// Close the database connection
mysqli_close($conn);
?>