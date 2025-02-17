<?php
// Include database connection file
include('../db_connection.php');

// Delete contact logic
if (isset($_GET['delete_id'])) {
    $deleteId = (int)$_GET['delete_id'];
    // Delete query
    $queryDelete = "DELETE FROM contact WHERE id = ?";
    $stmtDelete = $conn->prepare($queryDelete);
    $stmtDelete->bind_param("i", $deleteId);
    if ($stmtDelete->execute()) {
        header("Location: " . $_SERVER['PHP_SELF']); // Redirect after delete
        exit;
    } else {
        echo "Error deleting record.";
    }
}

// Query to fetch the total number of records (contacts) with member information
$queryTotal = "SELECT COUNT(*) AS total 
               FROM contact c
               INNER JOIN members m ON c.user_id = m.id";
$resultTotal = $conn->query($queryTotal);
$totalRows = $resultTotal->fetch_assoc()['total'];

// Pagination logic
$maxRows = 6; // Number of rows per page
$totalPages = ceil($totalRows / $maxRows);
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$startIndex = ($currentPage - 1) * $maxRows;

// Fetch the contact records with member info for the current page
$query = "SELECT c.id, m.email AS gmail, c.phNo AS phone, c.content AS description 
          FROM contact c 
          INNER JOIN members m ON c.user_id = m.id 
          LIMIT $startIndex, $maxRows";
$result = $conn->query($query);

// Fetch all the contact records as an associative array
$contacts = [];
while ($row = $result->fetch_assoc()) {
    $contacts[] = $row;
}

// Calculate how many empty rows to fill
$emptyRows = $maxRows - count($contacts);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Control</title>
    <link rel="stylesheet" href="css/contactControl.css">
</head>

<body>
    <?php include 'admin_header.php'; ?>
    <?php include 'admin_nav.php'; ?>

    <div class="content">
        <h1>Contact Control</h1>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Gmail</th>
                        <th>Phone Number</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Display the contact records
                    foreach ($contacts as $index => $contact) {
                        echo "<tr>
                            <td>" . ($startIndex + $index + 1) . "</td>
                            <td>{$contact['gmail']}</td>
                            <td>{$contact['phone']}</td>
                            <td style='width:500px;'>{$contact['description']}</td>
                            <td>
                                <a href='?delete_id={$contact['id']}'><button class='delete-btn'>Delete</button></a>
                            </td>
                        </tr>";
                    }

                    // Fill empty rows if not enough records
                    for ($i = 0; $i < $emptyRows; $i++) {
                        echo "<tr>
                            <td style='height:26px;'>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
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

<?php
// Close database connection
$conn->close();
?>