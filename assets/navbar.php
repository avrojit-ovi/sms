<!-- assets/navbar.php -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <button id="sidebarToggle" class="btn btn-outline-secondary">
            <i class="fas fa-bars"></i>
        </button>
        <div class="ms-auto d-flex align-items-center">
            <div class="profile-dropdown dropdown">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user-circle"></i> <strong><?php echo htmlspecialchars($userName); ?></strong>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                    <li><a class="dropdown-item" href="#">My Profile</a></li>
                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>
