<?php
include '../db_connection.php'; // Include the database connection

// Pagination logic
$maxRows = 6; // Maximum rows per page
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Current page from URL, default to 1
$startIndex = ($currentPage - 1) * $maxRows; // Start index for LIMIT clause

// Fetch the total number of members for pagination calculation
$queryTotal = "SELECT COUNT(*) FROM members";
$resultTotal = mysqli_query($conn, $queryTotal);
$rowTotal = mysqli_fetch_row($resultTotal);
$totalRows = $rowTotal[0]; // Total number of members in the database
$totalPages = ceil($totalRows / $maxRows); // Total number of pages

// Fetch members for the current page with pagination
$query = "SELECT * FROM members LIMIT $startIndex, $maxRows";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Control</title>
    <link rel="stylesheet" href="css/member.css">

</head>

<body>
    <?php include 'admin_header.php'; ?>
    <?php include 'admin_nav.php'; ?>

    <div class="content">
        <h1>Member Control</h1>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Subscription</th>
                        <th>Type</th> <!-- New column for type -->
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Display members fetched from the database
                    while ($member = mysqli_fetch_assoc($result)) {
                        // Set subscription to 'Yes' if 1, otherwise 'No'
                        $subscription = ($member['subscription'] == 1) ? 'Yes' : 'No';

                        // Convert 1 or 0 to 'User' or 'Admin'
                        $type = ($member['usertype'] == 1) ? 'User' : 'Admin';

                        echo "
                        <tr>
                            <td>#{$member['id']}</td>
                            <td>{$member['name']}</td>
                            <td>{$member['email']}</td>
                            <td>{$member['phNo']}</td>
                            <td>{$subscription}</td>
                            <td>{$type}</td> <!-- Show type here -->
                            <td>
                                <button class='delete-btn' onclick='deleteMember({$member['id']})'>Delete</button>
                            </td>
                        </tr>
                        ";
                    }

                    // Calculate how many empty rows are needed to fill the page
                    $emptyRows = $maxRows - mysqli_num_rows($result);
                    for ($i = 0; $i < $emptyRows; $i++) {
                        echo "<tr><td colspan='7' style='height: 50px;'>&nbsp;</td></tr>";
                    }
                    ?>
                </tbody>
            </table>

            <div class="pagination">
                <?php if ($currentPage > 1) : ?>
                    <a href="members.php?page=<?= $currentPage - 1 ?>"><button>&lt;</button></a>
                <?php endif; ?>
                <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                    <a href="members.php?page=<?= $i ?>"><button class="<?= $i === $currentPage ? 'active' : '' ?>"><?= $i ?></button></a>
                <?php endfor; ?>
                <?php if ($currentPage < $totalPages) : ?>
                    <a href="members.php?page=<?= $currentPage + 1 ?>"><button>&gt;</button></a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script>
        // Function to handle the delete action (send request to delete the member)
        function deleteMember(id) {
            if (confirm("Are you sure you want to delete this member?")) {
                window.location.href = "members.php?id=" + id;
            }
        }
    </script>
</body>

</html>

<?php
// Close the database connection
mysqli_close($conn);
?>