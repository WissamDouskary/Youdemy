<?php
require_once '../classes/Teacher.php';
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>YouDemy - Professor Dashboard</title>
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
                    <span class="text-gray-600">Welcome, <?php echo $_SESSION['user_nom'] . " " . $_SESSION['user_prenom'] ?></span>
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

    <div class="flex">
        <!-- Sidebar -->
        <div class="w-64 bg-white shadow-md h-screen">
            <div class="p-4">
                <ul class="space-y-2">
                    <a href="../pages/prof_dashboard.php"><li class="bg-purple-100 text-purple-700 p-2 rounded">Dashboard</li></a>
                    <a href="../profdashboard/createCours.php"><li class="text-gray-600 hover:bg-purple-50 p-2 rounded">Create Course</li></a>
                    <a href="../profdashboard/myCourse.php"><li class="text-gray-600 hover:bg-purple-50 p-2 rounded">My Cours</li></a>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <h1 class="text-2xl font-bold mb-8">Dashboard Overview</h1>
            
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <h3 class="text-gray-500 text-sm mb-1">Total Students</h3>
                    <p class="text-3xl font-bold"><?php echo Teacher::GetTotalEnrolledStudents($_SESSION['user_id']) ?></p>
                </div>
                <div class="bg-white p-6 rounded-lg shadow-sm">
                    <h3 class="text-gray-500 text-sm mb-1">Active Courses</h3>
                    <p class="text-3xl font-bold"><?php echo Teacher::GetTotalCourses($_SESSION['user_id']) ?></p>
                </div>
            </div>
            <!-- Popular Courses -->
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h2 class="text-xl font-bold mb-4">Your Popular Courses</h2>
                <div class="space-y-4">

                    <div class="flex items-center justify-between">
                        <div>
                        <?php 
                        $cours = Teacher::GetMostEnrolledCourses($_SESSION['user_id']);
                        foreach($cours as $cour){
                        ?>
                        <div class="flex items-center mb-2">
                            <img src="<?php echo $cour->courseimage ?>" alt="Course" class="w-12 h-12 rounded object-cover mr-4"/>
                            <div>
                                <p class="font-semibold"><?php echo $cour->title ?></p>
                                <p class="text-gray-500"><?php echo $cour->enrollments_count ?> students</p>
                            </div>
                        </div>
                        <?php } ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>
</html>