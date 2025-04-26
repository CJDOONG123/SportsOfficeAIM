// File: public/JAVASCRIPT/adminScript.js

// Utility functions
function toggleClass(element, className, condition) {
    if (!element) return;
    element.classList.toggle(className, condition);
}

function setSidebarCollapsed(collapsed) {
    toggleClass(sidebar, 'collapsed', collapsed);
    toggleClass(mainContent, 'collapsed', collapsed);
    collapseBoxIcon?.setAttribute('name', collapsed ? 'collapse-vertical' : 'collapse-horizontal');
    localStorage.setItem('sidebarCollapsed', collapsed.toString());
}

function openModal(modal) {
    if (modal) modal.classList.remove('hidden');
}

function closeModal(modal) {
    if (modal) modal.classList.add('hidden');
}

// Main script

document.addEventListener('DOMContentLoaded', () => {
    const sidebar = document.getElementById('sidebar');
    const collapseBtn = document.getElementById('collapseBtn');
    const mainContent = document.getElementById('mainContent');
    const collapseBoxIcon = document.getElementById('collapseBoxIcon');

    const logoutBtn = document.getElementById('logoutBtn');
    const logoutModal = document.getElementById('logoutModal');
    const confirmLogout = document.getElementById('confirmLogout');
    const cancelLogout = document.getElementById('cancelLogout');

    // Sidebar initial state
    let isCollapsed = localStorage.getItem('sidebarCollapsed') === 'true';
    setSidebarCollapsed(isCollapsed);

    collapseBtn?.addEventListener('click', () => {
        isCollapsed = !isCollapsed;
        setSidebarCollapsed(isCollapsed);
    });

    // Logout modal logic
    if (logoutBtn && logoutModal) {
        logoutBtn.addEventListener('click', (e) => {
            e.preventDefault();
            openModal(logoutModal);
        });

        cancelLogout?.addEventListener('click', () => closeModal(logoutModal));

        confirmLogout?.addEventListener('click', () => {
            window.location.href = '../view/login.php';
        });

        // Close modal with Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeModal(logoutModal);
        });
    }
});
