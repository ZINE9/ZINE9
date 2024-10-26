<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header('Location: index.php');
    exit();
}

$host = 'localhost';
$db = 'gym_base';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

$search = '';
if (isset($_GET['search'])) {
    $search = $conn->real_escape_string($_GET['search']);
    $sql = "SELECT * FROM users WHERE role='user' 
            AND (username LIKE '%$search%' 
            OR phone LIKE '%$search%' 
            OR first_name LIKE '%$search%' 
            OR last_name LIKE '%$search%' 
            OR address LIKE '%$search%')
            ORDER BY created_at DESC";
} else {
    $sql = "SELECT * FROM users WHERE role='user' ORDER BY created_at DESC";
}

$result = $conn->query($sql);
$userCount = $result->num_rows;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Reports</title>
    <link rel="stylesheet" href="view_reports.css">
</head>
<body>
    <div class="container">
        <h1>User Registration Reports</h1>
        
        <p>Total Users: <?php echo $userCount; ?></p>
        
        <form method="get" class="search-form">
            <input type="text" name="search" placeholder="Search by username, email, phone, etc." value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit">Search</button>
        </form>
        
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Phone</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Age</th>
                    <th>Gender</th>
                    <th>Weight</th>
                    <th>Height</th>
                    <th>Address</th>
                    <th>Role</th>
                    <th>Registration Date</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo htmlspecialchars($row['username']); ?></td>
                            <td><?php echo htmlspecialchars($row['phone']); ?></td>
                            <td><?php echo htmlspecialchars($row['first_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['last_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['age']); ?></td>
                            <td><?php echo htmlspecialchars($row['gender']); ?></td>
                            <td><?php echo htmlspecialchars($row['weight']); ?></td>
                            <td><?php echo htmlspecialchars($row['height']); ?></td>
                            <td><?php echo htmlspecialchars($row['address']); ?></td>
                            <td><?php echo htmlspecialchars($row['role']); ?></td>
                            <td><?php echo $row['created_at']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="12">No results found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        
        <p><a href="admin_dashboard.php" class="back-link">Back to Dashboard</a></p>
    </div>
</body>
</html>

<?php $conn->close(); ?>
