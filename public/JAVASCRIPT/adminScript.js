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

function togglePasswordVisibility(inputId) {
    const input = document.getElementById(inputId);
    if (!input) return;
    const icon = input.nextElementSibling;
    if (!icon) return;

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

function populateEditUserModal(studentId, fullName, address, email, status) {
    document.getElementById('edit-student-id').value = studentId;
    document.getElementById('edit-full-name').value = fullName;
    document.getElementById('edit-address').value = address;
    document.getElementById('edit-email').value = email;
    document.getElementById('edit-status').value = status;
    openModal('editUserModal');
}

// DOM elements
let sidebar, mainContent, collapseBoxIcon;
let logoutBtn, logoutModal, confirmLogout, cancelLogout;
let messageModal;

// Unified DOMContentLoaded event

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
                closeModal('addUserModal');
                closeModal('editUserModal');
            }
        });
    }

    const urlParams = new URLSearchParams(window.location.search);

    if (urlParams.has('message') && messageModal) {
        openModal('messageModal');

        const okButton = messageModal.querySelector('button');
        if (okButton) {
            okButton.addEventListener('click', () => {
                closeModal('messageModal');

                if (urlParams.get('reopenAddUser') === '1') {
                    openModal('addUserModal');
                }
            });
        }
    }

    if (urlParams.get('reopenAddUser') === '1') {
        openModal('addUserModal');
    }

    // Replace edit link clicks with opening edit modal
    document.querySelectorAll('.edit-user-btn').forEach(button => {
        button.addEventListener('click', (e) => {
            e.preventDefault();
            const studentId = button.getAttribute('data-student-id');
            const fullName = button.getAttribute('data-full-name');
            const address = button.getAttribute('data-address');
            const email = button.getAttribute('data-email');
            const status = button.getAttribute('data-status');
            populateEditUserModal(studentId, fullName, address, email, status);
        });
    });
});


function editUserModal(user) {
    document.getElementById('edit-student-id').value = user.student_id;
    document.getElementById('edit-full-name').value = user.full_name;
    document.getElementById('edit-address').value = user.address;

    const statusSelect = document.querySelector('#editUserModal select[name="status"]');
    statusSelect.value = user.status;

    document.getElementById('editUserModal').classList.remove('hidden');
}

function closeEditModal() {
    document.getElementById('editUserModal').classList.add('hidden');
}