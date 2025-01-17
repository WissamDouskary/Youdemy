<?php
require_once '../classes/cours.php';
require_once '../classes/Tag.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
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
<body class="bg-gray-50">
    <!-- Main Content -->
    <div class="max-w-5xl mx-auto px-4 py-8">
        <!-- Course Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold mb-4"><?php echo $course->gettitle();?></h1>
            <div class="flex items-center space-x-4 text-gray-600">
                <span>By <?php echo $course->personName; ?></span>
                <span>•</span>
                <span>Updated <?php echo (new DateTime($course->creationdate))->format('F j, Y'); ?></span>
            </div>
        </div>

        <?php if($course->cours_type == 'video'):  ?>
        <!-- Video Content -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
            <div class="aspect-video bg-black rounded-lg mb-6">
                <video class="w-full h-full rounded-lg" controls>
                    <source src="<?php echo $course->getvedioUrl(); ?>" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        </div>
        <?php else: ?>
            <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
            <div class="aspect-video bg-black rounded-lg mb-6">
                <p><?php echo $course->getdocumentText(); ?></p>
            </div>
        </div>
        <?php endif; ?>
        

        <!-- Course Details -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h2 class="text-2xl font-semibold mb-4">About This Course</h2>
            <p class="text-gray-600 mb-6"><?php echo htmlspecialchars($course->getdescription(), ENT_QUOTES, 'UTF-8'); ?></p>
            
            <!-- Tags -->
            <div class="flex flex-wrap gap-2 mb-6">
                <?php 
                $tags = Tag::gettagsforCours($course->getId());
                foreach ($tags as $tag) {
                ?>
                <span class="bg-gray-100 px-3 py-1 rounded-full text-sm"><?php echo htmlspecialchars($tag->getname(), ENT_QUOTES, 'UTF-8'); ?></span>
                <?php } ?>
            </div>

            <!-- Price -->
            <div class="flex items-center text-purple-600 font-semibold">
                <span class="text-xl"><?php echo htmlspecialchars($course->getprice(), ENT_QUOTES, 'UTF-8'); ?>$</span>
            </div>
        </div>
    </div>
</body>
</html>
