// File: public/JAVASCRIPT/adminScript.js

// Utility functions
function toggleClass(element, className, condition) {
    if (!element) return;
    element.classList.toggle(className, condition);
}

function setSidebarCollapsed(collapsed) {
    if (!sidebar || !mainContent || !collapseBoxIcon) return;
    toggleClass(sidebar, 'collapsed', collapsed);
    toggleClass(mainContent, 'collapsed', collapsed);
    collapseBoxIcon.setAttribute('name', collapsed ? 'collapse-vertical' : 'collapse-horizontal');
    localStorage.setItem('sidebarCollapsed', JSON.stringify(collapsed));
}

function openModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) modal.classList.remove('hidden');
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) modal.classList.add('hidden');
}

// DOM elements
let sidebar, mainContent, collapseBoxIcon;
let logoutBtn, logoutModal, confirmLogout, cancelLogout;
let messageModal;

document.addEventListener('DOMContentLoaded', () => {
    sidebar = document.getElementById('sidebar');
    mainContent = document.getElementById('mainContent');
    collapseBoxIcon = document.getElementById('collapseBoxIcon');

    logoutBtn = document.getElementById('logoutBtn');
    logoutModal = document.getElementById('logoutModal');
    confirmLogout = document.getElementById('confirmLogout');
    cancelLogout = document.getElementById('cancelLogout');

    messageModal = document.getElementById('messageModal');

    let isCollapsed = JSON.parse(localStorage.getItem('sidebarCollapsed')) || false;
    setSidebarCollapsed(isCollapsed);

    document.getElementById('collapseBtn')?.addEventListener('click', () => {
        isCollapsed = !isCollapsed;
        setSidebarCollapsed(isCollapsed);
    });

    if (logoutBtn && logoutModal) {
        logoutBtn.addEventListener('click', (e) => {
            e.preventDefault();
            openModal('logoutModal');
        });

        cancelLogout?.addEventListener('click', () => closeModal('logoutModal'));

        confirmLogout?.addEventListener('click', () => {
            window.location.href = '../view/loginView.php';
        });

        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeModal('logoutModal');
                closeModal('messageModal');
            }
        });
    }

    if (messageModal) {
        openModal('messageModal');

        const okButton = messageModal.querySelector('button');
        if (okButton) {
            okButton.addEventListener('click', () => {
                closeModal('messageModal');

                // If "reopenAddUser=1", reopen the Add User Modal again
                const urlParams = new URLSearchParams(window.location.search);

                    openModal('addUserModal');


                // ⚡️ DO NOT reload or change the page anymore
            });
        }
    }
});

// At the bottom of your adminScript.js or in a script tag
document.addEventListener('DOMContentLoaded', function() {
    // Check if we should reopen the add user modal
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('reopenAddUser') === '1') {
        document.getElementById('addUserModal').classList.remove('hidden');
    }

    // Also show message modal if there's a message
    if (urlParams.has('message')) {
        document.getElementById('messageModal').classList.remove('hidden');
    }
});

function togglePasswordVisibility(inputId) {
    const input = document.getElementById(inputId);
    const icon = input.nextElementSibling;

    if (input.type === "password") {
        input.type = "text";
        icon.classList.remove('bx-show');
        icon.classList.add('bx-hide');
    } else {
        input.type = "password";
        icon.classList.remove('bx-hide');
        icon.classList.add('bx-show');
    }
}
