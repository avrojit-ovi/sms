<!-- assets/sidebar.php -->
<?php
// Get the current script name
$currentPage = basename($_SERVER['PHP_SELF']);

// Start session and check user role

$userRole = isset($_SESSION['role']) ? $_SESSION['role'] : '';
?>

<div id="sidebar" class="sidebar d-flex flex-column justify-content-between">
    <div>
        <?php if ($userRole === 'admin'): ?>
            <!-- Admin has access to all menus -->
            <a href="index.php" class="<?php echo $currentPage === 'index.php' ? 'active' : ''; ?>">
                <i class="fas fa-home sidebar-icon"></i><span>Dashboard</span>
            </a>
            <a href="create_profile.php" class="<?php echo $currentPage === 'create_profile.php' ? 'active' : ''; ?>">
                <i class="fas fa-user-plus sidebar-icon"></i><span>Add Profile</span>
            </a>
            <a href="add_counselor.php" class="<?php echo $currentPage === 'add_counselor.php' ? 'active' : ''; ?>">
                <i class="fas fa-chalkboard-teacher sidebar-icon"></i><span>Add Counselor</span>
            </a>
            <a href="shadhana_recorder.php" class="<?php echo $currentPage === 'shadhana_recorder.php' ? 'active' : ''; ?>">
                <i class="fas fa-clipboard sidebar-icon"></i><span>Add Shadhana Record</span>
            </a>
            <a href="assign_counselor.php" class="<?php echo $currentPage === 'assign_counselor.php' ? 'active' : ''; ?>">
                <i class="fas fa-user-tie sidebar-icon"></i><span>Assign Counselor</span>
            </a>
            <a href="view_profiles.php" class="<?php echo $currentPage === 'view_profiles.php' ? 'active' : ''; ?>">
                <i class="fas fa-address-card sidebar-icon"></i><span>View Profile</span>
            </a>
            <a href="view_users.php" class="<?php echo $currentPage === 'view_users.php' ? 'active' : ''; ?>">
                <i class="fas fa-users sidebar-icon"></i><span>View Users</span>
            </a>
            <a href="view_shadhana_records.php" class="<?php echo $currentPage === 'view_shadhana_records.php' ? 'active' : ''; ?>">
                <i class="fas fa-list-alt sidebar-icon"></i><span>View Shadhana Records</span>
            </a>
        <?php elseif ($userRole === 'counselor'): ?>
            <!-- Counselor has limited access -->
            <a href="index.php" class="<?php echo $currentPage === 'index.php' ? 'active' : ''; ?>">
                <i class="fas fa-home sidebar-icon"></i><span>Dashboard</span>
            </a>
            <a href="create_profile.php" class="<?php echo $currentPage === 'create_profile.php' ? 'active' : ''; ?>">
                <i class="fas fa-user-plus sidebar-icon"></i><span>Add Profile</span>
            </a>
            <a href="view_profiles.php" class="<?php echo $currentPage === 'view_profiles.php' ? 'active' : ''; ?>">
                <i class="fas fa-address-card sidebar-icon"></i><span>View Profile</span>
            </a>
            <a href="view_shadhana_records.php" class="<?php echo $currentPage === 'view_shadhana_records.php' ? 'active' : ''; ?>">
                <i class="fas fa-list-alt sidebar-icon"></i><span>View Shadhana Records</span>
            </a>
        <?php elseif ($userRole === 'user'): ?>
            <!-- User has access to only Add Shadhana Record -->
            <a href="shadhana_recorder.php" class="<?php echo $currentPage === 'shadhana_recorder.php' ? 'active' : ''; ?>">
                <i class="fas fa-clipboard sidebar-icon"></i><span>Add Shadhana Record</span>
            </a>
        <?php endif; ?>
    </div>

    <!-- Sidebar Toggle Button at the bottom -->
    <div class="text-center mb-3">
        <button id="sidebarCollapseBtn" class="btn btn-outline-light">
            <i class="fas fa-angle-double-left"></i>
        </button>
    </div>
</div>
