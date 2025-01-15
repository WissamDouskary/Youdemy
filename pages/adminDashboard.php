<?php
require_once '../classes/admin.php';

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 1) {
    header('Location: ../index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>YouDemy - Admin Dashboard</title>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Navigation -->
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <span class="text-2xl font-bold text-purple-600">YouDemy</span>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600">Admin Panel</span>
                    <a href="../Handling/AuthHandl.php"><button class="text-gray-600 hover:text-gray-900">Logout</button></a>
                </div>
            </div>
        </div>
    </nav>

    <?php

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    $type = $message['type'];
    $text = $message['text'];

    echo "
        <script>
            Swal.fire({
                icon: '$type',
                title: '$type',
                text: '$text',
                confirmButtonText: 'OK'
            });
        </script>
    ";

    unset($_SESSION['message']);
}
?>

    <!-- Main Content -->
    <div class="p-8 max-w-7xl mx-auto">
        <h1 class="text-2xl font-bold mb-8">Statistics Overview</h1>
        
        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-gray-500 text-sm mb-1">Total Users</h3>
                <p class="text-3xl font-bold">15,234</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-gray-500 text-sm mb-1">Total Courses</h3>
                <p class="text-3xl font-bold">456</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-gray-500 text-sm mb-1">Total Revenue</h3>
                <p class="text-3xl font-bold">$123,456</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-gray-500 text-sm mb-1">Active Instructors</h3>
                <p class="text-3xl font-bold">89</p>
            </div>
        </div>

        <!-- Recent Users -->
        <div class="bg-white p-6 rounded-lg shadow-sm mb-8">
            <h2 class="text-xl font-bold mb-4">Recent Users</h2>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="text-left text-gray-500">
                            <th class="pb-4">User</th>
                            <th class="pb-4">Role</th>
                            <th class="pb-4">Status</th>
                            <th class="pb-4">Actions</th>
                        </tr>
                    </thead>
                    <?php 
                    $users = Admin::getallusers();
                    foreach($users as $user){
                    ?>
                    <tbody>
                        <tr class="border-b">
                            <td class="py-4"><?php echo $user['prenom'] . " " . $user['nom'] ?></td>
                            <td><?php echo $user['name'] ?></td>
                            <?php if($user['status'] === 'waiting'){ ?>
                                <td><span class="bg-gray-100 text-gray-800 px-2 py-1 rounded-full text-sm"><?php echo $user['status'] ?></span></td>
                            <?php } else if ($user['status'] === 'active'){ ?>
                            <td><span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-sm"><?php echo $user['status'] ?></span></td>
                            <?php }else if ($user['status'] === 'suspended'){ ?>
                                <td><span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-sm"><?php echo $user['status'] ?></span></td>
                            <?php } ?>
                            <td >
                                <div class="flex gap-3">
                                <form action="../Handling/userHandl.php" method="post">
                                    <input type="hidden" name="action" value="active">
                                    <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                                    <button type="submit" class="text-green-600 hover:text-green-800">Approve</button>
                                </form>
                                <form action="../Handling/userHandl.php" method="post">
                                    <input type="hidden" name="action" value="suspended">
                                    <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                                    <button type="submit" class="text-red-600 hover:text-red-800">Ban</button>
                                </form>             
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    <?php } ?>
                </table>
            </div>
        </div>

        <!-- Recent Reports -->
        <div class="bg-white p-6 rounded-lg shadow-sm">
            <h2 class="text-xl font-bold mb-4">Recent Reports</h2>
            <div class="space-y-4">
                <div class="flex items-center justify-between border-b pb-4">
                    <div>
                        <p class="font-semibold">Content Report</p>
                        <p class="text-gray-500">Report on "JavaScript Basics" course</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <button class="bg-red-100 text-red-600 px-3 py-1 rounded-md">Review</button>
                        <span class="text-gray-400">2 hours ago</span>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <div>
                        <p class="font-semibold">Payment Issue</p>
                        <p class="text-gray-500">Failed payment for course enrollment</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        <button class="bg-yellow-100 text-yellow-600 px-3 py-1 rounded-md">Pending</button>
                        <span class="text-gray-400">5 hours ago</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>