<?php
// Include the database connection
require '../db_connection.php';

// Delete functionality
if (isset($_POST['delete_id']) && is_numeric($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];

    // SQL to delete the record
    $deleteQuery = "DELETE FROM howparentcanhelp WHERE id = ?";
    if ($stmt = mysqli_prepare($conn, $deleteQuery)) {
        mysqli_stmt_bind_param($stmt, "i", $delete_id);
        if (mysqli_stmt_execute($stmt)) {
            // Redirect to the same page after successful deletion to prevent resubmission on refresh
            header('Location: howParentCanHelp.php');
            exit; // Make sure the script stops after redirection
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
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
    <title>Parent Help Table</title>
    <link rel="stylesheet" href="css/howParentCanHelp.css">
</head>

<body>
    <?php include 'admin_header.php'; ?>
    <?php include 'admin_nav.php'; ?>

    <div class="content">
        <h1>How Parent Can Help</h1>
        <a href="addHowParentsCanHelpPage.php"><button class="add-new-btn">+ Add New</button></a>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Images</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Pagination setup
                    $maxRows = 5; // Number of rows to display per page
                    $currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                    $startIndex = ($currentPage - 1) * $maxRows;

                    // Count total rows in the `howparentcanhelp` table
                    $totalRowsQuery = "SELECT COUNT(*) AS total FROM howparentcanhelp";
                    $totalRowsResult = mysqli_query($conn, $totalRowsQuery);
                    $totalRows = mysqli_fetch_assoc($totalRowsResult)['total'];
                    $totalPages = ceil($totalRows / $maxRows);

                    // Fetch paginated data from the `howparentcanhelp` table
                    $dataQuery = "SELECT * FROM howparentcanhelp LIMIT $startIndex, $maxRows";
                    $dataResult = mysqli_query($conn, $dataQuery);
                    $currentData = mysqli_fetch_all($dataResult, MYSQLI_ASSOC);

                    if ($currentData) {
                        foreach ($currentData as $index => $item) {
                            echo "<tr>
                                <td>" . ($startIndex + $index + 1) . "</td>
                                <td>";
                            // Display the image if available, otherwise show placeholder
                            if (!empty($item['image'])) {
                                echo "<img src='../uploads/{$item['image']}' alt='Image' style='width: 95px; height: 95px; object-fit: cover; border-radius: 4px;'>";
                            } else {
                                echo "<div class='image-placeholder'>No Image</div>";
                            }
                            echo "</td>
                                <td id='title'>{$item['title']}</td>
                                <td id='content'><div class='content_from_db'>{$item['content']}</div></td>
                                <td id='actions'>
                                    <a href='editHowParentCanHelpPage.php?id={$item['id']}'><button class='edit-btn'>Edit</button></a>
                                    <form action='howParentCanHelp.php' method='POST' onsubmit='return confirm(\"Are you sure you want to delete this item?\");' style='display:inline;'>
                                        <input type='hidden' name='delete_id' value='{$item['id']}'>
                                        <button type='submit' class='delete-btn'>Delete</button>
                                    </form>
                                </td>
                            </tr>";
                        }

                        // Fill empty rows for consistent height
                        $emptyRows = $maxRows - count($currentData);
                        for ($i = 0; $i < $emptyRows; $i++) {
                            echo "<tr><td style='height:95px'></td><td></td><td></td><td></td><td></td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='5' style='text-align: center;'>No data available</td></tr>";
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