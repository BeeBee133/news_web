<?php
// Include the database connection
require '../db_connection.php';

// Check if the 'id' parameter exists in the URL and is numeric
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the existing record from the database
    $query = "SELECT * FROM howparentcanhelp WHERE id = ?";
    if ($stmt = mysqli_prepare($conn, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $item = mysqli_fetch_assoc($result);

        if (!$item) {
            echo "Record not found.";
            exit;
        }
        mysqli_stmt_close($stmt);
    }
} else {
    echo "Invalid ID.";
    exit;
}

// Handle the form submission for updating the record
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    // Handle the image upload if a new image is provided
    $image = $item['image']; // Keep the existing image if not updating
    if (!empty($_FILES['image']['name'])) {
        // Upload the new image
        $targetDir = "../uploads/";
        $targetFile = $targetDir . basename($_FILES['image']['name']);
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            $image = $_FILES['image']['name'];
            $image_patch = "../uploads/" . $image;
        }
    }

    // Update the record in the database
    $updateQuery = "UPDATE howparentcanhelp SET title = ?, image = ?, content = ? WHERE id = ?";
    if ($stmt = mysqli_prepare($conn, $updateQuery)) {
        mysqli_stmt_bind_param($stmt, "sssi", $title, $image_patch, $content, $id);
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Record updated successfully!'); window.location.href = 'howParentCanHelp.php';</script>";
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
        mysqli_stmt_close($stmt);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit How Parents Can Help</title>
    <link rel="stylesheet" href="css/editHowParentCanHelpPage.css">

    <script>
        // JavaScript to handle image preview
        function previewImage(input) {
            const file = input.files[0];
            const preview = document.querySelector('.image-preview');

            // Clear any existing image in the preview
            preview.innerHTML = '';

            if (file) {
                const img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                img.alt = 'Image Preview';
                img.style.width = '100%';
                img.style.height = '100%';
                img.style.objectFit = 'cover';
                preview.appendChild(img);
            } else {
                preview.innerHTML = 'No Image'; // Show default text if no file selected
            }
        }
    </script>
</head>

<body>
    <?php include 'admin_header.php'; ?>
    <?php include 'admin_nav.php'; ?>

    <div class="content">
        <h1>Edit How Parents Can Help</h1>
        <form class="form-container" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label>Upload Photo</label>
                <div class="image-upload">
                    <div class="image-preview">
                        <?php
                        if (!empty($item['image'])) {
                            echo "<img src='../uploads/{$item['image']}' alt='Image'>";
                        } else {
                            echo "No Image";
                        }
                        ?>
                    </div>
                    <input type="file" name="image" onchange="previewImage(this)">
                </div>
            </div>
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" value="<?= htmlspecialchars($item['title']) ?>" required>
            </div>
            <div class="form-group">
                <label>Description</label>
                <textarea rows="5" name="content" required><?= htmlspecialchars($item['content']) ?></textarea>
            </div>
            <div class="button-group">
                <a href="howParentCanHelp.php"><button type="button" class="btn btn-cancel">Cancel</button></a>
                <button type="submit" class="btn btn-confirm">Confirm</button>
            </div>
        </form>
    </div>
</body>

</html>