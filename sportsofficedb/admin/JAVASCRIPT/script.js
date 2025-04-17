document.addEventListener('DOMContentLoaded', () => {
    const sidebar = document.getElementById('sidebar');
    const collapseBtn = document.getElementById('collapseBtn');
    const mainContent = document.getElementById('mainContent');
    const collapseBoxIcon = document.getElementById('collapseBoxIcon');

    const logoutBtn = document.getElementById('logoutBtn');
    const logoutModal = document.getElementById('logoutModal');
    const confirmLogout = document.getElementById('confirmLogout');
    const cancelLogout = document.getElementById('cancelLogout');

    // Sidebar collapse state from localStorage
    let isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
    if (isCollapsed) {
        sidebar.classList.add('collapsed');
        mainContent.classList.add('collapsed');
        collapseBoxIcon.setAttribute('name', 'collapse-vertical');
    }

    collapseBtn.addEventListener('click', () => {
        isCollapsed = !isCollapsed;
        sidebar.classList.toggle('collapsed', isCollapsed);
        mainContent.classList.toggle('collapsed', isCollapsed);
        localStorage.setItem('sidebarCollapsed', isCollapsed.toString());
        collapseBoxIcon.setAttribute('name', isCollapsed ? 'collapse-vertical' : 'collapse-horizontal');
    });

    // ✅ Logout logic with null checks
    if (logoutBtn && logoutModal && confirmLogout && cancelLogout) {
        logoutBtn.addEventListener('click', (e) => {
            e.preventDefault(); // Prevent link behavior
            logoutModal.classList.remove('hidden');
        });

        cancelLogout.addEventListener('click', () => {
            logoutModal.classList.add('hidden');
        });

        confirmLogout.addEventListener('click', () => {
            // Redirect to logout logic (you could also use AJAX if needed)
            window.location.href = '../../login/PHP/login.php';
        });
    }
});
