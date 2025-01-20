<?php
require_once '../classes/cours.php';
require_once '../classes/Tag.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(!isset($_SESSION['user_role'])){
    $_SESSION['message'] = [
        'type' => 'info',
        'text' => 'please login or sign up to view cour!'
    ];
    header('Location: ../pages/cours.php');
    exit();
}

$course_id = $_GET['course_id'] ?? null;
$course = Cours::getCourseById($course_id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>YouDemy - Course View</title>
</head>
<body class="bg-white">
    <!-- Navigation -->
    <nav class="bg-white border-b border-gray-200 fixed w-full z-10">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <span class="text-2xl font-bold text-purple-600">YouDemy</span>
                </div>
                <!-- Navigation Links -->
                <ul class="flex gap-9">
                    <a href="../index.php" class="hover:text-purple-600 transition-colors font-medium"><li>Home</li></a>
                    <a href="../pages/cours.php" class="hover:text-purple-600 transition-colors font-medium"><li>Courses</li></a>
                    <a href="../pages/enrolledCours.php" class="hover:text-purple-600 transition-colors font-medium"><li>My Enrolled</li></a>
                </ul>
                
                <?php if (!isset($_SESSION['user_role'])): ?>
                <div class="flex items-center space-x-4">
                    <a href="../pages/login.php">
                        <button class="text-purple-700 hover:bg-purple-50 px-4 py-2 rounded-lg transition-all duration-300 font-medium">Login</button>
                    </a>
                    <a href="../pages/sign_up.php">
                        <button class="bg-purple-600 text-white px-6 py-2 rounded-lg hover:bg-purple-700 transition-all duration-300 font-medium">Sign Up</button>
                    </a>
                </div>
                <?php else: ?>
                    <div class="flex items-center space-x-4 relative group">
                        <div class="cursor-pointer flex items-center space-x-3">
                            <img src="../imgs/profilephoto.png" alt="Profile Photo" class="h-9 w-9 rounded-full object-cover">
                            <div class="absolute right-0 mt-32 w-64 bg-white rounded-xl shadow-xl py-2 invisible opacity-0 
                                        group-hover:visible group-hover:opacity-100 transition-all duration-300 ease-in-out">
                                <a href="#" class="block px-4 py-3 text-sm text-gray-700 hover:bg-purple-50 flex items-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    <span>Profile</span>
                                </a>
                                <a href="#" class="block px-4 py-3 text-sm text-gray-700 hover:bg-purple-50 flex items-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    <span>Settings</span>
                                </a>
                                <div class="border-t border-gray-100 my-2"></div>
                                <a href="../Handling/AuthHandl.php" class="block px-4 py-3 text-sm text-red-600 hover:bg-red-50 flex items-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                    <span>Logout</span>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- Course Header Bar -->
    <div class="bg-gray-900 pt-16">
        <div class="max-w-7xl mx-auto px-4 py-8">
            <h1 class="text-2xl font-bold text-white mb-4"><?php echo $course->gettitle();?></h1>
            <div class="flex items-center space-x-4 text-gray-300 text-sm">
                <div class="flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span><?php echo $course->personName; ?></span>
                </div>
                <span>•</span>
                <span>Last updated <?php echo (new DateTime($course->creationdate))->format('M Y'); ?></span>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 py-8">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Left Column - Course Content -->
            <div class="lg:w-2/3">

                <div class="bg-white rounded-lg border border-gray-200 p-6 mb-8 flex justify-center items-center">
                    <div class="prose max-w-none ">
                        <a href="../Handling/enrollHandle.php?course_id=<?php echo $course->getId() ?>" class="bg-purple-600 text-white px-6 py-2 rounded-full hover:bg-purple-700 transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50"><button>Enroll Now</button></a>
                    </div>
                </div>

                <!-- Course Description -->
                <div class="bg-white rounded-lg border border-gray-200 p-6">
                    <h2 class="text-xl font-bold mb-4">About This Course</h2>
                    <div class="prose max-w-none">
                        <p class="text-gray-700 leading-relaxed"><?php echo htmlspecialchars($course->getdescription(), ENT_QUOTES, 'UTF-8'); ?></p>
                    </div>
                </div>
            </div>

            <!-- Right Column - Course Details -->
            <div class="lg:w-1/3">
                <div class="bg-white rounded-lg border border-gray-200 p-6 sticky top-20">
                    <h3 class="text-lg font-bold mb-4">Course Content</h3>
                    
                    <!-- Course Features -->
                    <div class="space-y-4 mb-6">
                        <div class="flex items-center space-x-3 text-sm">
                            <span><?php echo $course->getdescription() ?></span>
                        </div>
                    </div>

                    <!-- Tags Section -->
                    <div class="mb-6">
                        <h4 class="text-sm font-semibold mb-2">Topics</h4>
                        <div class="flex flex-wrap gap-2">
                            <?php 
                            $tags = Tag::gettagsforCours($course->getId());
                            foreach ($tags as $tag) {
                            ?>
                            <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs font-medium"><?php echo htmlspecialchars($tag->getname(), ENT_QUOTES, 'UTF-8'); ?></span>
                            <?php } ?>
                        </div>
                    </div>

                    <!-- Already Enrolled Notice -->
                    <div class="bg-purple-50 border border-purple-100 rounded-lg p-4 text-center">
                        <span class="text-purple-700 font-medium">Please enrole to see full course</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>