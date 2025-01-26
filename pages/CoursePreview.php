<?php
require_once '../classes/cours.php';
require_once '../classes/Tag.php';
require_once '../classes/comments.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$course_id = $_GET['course_id'] ?? null;
$course = Cours::getCourseById($course_id);

if($course_id == null){
    header('Location: ../index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
                                <a href="../Handling/AuthHandl.php" class="block px-4 py-3 text-sm text-red-600 hover:bg-red-50 hover:rounded_full flex items-center space-x-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                    <span>Logout</span>
                                </a>
                        </div>
                    </div>
                <?php endif; ?>
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
                <?php if($course->cours_type == 'video'):  ?>
                <!-- Video Player -->
                <div class="bg-black rounded-lg overflow-hidden mb-8 ">
                    <div class="aspect-video">
                        <video class="w-full h-full" controls>
                            <source src="<?php echo $course->getvedioUrl(); ?>" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                </div>
                <?php else: ?>
                <div class="bg-white rounded-lg border border-gray-200 p-6 mb-8">
                    <div class="prose max-w-none">
                        <p class="text-gray-700 leading-relaxed"><?php echo $course->getdocumentText(); ?></p>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Course Description -->
                <div class="bg-white rounded-lg border border-gray-200 p-6">
                    <h2 class="text-xl font-bold mb-4">About This Course</h2>
                    <div class="prose max-w-none">
                        <p class="text-gray-700 leading-relaxed"><?php echo htmlspecialchars($course->getdescription(), ENT_QUOTES, 'UTF-8'); ?></p>
                    </div>
                </div>

                <div class="bg-white rounded-lg border border-gray-200 p-6 mt-6">
                    <h2 class="text-xl font-bold mb-4">Submit comment</h2>
                    <form action="../Handling/commentsHandl.php" method="POST" class="flex flex-col gap-6 justify-center items-start">
                        <textarea type="text" class="w-full border border-gray-400 h-40 rounded-lg outline-none p-2 focus:border-purple-400" placeholder="add comment ..." name="typedcomment"></textarea>
                        <input type="submit" value="Comment" class="p-2 bg-purple-600 text-white rounded-full px-6 cursor-pointer">
                        <input type="hidden" value="<?php echo $course_id ?>" name="course_id">
                    </form>
                </div>

                <!-- Comments List -->
                <div class="space-y-6 bg-white rounded-lg border border-gray-200 p-6 mt-6">
                    <!-- Single Comment -->
                        <?php
                        $comms = comments::showComments($course_id);
                        foreach ($comms as $com){
                        ?>
                        <div class="border-b pb-6">
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center space-x-3">
                                    <div class="">
                                        <p class="font-semibold"><?php echo $com->comUser ?></p>
                                    </div>
                                </div>
                                    <div class="flex space-x-2 text-sm">
                                        <a href="../handling/delete_comment.php?comment_id=&article_name="><button class="text-red-500 hover:text-red-700">Delete</button></a>
                                    </div>
                            </div>
                            <p class="text-gray-600">
                               <?php echo $com->getContent() ?>
                            </p>
                        </div>
                    <?php }
                    ?>
                </div>
            </div>

            <!-- Right Column - Course Details -->
            <div class="lg:w-1/3">
                <div class="bg-white rounded-lg border border-gray-200 p-6">
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
                        <span class="text-purple-700 font-medium">✓ You're enrolled in this course</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>