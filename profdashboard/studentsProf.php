<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 2) {
    header('Location: ../index.php');
    exit();
}

if ($_SESSION['user_status'] === 'waiting') {
    header("Location: ../pages/status_pending.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>YouDemy - Student Management</title>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <span class="text-2xl font-bold text-purple-600">YouDemy</span>
                </div>
                <div class="flex items-center space-x-4">
                <span class="text-gray-600"><?php echo $_SESSION['user_nom'] . " " . $_SESSION['user_prenom'] ?></span>
                    <a href="../Handling/AuthHandl.php"><button class="text-gray-600 hover:text-gray-900">Logout</button></a>
                </div>
            </div>
        </div>
    </nav>

    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-md h-screen">
            <div class="p-4">
                <ul class="space-y-2">
                <a href="../pages/prof_dashboard.php"><li class="text-gray-600 hover:bg-purple-50 p-2 rounded">Dashboard</li></a>
                <a href="../pages/createCours.php"><li class="text-gray-600 hover:bg-purple-50 p-2 rounded">Create Course</li></a>
                <a href="../profdashboard/myCourse.php"><li class="text-gray-600 hover:bg-purple-50 p-2 rounded">My Cours</li></a>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-2xl font-bold">Student Management</h1>
                <div class="flex space-x-4">
                    <input type="text" placeholder="Search students..." class="border p-2 rounded-md"/>
                    <select class="border p-2 rounded-md">
                        <option>All Courses</option>
                        <option>Web Development</option>
                        <option>Python Basics</option>
                        <option>JavaScript Advanced</option>
                    </select>
                </div>
            </div>

            <!-- Student List -->
            <div class="bg-white rounded-lg shadow-sm">
                <div class="p-6">
                    <table class="w-full">
                        <thead>
                            <tr class="text-left border-b">
                                <th class="pb-4">Student Name</th>
                                <th class="pb-4">Course</th>
                                <th class="pb-4">Progress</th>
                                <th class="pb-4">Last Activity</th>
                                <th class="pb-4">Grade</th>
                                <th class="pb-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b">
                                <td class="py-4">
                                    <div class="flex items-center">
                                        <img src="/api/placeholder/40/40" alt="Student" class="w-8 h-8 rounded-full mr-3"/>
                                        <span>John Doe</span>
                                    </div>
                                </td>
                                <td>Web Development</td>
                                <td>
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="bg-purple-600 h-2.5 rounded-full" style="width: 75%"></div>
                                    </div>
                                </td>
                                <td>2 hours ago</td>
                                <td>85%</td>
                                <td>
                                    <button class="text-blue-600 hover:text-blue-800 mr-2">Message</button>
                                    <button class="text-gray-600 hover:text-gray-800">View Details</button>
                                </td>
                            </tr>
                            <tr class="border-b">
                                <td class="py-4">
                                    <div class="flex items-center">
                                        <img src="/api/placeholder/40/40" alt="Student" class="w-8 h-8 rounded-full mr-3"/>
                                        <span>Sarah Johnson</span>
                                    </div>
                                </td>
                                <td>Python Basics</td>
                                <td>
                                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                                        <div class="bg-purple-600 h-2.5 rounded-full" style="width: 90%"></div>
                                    </div>
                                </td>
                                <td>1 day ago</td>
                                <td>92%</td>
                                <td>
                                    <button class="text-blue-600 hover:text-blue-800 mr-2">Message</button>
                                    <button class="text-gray-600 hover:text-gray-800">View Details</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- Pagination -->
                <div class="p-4 border-t flex justify-between items-center">
                    <span class="text-gray-600">Showing 1-10 of 150 students</span>
                    <div class="flex space-x-2">
                        <button class="px-3 py-1 border rounded hover:bg-gray-50">Previous</button>
                        <button class="px-3 py-1 bg-purple-600 text-white rounded">1</button>
                        <button class="px-3 py-1 border rounded hover:bg-gray-50">2</button>
                        <button class="px-3 py-1 border rounded hover:bg-gray-50">3</button>
                        <button class="px-3 py-1 border rounded hover:bg-gray-50">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>