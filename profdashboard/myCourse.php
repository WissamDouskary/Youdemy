<?php
require_once '../classes/cours.php';
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
    <title>YouDemy - My Courses</title>
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
                    <a href="../profdashboard/createCours.php"><li class="text-gray-600 hover:bg-purple-50 p-2 rounded">Create Course</li></a>
                    <a href="../profdashboard/myCourse.php"><li class="bg-purple-100 text-purple-700 p-2 rounded">My Cours</li></a>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-2xl font-bold">My Courses</h1>
                <div class="flex space-x-4">
                    <input type="text" placeholder="Search courses..." class="border p-2 rounded-md"/>
                    <select class="border p-2 rounded-md">
                        <option>All Categories</option>
                        <option>Programming</option>
                        <option>Design</option>
                        <option>Business</option>
                    </select>
                </div>
            </div>

            <!-- Course Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Course Card 1 -->
                 <?php 
                $courses = Cours::showspecificsCours($_SESSION['user_id']);
                foreach($courses as $cours){
                 ?>
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <img src="<?php echo $cours->getcourseImage()?>" alt="Course thumbnail" class="w-full h-48 object-cover"/>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="font-semibold"><?php echo $cours->gettitle() ?></h3>
                        </div>
                        <div class="flex items-center mb-4">
                            <span class="text-gray-600">789 students</span>
                            <span class="text-gray-400 mx-2">•</span>
                            <?php  ?>
                            <span class="text-gray-600"></span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-purple-600 font-bold"><?php echo $cours->getprice() ?></span>
                            <div class="flex space-x-2">
                                <button class="text-blue-600 hover:text-blue-800">Edit</button>
                                <button class="text-gray-600 hover:text-gray-800">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>

            </div>
        </div>
    </div>
</body>
</html>