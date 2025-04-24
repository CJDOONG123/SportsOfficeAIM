
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/boxicons/css/boxicons.min.css" rel="stylesheet" />
    <script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
    <link rel="stylesheet" href="../CSS/Style.css" />
    <script src="../JAVASCRIPT/script.js" defer></script>
    <link rel="icon" href="../../image/Usep.png" sizes="any" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet" />
</head>

<body class="flex h-screen w-full relative bg-gray-100">
<!-- Sidebar -->
<div id="sidebar" class="sidebar">
    <div class="flex flex-col items-center mt-6 space-y-4">
        <img src="../../image/SportOffice.png" alt="Logo" class="w-20 h-20" />
        <div class="text-center text-xs leading-tight">
            <p class="font-semibold">One Data. One USeP.</p>
            <p>USeP OSAS-Sports Unit</p>
        </div>

        <nav class="space-y-2 w-full px-2 mt-4">
            <?php
            $currentPage = isset($_GET['page']) ? $_GET['page'] : 'Documents';
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

<!-- Main Content -->
<div id="mainContent" class="main-content px-1 sm:px-4 lg:px-0">
    <div class="sticky top-0 z-30 bg-gray w-full px-1 sm:px-4 lg:px-3">
        <div class="border-b-4 border-red-500 px-5 pt-2 pb-1 flex justify-between items-center bg-gray">
            <h1 class="text-3xl font-semibold text-gray-900 tracking-tight">
                    <?php echo htmlspecialchars($currentPage); ?>
                </h1>

            <?php if ($currentPage === 'Users'): ?>
                <div class="w-full px-4 sm:px-0 flex flex-col items-center sm:items-end space-y-2 sm:space-y-4">
                    <!-- Add User Button -->
                    <button onclick="document.getElementById('addUserModal').classList.remove('hidden')"
                            class="flex items-center text-red-500 font-semibold hover:text-red-600 sm:self-end w-auto">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 24 24" stroke="currentColor"
                             class="w-5 h-5 mr-1 border-2 border-red-500 rounded-full p-0.5">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 4v16m8-8H4"/>
                        </svg>
                        Add users
                    </button>

                    <!-- Search Field -->
                    <form method="GET" action=""
                          class="sm:self-end w-auto">
                        <input type="hidden" name="page" value="Users"/>
                        <input type="text" name="search" placeholder="Search user..."
                               class="border border-gray-300 rounded px-3 py-1 text-sm w-full focus:outline-none focus:ring-2 focus:ring-red-400"/>
                    </form>
                </div>
            <?php endif; ?>


        </div>

        <?php if ($currentPage === 'Users'): ?>

      <div class="w-full bg-red-500 text-white font-semibold rounded-t-lg px-5 mt-2 mb-4">
        <div class="flex sm:hidden flex-col p-4 space-y-4 text-sm">
                    <div>Student ID</div>
                    <div>Student Name</div>
                    <div>Student Address</div>
                </div>
                <div class="hidden sm:flex items-center px-4 py-6"> <!-- updated line -->
                    <div class="w-1/12 text-center"></div>
                    <div class="w-3/12">Student ID</div>
                    <div class="w-4/12">Student Name</div>
                    <div class="w-4/12">Student Address</div>
                </div>
            </div>

        <?php endif; ?>
    </div>

    <?php if ($currentPage === 'Users'): ?>
    <?php
    $conn = new mysqli("localhost", "root", "", "SportOfficeDB");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $searchTerm = isset($_GET['search']) ? trim($_GET['search']) : null;

    // Use stored procedure
    $stmt = $conn->prepare("CALL SearchUsers(?)");
    $stmt->bind_param("s", $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    // Display result (example)
    while ($row = $result->fetch_assoc()) {
        echo "ID: {$row['student_id']} | Name: {$row['full_name']} | Address: {$row['address']}<br>";
    }

    if ($result->num_rows > 0): ?>
    <div class="max-h-[calc(100vh-10rem)] overflow-y-auto overflow-x-hidden scroll-thin">
        <div class="w-full px-4 sm:px-8 lg:px-8 space-y-2">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="bg-white p-4 rounded-lg shadow-sm space-y-2 sm:space-y-0 sm:grid sm:grid-cols-12 sm:items-center">
                    <div class="text-center text-xl text-gray-600 sm:col-span-1">
                        <a href="edit_user.php?student_id=<?= urlencode($row['student_id']) ?>" class="text-blue-500 hover:text-blue-700">
                            <i class="fas fa-edit"></i>
                        </a>
                    </div>
                    <div class="text-gray-800 font-medium sm:col-span-3">
                        <span class="block sm:hidden font-semibold text-gray-600">Student ID:</span>
                        <?= htmlspecialchars($row['student_id']) ?>
                    </div>
                    <div class="text-gray-800 sm:col-span-4">
                        <span class="block sm:hidden font-semibold text-gray-600">Name:</span>
                        <?= htmlspecialchars($row['full_name']) ?>
                    </div>
                    <div class="text-gray-700 sm:col-span-4">
                        <span class="block sm:hidden font-semibold text-gray-600">Address:</span>
                        <?= htmlspecialchars($row['address']) ?>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    <?php else: ?>
    <div class="text-center text-gray-500 py-6 font-semibold">
        No users found matching your search.
    </div>
    <?php endif; ?>




    <?php elseif ($currentPage === 'Reports'): ?>
        <div class="p-4 sm:p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">

                <!-- Total Students -->
                <div class="bg-white rounded-xl shadow p-4 flex items-center space-x-4">
                    <div class="flex-shrink-0 w-12 h-12 sm:w-16 sm:h-16 flex justify-center items-center text-red-500 bg-red-100 rounded-full text-2xl">
                        <i class='bx bxs-user-account'></i>
                    </div>
                    <div>
                        <p class="text-gray-800 font-semibold text-sm sm:text-base">Total Students</p>
                        <?php
                        $reportConn = new mysqli("localhost", "root", "", "SportOfficeDB");
                        $totalStudents = 0;

                        if (!$reportConn->connect_error) {
                            $result = $reportConn->query("CALL GetTotalStudents()");
                            if ($result && $row = $result->fetch_assoc()) {
                                $totalStudents = $row['total'];
                            }
                            $reportConn->close();
                        }
                        ?>

                        <p class="text-2xl sm:text-3xl font-bold text-gray-900"><?= $totalStudents ?></p>
                    </div>
                </div>

                <!-- Approved Reports -->
                <div class="bg-white rounded-xl shadow p-4 flex items-center space-x-4">
                    <div class="flex-shrink-0 w-12 h-12 sm:w-16 sm:h-16 flex justify-center items-center text-green-600 bg-green-100 rounded-full text-2xl">
                        <i class='bx bxs-file-doc'></i>
                    </div>
                    <div>
                        <p class="text-gray-800 font-semibold text-sm sm:text-base">Approved Reports</p>
                        <p class="text-2xl sm:text-3xl font-bold text-gray-900">0</p>
                    </div>
                </div>

                <!-- Submission Stats -->
                <div class="bg-white rounded-xl shadow p-4 sm:p-8 flex flex-col md:flex-row items-center justify-center col-span-1 md:col-span-2 space-y-4 md:space-y-0 md:space-x-8">
                    <div class="flex justify-center items-center w-24 sm:w-32 h-24 sm:h-32 text-blue-600 bg-blue-100 rounded-full text-5xl">
                        <i class='bx bxs-bar-chart-alt-2'></i>
                    </div>
                    <div class="flex flex-col justify-center space-y-4 text-center md:text-left">
                        <div class="flex flex-col md:flex-row items-center md:space-x-4">
                            <div class="text-2xl sm:text-3xl font-bold text-gray-800">0</div>
                            <div class="text-gray-800 font-semibold text-sm sm:text-base">Ongoing Submission</div>
                        </div>
                        <div class="flex flex-col md:flex-row items-center md:space-x-4">
                            <div class="text-2xl sm:text-3xl font-bold text-gray-800">0</div>
                            <div class="text-gray-800 font-semibold text-sm sm:text-base">Verified Document</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>


    <?php else: ?>
        <p class="text-center">This is the <?php echo htmlspecialchars($currentPage); ?> content area.</p>
    <?php endif; ?>
</div>

<!-- Logout Modal -->
<div id="logoutModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50 hidden">
    <div class="bg-white rounded-lg shadow-lg p-6 w-80 text-center">
        <h2 class="text-lg font-semibold mb-4">Are you sure you want to logout?</h2>
        <div class="flex justify-center gap-4">
            <button id="cancelLogout" class="px-4 py-2 bg-gray-300 text-black rounded hover:bg-gray-400">No</button>
            <button id="confirmLogout" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Yes</button>
        </div>
    </div>
</div>

<!-- Add User Modal -->
<div id="addUserModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden z-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-full max-w-md">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-bold">Add User</h2>
            <button onclick="document.getElementById('addUserModal').classList.add('hidden')" class="text-gray-500 hover:text-gray-700 text-2xl font-bold">&times;</button>
        </div>
        <form action="add_user.php" method="POST">
            <div class="mb-4">
                <label class="block text-gray-700">Username</label>
                <input type="text" name="username" class="w-full border border-gray-300 p-2 rounded" required />
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Email</label>
                <input type="email" name="email" class="w-full border border-gray-300 p-2 rounded" required />
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Password</label>
                <input type="password" name="password" class="w-full border border-gray-300 p-2 rounded" required />
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">Submit</button>
            </div>
        </form>
    </div>
</div>
</body>

</html>