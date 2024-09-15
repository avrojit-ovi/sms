<?php
session_start();  // Start the session

require_once 'config.php';  // Include the database configuration file

// Check if the user is logged in and has the appropriate role
if (!isset($_SESSION['userid']) || ($_SESSION['role'] !== 'admin' && $_SESSION['role'] !== 'counselor')) {
    header("Location: noaccess.php");
    exit;
}

// Fetch users from the database
$sql = "SELECT * FROM users";
$stmt = $conn->prepare($sql);
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Determine if the user is an admin or counselor
$is_admin = $_SESSION['role'] === 'admin';
?>
<?php include 'dheader.php' ?>
        <h1 class="mb-4">Users</h1>
        <style>
        table {
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dee2e6;
            padding: 0.75rem;
        }
        th {
            background-color: #f8f9fa;
            text-align: center;
        }
        td {
            text-align: center;
        }
    </style>
        <table class="table table-striped table-hover" >
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>User ID</th>
                    <th>Role</th>
                    <?php if ($is_admin): ?>
                        <th>Password</th>
                    <?php endif; ?>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['id']); ?></td>
                    <td><?php echo htmlspecialchars($user['name']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td><?php echo htmlspecialchars($user['phone']); ?></td>
                    <td><?php echo htmlspecialchars($user['userid']); ?></td>
                    <td><?php echo htmlspecialchars($user['role']); ?></td>
                    <?php if ($is_admin): ?>
                        <td><?php echo htmlspecialchars($user['password']); ?></td>
                    <?php endif; ?>
                    <td>
                        <a href="edit_user.php?id=<?php echo htmlspecialchars($user['id']); ?>" class="btn btn-primary btn-sm">Edit</a>
                        <a href="delete_user.php?id=<?php echo htmlspecialchars($user['id']); ?>" class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php include 'dfooter.php' ?>
