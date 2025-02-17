<?php
// Include the database connection file
include '../db_connection.php';


// Fetch total members
$query_members = "SELECT COUNT(*) as total_members FROM members";
$result_members = mysqli_query($conn, $query_members);
$row_members = mysqli_fetch_assoc($result_members);
$total_members = $row_members['total_members'];

// Fetch total admins
$query_admins = "SELECT COUNT(*) as total_admins FROM members WHERE usertype = 1"; // assuming 1 is admin usertype
$result_admins = mysqli_query($conn, $query_admins);
$row_admins = mysqli_fetch_assoc($result_admins);
$total_admins = $row_admins['total_admins'];

// Fetch total social media apps
$query_social_media = "SELECT COUNT(*) as total_social_media FROM socialmediaapp";
$result_social_media = mysqli_query($conn, $query_social_media);
$row_social_media = mysqli_fetch_assoc($result_social_media);
$total_social_media = $row_social_media['total_social_media'];

// Fetch total newsletters
$query_newsletters = "SELECT COUNT(*) as total_newsletters FROM newsletters";
$result_newsletters = mysqli_query($conn, $query_newsletters);
$row_newsletters = mysqli_fetch_assoc($result_newsletters);
$total_newsletters = $row_newsletters['total_newsletters'];

// Fetch total services (assuming there’s a table for services
$query_services = "SELECT COUNT(*) as total_services FROM howparentcanhelp";
$result_services = mysqli_query($conn, $query_services);
$row_services = mysqli_fetch_assoc($result_services);
$total_services = $row_services['total_services'];

// Fetch total contact messages
$query_contact = "SELECT COUNT(*) as total_contact FROM contact";
$result_contact = mysqli_query($conn, $query_contact);
$row_contact = mysqli_fetch_assoc($result_contact);
$total_contact = $row_contact['total_contact'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css">
</head>

<body>
    <?php include 'admin_header.php'; ?>
    <?php include 'admin_nav.php'; ?>

    <div class="content">
        <h1>Dashboard</h1>
        <div class="dashboard">
            <div class="dashboard-item">
                <h3>Total Members</h3>
                <p><?php echo $total_members; ?></p>
            </div>
            <div class="dashboard-item">
                <h3>Total Admins</h3>
                <p><?php echo $total_admins; ?></p>
            </div>
            <div class="dashboard-item">
                <h3>Total Social Media</h3>
                <p><?php echo $total_social_media; ?></p>
            </div>
            <div class="dashboard-item">
                <h3>Total New Letters</h3>
                <p><?php echo $total_newsletters; ?></p>
            </div>
            <div class="dashboard-item">
                <h3>Total Services</h3>
                <p><?php echo $total_services; ?></p>
            </div>
            <div class="dashboard-item">
                <h3>Total How Parent Can Help</h3>
                <p><?php echo $total_services; ?></p>
            </div>
            <div class="dashboard-item the_last_One">
                <h3>Total Contact Messages</h3>
                <p><?php echo $total_contact; ?></p>
            </div>
        </div>
    </div>
</body>

</html>