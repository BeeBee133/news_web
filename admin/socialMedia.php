<?php
include '../db_connection.php'; // Include the database connection

// Delete logic
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    // Delete the social media platform record from the database
    $deleteQuery = "DELETE FROM socialmediaapp WHERE id = ?";
    $stmt = mysqli_prepare($conn, $deleteQuery);
    mysqli_stmt_bind_param($stmt, 'i', $delete_id);
    mysqli_stmt_execute($stmt);

    // Redirect after deletion
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit;
}

// Fetch the social media platforms from the database
$query = "SELECT * FROM socialmediaapp";
$result = mysqli_query($conn, $query);

// Pagination logic
$maxRows = 6;
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$totalRows = mysqli_num_rows($result);
$totalPages = ceil($totalRows / $maxRows);
$startIndex = ($currentPage - 1) * $maxRows;

// Modify the query to limit the results based on pagination
$query .= " LIMIT $startIndex, $maxRows";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Social Media Control</title>
    <link rel="stylesheet" href="css/socialMedia.css">

</head>

<body>
    <?php include 'admin_header.php'; ?>
    <?php include 'admin_nav.php'; ?>

    <div class="content">
        <h1>Social Media Control</h1>
        <a href="addSocialMedia.php"><button class="add-new-btn">+ Add New</button></a>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Images</th>
                        <th>Name</th>
                        <th>Login Link</th>
                        <th>Privacy Link</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Display the rows fetched from the database
                    $index = $startIndex; // Track the correct index number
                    while ($platform = mysqli_fetch_assoc($result)) {
                        $imagePath = "../uploads/" . $platform['image']; // Adjust to the correct column for the image path
                        $imageUrl = file_exists($imagePath) ? $imagePath : "../uploads/default.jpg"; // Fallback to default image
                        echo "
                        <tr>
                            <td>" . (++$index) . "</td>
                            <td><img src='{$imageUrl}' alt='Image' style='width: 90px; height: 90px; border-radius: 4px;'></td>
                            <td>{$platform['name']}</td>
                            <td><a href='{$platform['loginlink']}' target='_blank'>{$platform['loginlink']}</a></td>
                            <td><a href='{$platform['privacylink']}' target='_blank'>{$platform['privacylink']}</a></td>
                            <td>
                                <a href='editSocialMedia.php?id={$platform['id']}'><button class='edit-btn'>Edit</button></a>
                                <a href='?delete_id={$platform['id']}' onclick='return confirm(\"Are you sure you want to delete this record?\");'>
                                    <button class='delete-btn'>Delete</button>
                                </a>
                            </td>
                        </tr>";
                    }

                    // Add empty rows if fewer than $maxRows
                    $emptyRows = $maxRows - mysqli_num_rows($result);
                    for ($i = 0; $i < $emptyRows; $i++) {
                        echo "
                        <tr>
                            <td style='height: 92px;'></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="pagination" style="margin-top: 15px;">
                <?php if ($currentPage > 1) : ?>
                    <a href="?page=<?= $currentPage - 1 ?>"><button>&lt; Prev</button></a>
                <?php endif; ?>
                <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                    <a href="?page=<?= $i ?>"><button <?= $i === $currentPage ? 'style="background-color: #002855; color: white;"' : '' ?>><?= $i ?></button></a>
                <?php endfor; ?>
                <?php if ($currentPage < $totalPages) : ?>
                    <a href="?page=<?= $currentPage + 1 ?>"><button>Next &gt;</button></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

</html>

<?php
// Close the database connection
mysqli_close($conn);
?>