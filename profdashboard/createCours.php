<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title>YouDemy - Create Course</title>
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
                    <span class="text-gray-600">Professor Smith</span>
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
                    <a href="../pages/createCours.php"><li class="bg-purple-100 text-purple-700 p-2 rounded">Create Course</li></a>
                    <a href="../profdashboard/myCourse.php"><li class="text-gray-600 hover:bg-purple-50 p-2 rounded">My Cours</li></a>
                </ul>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-8">
            <div class="max-w-4xl mx-auto">
                <h1 class="text-2xl font-bold mb-8">Create New Course</h1>

                <form class="space-y-8">
                    <!-- Basic Information -->
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <h2 class="text-xl font-semibold mb-6">Basic Information</h2>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Course Title</label>
                                <input type="text" class="w-full p-2 border rounded-md" placeholder="Enter course title"/>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Course Description</label>
                                <textarea class="w-full p-2 border rounded-md h-32" placeholder="Enter course description"></textarea>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                                    <select class="w-full p-2 border rounded-md">
                                        <option>Programming</option>
                                        <option>Business</option>
                                        <option>Design</option>
                                        <option>Marketing</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Level</label>
                                    <select class="w-full p-2 border rounded-md">
                                        <option>Beginner</option>
                                        <option>Intermediate</option>
                                        <option>Advanced</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Course Content -->
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <h2 class="text-xl font-semibold mb-6">Course Content</h2>
                        <div class="space-y-4">
                            <button class="bg-purple-600 text-white px-4 py-2 rounded-md hover:bg-purple-700">
                                Add New Section
                            </button>

                            <!-- Sample Section -->
                            <div class="border rounded-md p-4">
                                <div class="flex justify-between items-center mb-4">
                                    <input type="text" class="border-none bg-gray-50 p-2 rounded" placeholder="Section Title"/>
                                    <button class="text-red-600 hover:text-red-800">Remove</button>
                                </div>
                                <div class="space-y-2">
                                    <div class="flex items-center justify-between bg-gray-50 p-2 rounded">
                                        <span>Introduction Video</span>
                                        <div class="flex space-x-2">
                                            <button class="text-blue-600 hover:text-blue-800">Edit</button>
                                            <button class="text-red-600 hover:text-red-800">Delete</button>
                                        </div>
                                    </div>
                                    <button class="text-purple-600 hover:text-purple-800 text-sm">
                                        + Add Lecture
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pricing -->
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <h2 class="text-xl font-semibold mb-6">Pricing</h2>
                        <div class="space-y-4">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Price ($)</label>
                                    <input type="number" class="w-full p-2 border rounded-md" placeholder="Enter price"/>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Discount (%)</label>
                                    <input type="number" class="w-full p-2 border rounded-md" placeholder="Enter discount"/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex justify-end space-x-4">
                        <button class="bg-gray-200 text-gray-700 px-6 py-2 rounded-md hover:bg-gray-300">
                            Save Draft
                        </button>
                        <button class="bg-purple-600 text-white px-6 py-2 rounded-md hover:bg-purple-700">
                            Publish Course
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>