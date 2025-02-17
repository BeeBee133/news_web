<?php
// Include database connection
include '../db_connection.php';

// Get the newsletter ID from the URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Fetch the newsletter details
$query = "SELECT title, content, image1 FROM newsletters WHERE id = $id";
$result = mysqli_query($conn, $query);
$newsletter = mysqli_fetch_assoc($result);

if (!$newsletter) {
    echo "Newsletter not found!";
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $imageName = $newsletter['image1']; // Current image

    // Check if a new image is uploaded
    if (isset($_FILES['image']['name']) && $_FILES['image']['name'] !== '') {
        // Get image name and move to uploads folder
        $imageName = basename($_FILES['image']['name']);
        $targetFile = "../uploads/" . $imageName;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            // Delete the old image if a new one was uploaded
            if (!empty($newsletter['image1']) && file_exists("../uploads/" . $newsletter['image1'])) {
                unlink("../uploads/" . $newsletter['image1']);
            }
        } else {
            echo "Error uploading image.";
            exit;
        }
    }

    // Update the newsletter in the database
    $updateQuery = "UPDATE newsletters SET title = '$title', content = '$description', image1 = '$targetFile' WHERE id = $id";
    if (mysqli_query($conn, $updateQuery)) {
        // Redirect back to the newLetter.php page
        header("Location: newLetter.php");
        exit;
    } else {
        echo "Error updating newsletter: " . mysqli_error($conn);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit New Letter</title>
    <link rel="stylesheet" href="css/editNewLetter.css">
</head>

<body>
    <?php include 'admin_header.php'; ?>
    <?php include 'admin_nav.php'; ?>

    <div class="content">
        <h1>Edit New Letter</h1>

        <form class="form-container" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Upload Photo</label>
                <div class="image-upload">
                    <div class="image-preview" id="imagePreview">
                        <?php if (!empty($newsletter['image1'])) : ?>
                            <img src="../uploads/<?= htmlspecialchars($newsletter['image1']); ?>" alt="Current Image" id="previewImage">
                        <?php else : ?>
                            Image
                        <?php endif; ?>
                    </div>
                    <input type="file" name="image" id="imageInput" accept="image/*">
                </div>
            </div>
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" value="<?= htmlspecialchars($newsletter['title']); ?>" placeholder="Title">
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" rows="5" placeholder="Description"><?= htmlspecialchars($newsletter['content']); ?></textarea>
            </div>
            <div class="button-group">
                <a href="newLetter.php"><button type="button" class="btn btn-cancel">Cancel</button></a>
                <button type="submit" class="btn btn-confirm">Confirm</button>
            </div>
        </form>
    </div>

    <script>
        // JavaScript to handle the image preview
        document.getElementById('imageInput').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('imagePreview');
            const reader = new FileReader();

            reader.onload = function(e) {
                const imgElement = document.createElement('img');
                imgElement.src = e.target.result;
                imgElement.style.width = '100%';
                imgElement.style.height = '100%';
                imgElement.style.objectFit = 'cover';
                preview.innerHTML = ''; // Clear the current content
                preview.appendChild(imgElement);
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>

</html>