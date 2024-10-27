<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin_dashboard.css">
</head>
<body>
    <header>
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
        <nav>
            <ul>
                <li><a href="normal.php">Add Normal Users</a></li>
                <li><a href="vip.php">Add VIP Users</a></li>
                <li><a href="view_normal.php">View Normal Users</a></li>
                <li><a href="view_vip.php">View VIP Users</a></li>
                <li><a href="settings.php">Settings</a></li>
                <li><a href="dolist.php">To Do List</a></li>
                <li><a href="logout.php">Sign Out</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h2>Admin Dashboard</h2>
        <section>
            <h3>Overview</h3>
            <p>Here you can manage users, view reports, and configure settings for the system.</p>
        </section>

        <section>
            <h3>Recent Activities</h3>
            <p>[Here, you could display recent activities or logs relevant to the admin's role.]</p>
        </section>

        <section>
            <h3>Manage Users</h3>
            <p>Click here to add, edit, or remove users from the system.</p>
        </section>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Gym Management System. All rights reserved.</p>
    </footer>
</body>
</html>
