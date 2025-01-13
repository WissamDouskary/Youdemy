<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>LearnHub - Online Courses</title>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <span class="text-2xl font-bold text-purple-600">YouDemy</span>
                </div>
                <ul class="flex gap-9">
                    <a href="./index.php"><li>Home</li></a>
                    <a href="../Youdemy/pages/cours.php"><li>Cours</li></a>
                </ul>
                <div class="flex items-center space-x-4">
                <button class="bg-purple-600 text-white px-4 py-2 rounded-md hover:bg-purple-700">Autentification</button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="bg-purple-900 text-white py-16">
        <div class="max-w-7xl mx-auto px-4">
            <div class="md:w-2/3">
                <h1 class="text-4xl font-bold mb-4">Learn on your schedule</h1>
                <p class="text-xl mb-8">Study any topic, anytime. Choose from thousands of expert-led courses now.</p>
                <button class="bg-white text-purple-900 px-6 py-3 rounded-md font-semibold hover:bg-gray-100">
                    Explore Courses
                </button>
            </div>
        </div>
    </div>

    <!-- Categories -->
    <div class="max-w-7xl mx-auto px-4 py-12">
        <h2 class="text-2xl font-bold mb-8">Top Categories</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow">
                <div class="text-3xl mb-4">💻</div>
                <h3 class="font-semibold">Programming</h3>
                <p class="text-gray-600">1,500 courses</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow">
                <div class="text-3xl mb-4">📊</div>
                <h3 class="font-semibold">Business</h3>
                <p class="text-gray-600">2,300 courses</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow">
                <div class="text-3xl mb-4">🎨</div>
                <h3 class="font-semibold">Design</h3>
                <p class="text-gray-600">980 courses</p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition-shadow">
                <div class="text-3xl mb-4">📱</div>
                <h3 class="font-semibold">Marketing</h3>
                <p class="text-gray-600">1,200 courses</p>
            </div>
        </div>
    </div>

    <!-- Featured Courses -->
    <div class="max-w-7xl mx-auto px-4 py-12">
        <h2 class="text-2xl font-bold mb-8">Featured Courses</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <img src="/api/placeholder/400/200" alt="Course thumbnail" class="w-full h-48 object-cover"/>
                <div class="p-6">
                    <h3 class="font-semibold mb-2">Complete Web Development Bootcamp</h3>
                    <p class="text-gray-600 mb-4">Learn web development from scratch</p>
                    <div class="flex items-center justify-between">
                        <span class="text-purple-600 font-bold">$89.99</span>
                        <div class="flex items-center">
                            <span class="text-yellow-400">★★★★★</span>
                            <span class="text-gray-600 ml-1">(4.8)</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <img src="/api/placeholder/400/200" alt="Course thumbnail" class="w-full h-48 object-cover"/>
                <div class="p-6">
                    <h3 class="font-semibold mb-2">Digital Marketing Masterclass</h3>
                    <p class="text-gray-600 mb-4">Master digital marketing strategies</p>
                    <div class="flex items-center justify-between">
                        <span class="text-purple-600 font-bold">$79.99</span>
                        <div class="flex items-center">
                            <span class="text-yellow-400">★★★★★</span>
                            <span class="text-gray-600 ml-1">(4.7)</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <img src="/api/placeholder/400/200" alt="Course thumbnail" class="w-full h-48 object-cover"/>
                <div class="p-6">
                    <h3 class="font-semibold mb-2">UI/UX Design Fundamentals</h3>
                    <p class="text-gray-600 mb-4">Create beautiful user interfaces</p>
                    <div class="flex items-center justify-between">
                        <span class="text-purple-600 font-bold">$69.99</span>
                        <div class="flex items-center">
                            <span class="text-yellow-400">★★★★★</span>
                            <span class="text-gray-600 ml-1">(4.9)</span>
                        </div>
                    </div>
                </div>
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