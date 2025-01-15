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
                    <span class="text-gray-600">Welcome, Professor Smith</span>
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
                    <a href="../profdashboard/createCours.php" class="bg-purple-600 text-white px-4 py-2 rounded-md hover:bg-purple-700">
                        Create New Course
                    </a>
                </div>
            </div>

            <!-- Course Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Course Card 1 -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <img src="/api/placeholder/400/200" alt="Course thumbnail" class="w-full h-48 object-cover"/>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="font-semibold">Complete Web Development Bootcamp</h3>
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-sm">Active</span>
                        </div>
                        <div class="flex items-center mb-4">
                            <span class="text-yellow-400">★★★★★</span>
                            <span class="text-gray-600 ml-1">(4.8)</span>
                            <span class="text-gray-400 mx-2">•</span>
                            <span class="text-gray-600">789 students</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-purple-600 font-bold">$89.99</span>
                            <div class="flex space-x-2">
                                <button class="text-blue-600 hover:text-blue-800">Edit</button>
                                <button class="text-gray-600 hover:text-gray-800">Manage</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Course Card 2 -->
                <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                    <img src="/api/placeholder/400/200" alt="Course thumbnail" class="w-full h-48 object-cover"/>
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <h3 class="font-semibold">Python Basics for Beginners</h3>
                            <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-sm">Active</span>
                        </div>
                        <div class="flex items-center mb-4">
                            <span class="text-yellow-400">★★★★★</span>
                            <span class="text-gray-600 ml-1">(4.7)</span>
                            <span class="text-gray-400 mx-2">•</span>
                            <span class="text-gray-600">645 students</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-purple-600 font-bold">$69.99</span>
                            <div class="flex space-x-2">
                                <button class="text-blue-600 hover:text-blue-800">Edit</button>
                                <button class="text-gray-600 hover:text-gray-800">Manage</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>