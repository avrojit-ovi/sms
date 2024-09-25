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
<?php include 'dheader.php'; ?>

<div class="d-flex justify-content-between align-items-center mb-4">
<h1 class="mb-4">Users</h1>

<!-- Add User Button -->
<button type="button" class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#addUserModal">
    <i class="fas fa-user-plus sidebar-icon"></i><span> Add New User</span>
</button>
</div>
<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="add_user_process.php" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="phone" name="phone" required>
                    </div>
                    <div class="mb-3">
                        <label for="userid" class="form-label">User ID</label>
                        <input type="text" class="form-control" id="userid" name="userid" title="Only from here you can give the customized Userid to the user...." required>
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select class="form-select" id="role" name="role" required>
                            <option value="admin">Admin</option>
                            <option value="counselor">Counselor</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add User</button>
                </form>
            </div>
        </div>
    </div>
</div>

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

<table class="table table-striped table-hover">
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
                <a href="edit_user.php?id=<?php echo htmlspecialchars($user['id']); ?>" class="btn btn-primary btn-sm"><i class="fas fa-edit"></i></a>
                <a href="delete_user.php?id=<?php echo htmlspecialchars($user['id']); ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<?php include 'dfooter.php'; ?>