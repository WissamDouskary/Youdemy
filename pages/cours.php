<?php
require_once '../classes/cours.php';

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
                <div class="cursor-pointer">
                    <img src="../Youdemy/imgs/profilephoto.png" alt="Profile Photo" class="h-7">
                    <!-- Dropdown Menu -->
                    <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 invisible opacity-0 
                                group-hover:visible group-hover:opacity-100 transition-all duration-300 ease-in-out 
                                transform group-hover:translate-y-0 translate-y-1">
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-50">Profile</a>
                        <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-purple-50">Settings</a>
                        <div class="border-t border-gray-100"></div>
                        <a href="../Handling/AuthHandl.php" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50">Logout</a>
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
                    
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                        <img src="/api/placeholder/400/200" alt="Course thumbnail" class="w-full h-48 object-cover"/>
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="font-semibold">Complete Web Development Bootcamp</h3>
                                <span class="bg-purple-100 text-purple-800 text-xs px-2 py-1 rounded">Bestseller</span>
                            </div>
                            <p class="text-gray-600 text-sm mb-2">Learn web development from scratch with HTML, CSS, JavaScript, React, and Node.js</p>
                            <div class="flex items-center mb-2">
                                <span class="text-sm text-gray-600">By John Smith</span>
                                <span class="mx-2">•</span>
                                <span class="text-sm text-gray-600">Updated January 2025</span>
                            </div>
                            <div class="flex items-center mb-2">
                                <span class="text-yellow-400">★★★★★</span>
                                <span class="text-sm text-gray-600 ml-1">(4.8) • 12,345 students</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-lg font-bold text-purple-600">$89.99</span>
                                <button class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">Add to Cart</button>
                            </div>
                        </div>
                    </div>
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