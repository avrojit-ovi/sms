</div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <script>
    // Ensure the sidebar is initially collapsed
    document.addEventListener("DOMContentLoaded", function() {
        const sidebar = document.getElementById("sidebar");
        const content = document.getElementById("content");
        const navbar = document.querySelector(".navbar");

        sidebar.classList.add("collapsed-sidebar");
        content.classList.add("collapsed-content");
        navbar.classList.add("collapsed-navbar");
    });

    // Sidebar Toggle Script
    document.getElementById("sidebarToggle").addEventListener("click", function() {
        const sidebar = document.getElementById("sidebar");
        const content = document.getElementById("content");
        const navbar = document.querySelector(".navbar");

        sidebar.classList.toggle("collapsed-sidebar");
        content.classList.toggle("collapsed-content");
        navbar.classList.toggle("collapsed-navbar");
    });

    // Bottom Collapse Button
    document.getElementById("sidebarCollapseBtn").addEventListener("click", function() {
        const sidebar = document.getElementById("sidebar");
        const content = document.getElementById("content");
        const navbar = document.querySelector(".navbar");

        sidebar.classList.toggle("collapsed-sidebar");
        content.classList.toggle("collapsed-content");
        navbar.classList.toggle("collapsed-navbar");
    });
</script>


</body>
</html>
