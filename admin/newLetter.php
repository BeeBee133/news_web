<?php
// Include database connection
include '../db_connection.php';

// Handle delete request
if (isset($_GET['delete_id'])) {
    $id = (int)$_GET['delete_id']; // Sanitize the ID input

    // Fetch the image name before deleting from the database (to delete the image file too)
    $query = "SELECT image1 FROM newsletters WHERE id = $id";
    $result = mysqli_query($conn, $query);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $imageName = $row['image1'];

        // Delete the newsletter from the database
        $deleteQuery = "DELETE FROM newsletters WHERE id = $id";
        if (mysqli_query($conn, $deleteQuery)) {
            // If the image exists, delete it from the server
            if ($imageName && file_exists("../uploads/" . $imageName)) {
                unlink("../uploads/" . $imageName);
            }

            // Redirect to the control panel after deletion
            header("Location: newLetter.php");
            exit();
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }
    } else {
        echo "Error fetching image data: " . mysqli_error($conn);
    }
}

// Fetch data from database
$query = "SELECT id, title, image1, content, DATE_FORMAT(publisheddate, '%d-%m-%Y') AS formatted_date FROM newsletters";
$result = mysqli_query($conn, $query);

$items = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $items[] = $row;
    }
} else {
    echo "Error fetching data: " . mysqli_error($conn);
}

// Pagination
$maxRows = 5;
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$totalRows = count($items);
$totalPages = ceil($totalRows / $maxRows);
$startIndex = ($currentPage - 1) * $maxRows;
$currentData = array_slice($items, $startIndex, $maxRows);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Letters Control</title>
    <link rel="stylesheet" href="css/newLetter.css">
</head>

<body>
    <?php include 'admin_header.php'; ?>
    <?php include 'admin_nav.php'; ?>

    <div class="content">
        <h1>New Letters Control</h1>
        <a href="addNewLetter.php"><button class="add-new-btn">+ Add New</button></a>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Images</th>
                        <th>Title</th>
                        <th>Publish Date</th>
                        <th>Description</th>
                        <th class="action">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Render data
                    foreach ($currentData as $index => $item) {
                        echo "<tr>
                            <td>" . ($startIndex + $index + 1) . "</td>
                            <td>";
                        if (!empty($item['image1'])) {
                            echo "<img src='../uploads/" . htmlspecialchars($item['image1']) . "' alt='Newsletter Image' class='image-placeholder' style='width: 95px; height: 95px;'>";
                        } else {
                            echo "<div class='image-placeholder'>No Image</div>";
                        }
                        echo "</td>
                            <td>" . htmlspecialchars($item['title']) . "</td>
                            <td>" . htmlspecialchars($item['formatted_date']) . "</td>
                            <td style='width:500px;'>" . htmlspecialchars(substr($item['content'], 0, 50)) . "...</td>
                            <td>
                                <a href='editNewLetter.php?id=" . $item['id'] . "'><button class='edit-btn'>Edit</button></a>
                                <a href='newLetter.php?delete_id=" . $item['id'] . "' onclick='return confirm(\"Are you sure you want to delete this item?\");'>
                                    <button class='delete-btn'>Delete</button>
                                </a>
                            </td>
                        </tr>";
                    }

                    // Fill empty rows
                    $emptyRows = $maxRows - count($currentData);
                    for ($i = 0; $i < $emptyRows; $i++) {
                        echo "<tr>
                            <td style='height:95px'></td>
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

            <div class="pagination">
                <?php if ($currentPage > 1) : ?>
                    <a href="?page=<?= $currentPage - 1 ?>"><button>&lt;</button></a>
                <?php endif; ?>
                <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                    <a href="?page=<?= $i ?>"><button class="<?= $i === $currentPage ? 'active' : '' ?>"><?= $i ?></button></a>
                <?php endfor; ?>
                <?php if ($currentPage < $totalPages) : ?>
                    <a href="?page=<?= $currentPage + 1 ?>"><button>&gt;</button></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

</html>