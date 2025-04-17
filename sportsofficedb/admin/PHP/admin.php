<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <!-- Boxicons -->
    <link href="https://cdn.jsdelivr.net/npm/boxicons/css/boxicons.min.css" rel="stylesheet">
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../CSS/Style.css">

    <!-- Custom JS -->
    <script src="../JAVASCRIPT/script.js" defer></script>
    <link rel="icon" href="../../image/Usep.png" sizes="any" />
</head>


<body class="flex h-screen w-full relative bg-gray-100">

<!-- Sidebar -->
<div id="sidebar" class="sidebar">
    <div class="flex flex-col items-center mt-6 space-y-4">
        <img src="../../image/SportOffice.png" alt="Logo" class="w-20 h-20">
        <div class="text-center text-xs leading-tight">
            <p class="font-semibold">One Data. One USeP.</p>
            <p>USeP OSAS-Sports Unit</p>
        </div>

        <nav class="space-y-2 w-full px-2 mt-4">
            <?php
            $currentPage = isset($_GET['page']) ? $_GET['page'] : 'Documents'; // Default to 'Documents'

            $menu = ['Documents', 'Evaluation', 'Reports', 'Users', 'Log-out'];
            $icon = [
                'Documents' => "<box-icon name='file-doc' type='solid' color='white'></box-icon>",
                'Evaluation' => "<box-icon name='line-chart' color='white'></box-icon>",
                'Reports' => "<box-icon name='report' type='solid' color='white'></box-icon>",
                'Users' => "<box-icon name='user-circle' color='white'></box-icon>",
                'Log-out' => "<box-icon name='log-out' color='white'></box-icon>"
            ];

            foreach ($menu as $item) {
                $isLogout = $item === 'Log-out';
                $isActive = $item === $currentPage;
                $class = $isActive ? 'menu-item active-menu' : 'menu-item';
                $idAttr = $isLogout ? "id='logoutBtn' href='#'" : "href='?page=$item'";

                echo "<a $idAttr class='$class' data-title='$item'>
                <span class='menu-icon'>{$icon[$item]}</span>
                <span class='menu-text'>$item</span>
                </a>";
            }
            ?>
        </nav>
    </div>

    <!-- Collapse Button -->
    <div class="w-full px-2 mb-4">
        <button id="collapseBtn" class="menu-item w-full focus:outline-none">
            <box-icon id="collapseBoxIcon" name='collapse-horizontal' color='white'></box-icon>
            <span class="menu-text">Collapse Sidebar</span>
        </button>
    </div>
</div>

<!-- Main content -->
<div id="mainContent" class="main-content">
    <h1 class="text-2xl font-bold mb-4">
        <?php echo "Welcome to " . htmlspecialchars($currentPage) . " Page"; ?>
    </h1>
    <p>This is the <?php echo htmlspecialchars($currentPage); ?> content area.</p>
</div>


</body>

<!-- Logout Confirmation Modal -->
<div id="logoutModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden">
    <div class="bg-white rounded-lg shadow-lg p-6 w-80 text-center">
        <h2 class="text-lg font-semibold mb-4">Are you sure you want to logout?</h2>
        <div class="flex justify-center gap-4">
            <button id="cancelLogout" class="px-4 py-2 bg-gray-300 text-black rounded hover:bg-gray-400">No</button>
            <button id="confirmLogout" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Yes</button>
        </div>
    </div>
</div>

</html>
