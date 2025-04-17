<?php
$users = [
    ["id" => "2023-00023", "name" => "Christian Doong", "address" => "Susano Rd Barangay San Agustin"],
    ["id" => "2023-00123", "name" => "Gian Garcia", "address" => "Tagum City"],
    ["id" => "2023-12345", "name" => "Christian Doong", "address" => "Susano Rd Barangay San Agustin"],
    ["id" => "2023-00023", "name" => "Christian Doong", "address" => "Susano Rd Barangay San Agustin"],
    ["id" => "2023-00023", "name" => "Christian Doong", "address" => "Susano Rd Barangay San Agustin"]
];
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../CSS/Style.css">
</head>
<body class="flex h-screen w-full relative">





<!-- Sidebar -->
<div id="sidebar" class="sidebar">
    <img src="../../image/SportOffice.png" alt="Logo" class="w-24 h-24">
    <div class="text-center text-xs leading-tight mt-2">
        <p class="font-semibold">One Data. One USeP.</p>
        <p>USeP OSAS-Sports Unit</p>
    </div>
    <nav class="space-y-4 text-sm w-full px-4 mt-8">
        <?php
        $menu = ['Documents', 'Evaluation', 'Reports', 'Users', 'Log-out'];
        foreach ($menu as $item) {
            $active = $item === 'Users' ? 'active-menu' : 'menu-item';
            echo "<a href='#' class='block w-full py-2 px-4 rounded $active'>$item</a>";
        }
        ?>
    </nav>
</div>






<!-- Main Content -->
<div class="main-content">
    <h1 class="text-xl font-bold mb-2">USERS</h1>
    <div class="w-full border-b-2 border-red-500 mb-4"></div>

    <!-- Header Row -->
    <div class="flex justify-between items-center bg-red-500 text-white px-4 py-2 rounded">
        <div class="flex w-full">
            <div class="w-1/3 font-semibold">Student ID</div>
            <div class="w-1/3 font-semibold">Student Name</div>
            <div class="w-1/3 font-semibold">Student Address</div>
        </div>
        <button class="ml-4 flex items-center border border-white px-2 py-1 rounded text-white hover:bg-red-600 transition">
            <span class="mr-1 font-bold">+</span> Add users
        </button>
    </div>

    <!-- User Cards -->
    <div class="mt-4 space-y-2">
        <?php foreach ($users as $user): ?>
            <div class="user-card">
                <svg class="w-5 h-5 text-gray-600 mr-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536M9 13h3l7-7-3-3-7 7v3z" />
                </svg>
                <div class="w-1/3"><?php echo $user['id']; ?></div>
                <div class="w-1/3"><?php echo $user['name']; ?></div>
                <div class="w-1/3"><?php echo $user['address']; ?></div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

</body>
</html>
