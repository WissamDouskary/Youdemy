<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (isset($_SESSION['user_status']) && isset($_SESSION['user_role'])) {
    // Check if user is suspended
    if ($_SESSION['user_status'] === 'suspended') {
        header("Location: ../Youdemy/pages/status_banned.php");
        exit();
    }

    if ($_SESSION['user_role'] == 1) {
        header('Location: ../Youdemy/pages/adminDashboard.php');
        exit();
    } else if ($_SESSION['user_role'] == 2) {
        header('Location: ../Youdemy/pages/prof_dashboard.php');
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
    <script src="https://cdn.tailwindcss.com"></script>
    <title>YouDemy - Transform Your Future</title>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-lg fixed w-full z-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-20">
                <!-- Logo -->
                <div class="flex items-center space-x-2">
                    <span class="text-3xl font-bold text-purple-600">YouDemy</span>
                    <span class="hidden md:inline-block text-sm text-gray-500">| Learn Without Limits</span>
                </div>
                <!-- Navigation Links -->
                <ul class="hidden md:flex gap-8 text-gray-600">
                    <a href="../Youdemy/index.php" class="hover:text-purple-600 transition-colors"><li>Home</li></a>
                    <a href="../Youdemy/pages/cours.php" class="hover:text-purple-600 transition-colors"><li>Courses</li></a>
                </ul>
                
                <?php if (!isset($_SESSION['user_role'])): ?>
                <div class="flex items-center space-x-4">
                    <a href="./pages/login.php">
                        <button class="text-purple-700 hover:bg-purple-50 px-6 py-2 rounded-md transition-colors">Login</button>
                    </a>
                    <a href="./pages/sign_up.php">
                        <button class="bg-purple-600 text-white px-6 py-2 rounded-md hover:bg-purple-700 transition-colors shadow-md hover:shadow-lg">Sign Up</button>
                    </a>
                </div>
                <?php else: ?>
                <div class="flex items-center space-x-4 relative group">
                    <div class="cursor-pointer flex items-center space-x-2">
                        <img src="../Youdemy/imgs/profilephoto.png" alt="Profile Photo" class="h-10 w-10 rounded-full border-2 border-purple-200">
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
                            <a href="../Youdemy/Handling/AuthHandl.php" class="block px-4 py-3 text-sm text-red-600 hover:bg-red-50 flex items-center space-x-2">
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
                    confirmButtonText: 'OK',
                    confirmButtonColor: '#7C3AED'
                });
            </script>
        ";

        unset($_SESSION['message']);
    }
    ?>

    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-purple-900 to-purple-700 text-white pt-32 pb-20">
        <div class="max-w-7xl mx-auto px-4">
            <div class="md:w-2/3">
                <span class="text-purple-200 text-sm font-medium mb-2 block">WELCOME TO YOUDEMY</span>
                <h1 class="text-5xl font-bold mb-6 leading-tight">Transform Your Future With Expert-Led Learning</h1>
                <p class="text-xl mb-8 text-purple-100">Join millions of learners worldwide and master new skills with our comprehensive course library.</p>
                <div class="flex space-x-4">
                    <button class="bg-white text-purple-900 px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 transition-colors shadow-lg hover:shadow-xl">
                        Start Learning Now
                    </button>
                    <button class="border-2 border-white text-white px-8 py-4 rounded-lg font-semibold hover:bg-white hover:text-purple-900 transition-all">
                        Browse Courses
                    </button>
                </div>
                <div class="mt-12 flex items-center space-x-8">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-purple-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        <span class="ml-2">10K+ Courses</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-purple-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span class="ml-2">1M+ Students</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-purple-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                        </svg>
                        <span class="ml-2">4.8/5 Rating</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Categories -->
    <div class="max-w-7xl mx-auto px-4 py-20">
        <div class="flex justify-between items-center mb-12">
            <h2 class="text-3xl font-bold">Explore Top Categories</h2>
            <a href="#" class="text-purple-600 hover:text-purple-700 font-medium">View All Categories →</a>
        </div>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
            <div class="bg-white p-8 rounded-xl shadow-sm hover:shadow-md transition-all transform hover:-translate-y-1">
                <div class="text-4xl mb-6">💻</div>
                <h3 class="text-xl font-semibold mb-2">Programming</h3>
                <p class="text-gray-600">1,500+ courses</p>
                <div class="mt-4 text-purple-600">Learn More →</div>
            </div>
            <div class="bg-white p-8 rounded-xl shadow-sm hover:shadow-md transition-all transform hover:-translate-y-1">
                <div class="text-4xl mb-6">📊</div>
                <h3 class="text-xl font-semibold mb-2">Business</h3>
                <p class="text-gray-600">2,300+ courses</p>
                <div class="mt-4 text-purple-600">Learn More →</div>
            </div>
            <div class="bg-white p-8 rounded-xl shadow-sm hover:shadow-md transition-all transform hover:-translate-y-1">
                <div class="text-4xl mb-6">🎨</div>
                <h3 class="text-xl font-semibold mb-2">Design</h3>
                <p class="text-gray-600">980+ courses</p>
                <div class="mt-4 text-purple-600">Learn More →</div>
            </div>
            <div class="bg-white p-8 rounded-xl shadow-sm hover:shadow-md transition-all transform hover:-translate-y-1">
                <div class="text-4xl mb-6">📱</div>
                <h3 class="text-xl font-semibold mb-2">Marketing</h3>
                <p class="text-gray-600">1,200+ courses</p>
                <div class="mt-4 text-purple-600">Learn More →</div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white mt-12">
        <div class="max-w-7xl mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h4 class="text-lg font-semibold mb-4">Learn</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white">Browse Categories</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Skills Assessment</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Course Certificate</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Teach</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white">Become an Instructor</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Teaching Academy</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Instructor Guidelines</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">About</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white">About Us</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Careers</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Blog</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Support</h4>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white">Help Center</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Contact Us</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2025 LearnHub. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>