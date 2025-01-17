<?php
require_once '../classes/cours.php';
require_once '../classes/Tag.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_role']) || $_SESSION['user_status'] === 'suspended') {
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>LearnHub - Course Catalog</title>
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
                    <div class="cursor-pointer flex items-center space-x-2">
                        <img src="../imgs/profilephoto.png" alt="Profile Photo" class="h-8 rounded-full">
                        <!-- Dropdown Menu -->
                        <div class="absolute right-0 mt-32 w-56 bg-white rounded-lg shadow-xl py-2 invisible opacity-0 
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

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Search and Filters -->
        <div class="flex flex-col md:flex-row gap-4 mb-8">
            <div class="md:w-2/3">
                <input type="text" placeholder="Search courses..." class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>
            <div class="md:w-1/3 flex gap-2">
                <select class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500">
                    <option>Sort by: Most Popular</option>
                    <option>Highest Rated</option>
                    <option>Newest</option>
                    <option>Price: Low to High</option>
                    <option>Price: High to Low</option>
                </select>
            </div>
        </div>


            <!-- Course List -->
            <div class="">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                   <!-- Course Card 1 -->
                <?php 
                $cours = VideoCours::showAllCours();
                foreach($cours as $cour){
                ?>
                <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-300">
                    <!-- Course Thumbnail -->
                    <div class="relative">
                        <img src="<?php echo $cour->getcourseImage() ?>" alt="Course thumbnail" class="w-full h-48 object-cover"/>
                        <!-- course type -->
                        <?php if($cour->cours_type == 'video'){ ?>
                        <span class="absolute top-4 left-4 bg-white/90 px-2 py-1 rounded text-xs font-medium text-white bg-purple-600 rounded-full">
                            Video
                        </span>
                        <?php } else if ($cour->cours_type == 'document'){ ?>
                        <span class="absolute top-4 left-4 bg-white/90 px-2 py-1 rounded text-xs font-medium text-white bg-green-600 rounded-full">
                            document
                        </span>
                        <?php } ?>
                    </div>

                    <div class="p-6">
                        <!-- Course Title -->
                                    <div class="flex justify-between items-start mb-2">
                            <h3 class="font-semibold hover:text-purple-600 transition-colors">
                                <?php echo strlen($cour->gettitle()) > 40 ? substr($cour->gettitle(), 0, 40) . '...' : $cour->gettitle();?>
                            </h3>
                        </div>

                        <!-- Course Description -->
                        <p class="text-gray-600 text-sm mb-4">
                            <?php echo strlen($cour->getdescription()) > 100 ? substr($cour->getdescription(), 0, 50) . '...' : $cour->getdescription(); ?>
                        </p>

                        <!-- Instructor & Date -->
                        <div class="flex items-center mb-3">
                            <span class="text-sm text-gray-600">By <?php echo $cour->personName ?></span>
                            <span class="mx-2">•</span>
                            <span class="text-sm text-gray-600">Updated <?php echo (new DateTime($cour->creationdate))->format('F j, Y') ?></span>
                        </div>

                        <!-- Course Stats -->
                        <div class="flex items-center space-x-4 mb-4">
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                                12345 
                            </div>
                            <span class="mx-2">•</span>
                            <div>
                            <?php 
                            $tags = Tag::gettagsforCours($cour->getId());
                            foreach($tags as $tag){
                            ?>
                            <span class="bg-gray-100 px-3 py-1 rounded-full text-sm"><?php echo $tag->getname() ?></span>
                            <?php } ?>
                            </div>
                            
                        </div>

                        <!-- Price and Enroll Button -->
                        <div class="flex items-center justify-between mt-4">
                            <span class="text-lg font-bold text-purple-600"><?php echo $cour->getprice() ?>$</span>
                            <a href="../pages/CoursePreview.php?course_id=<?php echo $cour->getId() ?>"><button class="bg-purple-600 text-white px-6 py-2 rounded-full hover:bg-purple-700 transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50">
                                Enroll Now
                            </button></a>
                        </div>
                    </div>
                </div>
                <?php } ?>

                </div>

                <!-- Pagination -->
                <div class="flex justify-center mt-8">
                    <nav class="flex items-center space-x-2">
                        <button class="px-3 py-2 rounded-md bg-gray-100 text-gray-700 hover:bg-gray-200">Previous</button>
                        <button class="px-3 py-2 rounded-md bg-purple-600 text-white">1</button>
                        <button class="px-3 py-2 rounded-md hover:bg-gray-100">2</button>
                        <button class="px-3 py-2 rounded-md hover:bg-gray-100">3</button>
                        <button class="px-3 py-2 rounded-md hover:bg-gray-100">4</button>
                        <button class="px-3 py-2 rounded-md hover:bg-gray-100">5</button>
                        <button class="px-3 py-2 rounded-md bg-gray-100 text-gray-700 hover:bg-gray-200">Next</button>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</body>
</html>