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

$searchTerm = '';
if (isset($_GET['search'])) {
    $searchTerm = $conn->real_escape_string($_GET['search']);
}

$sql = "SELECT * FROM users WHERE role='user'";

if (!empty($searchTerm)) {
    $sql .= " AND (username LIKE '%$searchTerm%' OR phone LIKE '%$searchTerm%' 
             OR first_name LIKE '%$searchTerm%' OR last_name LIKE '%$searchTerm%' 
             OR weight LIKE '%$searchTerm%' OR height LIKE '%$searchTerm%')";
}

$result = $conn->query($sql);
$userCount = $result->num_rows;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete_user'])) {
        $userId = intval($_POST['user_id']);
        $deleteSql = "DELETE FROM users WHERE id = $userId";
        $conn->query($deleteSql);
    } elseif (isset($_POST['edit_user'])) {
        $userId = intval($_POST['user_id']);
        $weight = floatval($_POST['weight']);
        $height = $conn->real_escape_string($_POST['height']);
        $rest_days = intval($_POST['rest_days']);
        $rest_hours = intval($_POST['rest_hours']);

        $rest_date = date('Y-m-d H:i:s', strtotime("+$rest_days days +$rest_hours hours"));

        $updateSql = "UPDATE users SET weight = '$weight', height = '$height', rest_date = '$rest_date' WHERE id = $userId";
        $conn->query($updateSql);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="design.css">
</head>
<body>
    <div class="container">
        <h1>Manage Users</h1>
        
        <p>Total Users: <?php echo $userCount; ?></p>
        
        <form method="get" class="search-form">
            <input type="text" name="search" placeholder="Search by username, phone, etc." value="<?php echo htmlspecialchars($searchTerm); ?>">
            <button type="submit" class="btn search-btn">Search</button>
        </form>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Phone No.</th>
                    <th>Weight</th>
                    <th>Height</th>
                    <th>Rest Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['username']); ?></td>
                        <td><?php echo htmlspecialchars($row['phone']); ?></td>
                        <td><?php echo htmlspecialchars($row['weight']); ?></td>
                        <td><?php echo htmlspecialchars($row['height']); ?></td>
                        <td id="rest-date-<?php echo $row['id']; ?>"><?php echo htmlspecialchars($row['rest_date']); ?></td>
                        <td>
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
                                <input type="number" name="weight" value="<?php echo htmlspecialchars($row['weight']); ?>" step="0.1" required>
                                <input type="text" name="height" value="<?php echo htmlspecialchars($row['height']); ?>" required>
                                <input type="number" name="rest_days" placeholder="Days" required>
                                <input type="number" name="rest_hours" placeholder="Hours" required>
                                <button type="submit" name="edit_user" class="btn edit-btn">Edit</button>
                            </form>
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="user_id" value="<?php echo $row['id']; ?>">
                                <button type="submit" name="delete_user" class="btn delete-btn">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
        <p><a href="admin_dashboard.php" class="back-link">Back to Dashboard</a></p>
    </div>
</body>
</html>

<?php $conn->close(); ?>
