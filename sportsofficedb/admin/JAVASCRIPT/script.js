
<!-- JavaScript -->
    document.addEventListener('DOMContentLoaded', () => {
    const sidebar = document.getElementById('sidebar');
    const collapseBtn = document.getElementById('collapseBtn');
    const mainContent = document.getElementById('mainContent');
    const collapseBoxIcon = document.getElementById('collapseBoxIcon');
    const logoutBtn = document.getElementById('logoutBtn');

    let isCollapsed = false;

    collapseBtn.addEventListener('click', () => {
    isCollapsed = !isCollapsed;
    sidebar.classList.toggle('collapsed', isCollapsed);
    mainContent.classList.toggle('collapsed', isCollapsed);

    collapseBoxIcon.setAttribute('name', isCollapsed ? 'collapse-vertical' : 'collapse-horizontal');
});

    logoutBtn.addEventListener('click', () => {
    window.location.href = '../../login/PHP/login.php';
});
});
