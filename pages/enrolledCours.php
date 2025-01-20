<?php
require_once '../classes/cours.php';
require_once '../classes/Etudiant.php';

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}



if (isset($_SESSION['user_status']) && isset($_SESSION['user_role'])) {
    
    if ($_SESSION['user_status'] === 'suspended') {
        header("Location: ../pages/status_banned.php");
        exit();
    }

    if ($_SESSION['user_role'] == 1) {
        header('Location: ../pages/adminDashboard.php');
        exit();
    } else if ($_SESSION['user_role'] == 2) {
        header('Location: ../pages/prof_dashboard.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>LearnHub - My Enrolled Courses</title>
</head>
<body class="bg-gray-50">



    <!-- Navigation -->
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <span class="text-2xl font-bold text-purple-600">YouDemy</span>
                </div>
                <!-- Navigation Links -->
                <ul class="flex gap-9">
                    <a href="../index.php"><li>Home</li></a>
                    <a href="../pages/cours.php"><li>Courses</li></a>
                    <a href="../pages/enrolledCours.php" class="hover:text-purple-600 transition-colors"><li>My Enrolled</li></a>
                </ul>
                
                <?php if (!isset($_SESSION['user_role'])): ?>
            <div class="flex items-center space-x-4">
                <a href="../pages/login.php">
                    <button class="text-purple-700 px-4 py-2 rounded-md">Login</button>
                </a>
                <a href="../pages/sign_up.php">
                    <button class="bg-purple-600 text-white px-4 py-2 rounded-md hover:bg-purple-700">Sign Up</button>
                </a>
            </div>
            <?php else: ?>
                <div class="flex items-center space-x-4 relative group">
                            <a href="../Handling/AuthHandl.php" class="block px-4 py-3 text-sm text-red-600 hover:bg-red-50 flex items-center space-x-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                <span>Logout</span>
                            </a>
                    </div>
                </div>
            <?php endif; ?>
            </div>
        </div>
    </nav>

    <?php if(!isset($_SESSION['user_id'])): ?>
    <div class="flex justify-center items-center ">
    <div class="flex flex-col justify-center items-center mt-72 gap-6">
        <p>You cannot add or Show Your enrolled Courses, Make sure you have log in success !</p>
        <a href="../pages/sign_up.php"><button class="w-36 bg-purple-600 text-white px-6 py-2 rounded-full hover:bg-purple-700 transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50">
            Sign up
        </button></a>
    </div>
    </div>
    <?php else: ?>
    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Page Title -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800">My Enrolled Courses</h1>
        </div>

        <!-- Search -->
        <!-- <div class="mb-8">
            <input type="text" placeholder="Search your enrolled courses..." class="w-full max-w-md px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">
        </div> -->

        <!-- Course List -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Course Card -->
            <?php 
            $courses = Etudiant::getEnrolledCourses($_SESSION['user_id']);
            foreach($courses as $cour){
            ?>
            <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-300">
                <div class="relative">
                    <img src="<?php echo $cour->getcourseImage() ?>" alt="Course thumbnail" class="w-full h-48 object-cover"/>
                    <?php if($cour->cours_type == 'video'): ?>
                    <span class="absolute top-4 left-4 bg-white/90 px-2 py-1 rounded text-xs font-medium text-white bg-purple-600 rounded-full">
                        <?php echo $cour->cours_type ?>
                    </span>
                    <?php elseif($cour->cours_type == 'document'): ?>
                    <span class="absolute top-4 left-4 bg-white/90 px-2 py-1 rounded text-xs font-medium text-white bg-green-600 rounded-full">
                        <?php echo $cour->cours_type ?>
                    </span>
                    <?php endif; ?>
                </div>

                <div class="p-6">
                    <h3 class="font-semibold mb-2 hover:text-purple-600 transition-colors">
                        <?php echo strlen($cour->gettitle()) > 40 ? substr($cour->gettitle(), 0, 40) . '...' : $cour->gettitle();?>
                    </h3>
                    <p class="text-gray-600 text-sm mb-4">
                        <?php echo strlen($cour->getdescription()) > 100 ? substr($cour->getdescription(), 0, 50) . '...' : $cour->getdescription(); ?>
                    </p>
                    
                    <div class="flex items-center mb-4">
                        <span class="text-sm text-gray-600">By <?php echo $cour->personName ?></span>
                        <span class="mx-2">•</span>
                        <span class="text-sm text-gray-600">Enrolled <?php echo (new DateTime($cour->creationdate))->format('F j, Y') ?></span>
                    </div>

                    <a href="../pages/CoursePreview.php?course_id=<?php echo $cour->getId() ?>"><button class="w-full bg-purple-600 text-white px-6 py-2 rounded-full hover:bg-purple-700 transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50">
                        View Course
                    </button></a>
                </div>
            </div>
            <?php } ?>

        </div>

    </div>
    <?php endif; ?>
    
</body>
</html>