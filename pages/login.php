<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auth Page</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <!-- Navigation bar -->
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <span class="text-2xl font-bold text-purple-600">YouDemy</span>
                </div>
                <ul class="flex gap-9">
                    <a href="../index.php"><li>Home</li></a>
                    <a href="../pages/cours.php"><li>Cours</li></a>
                </ul>
                <div class="flex items-center space-x-4">
                    <a href="../pages/login.php"><button class="bg-purple-600 text-white px-4 py-2 rounded-md hover:bg-purple-700">Autentification</button></a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Auth Container -->
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 bg-white p-8 rounded-lg shadow-md">
            <!-- Tabs -->
            <div class="flex border-b">
                <button onclick="showLogin()" id="loginTab" class="px-6 py-2 font-medium text-blue-600 border-b-2 border-blue-600">Login</button>
                <button onclick="showSignup()" id="signupTab" class="px-6 py-2 font-medium text-gray-500 hover:text-blue-600">Sign Up</button>
            </div>

            <!-- Login Form -->
            <div id="loginForm">
                <form class="space-y-6">
                    <div>
                        <label for="login-email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="login-email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="login-password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" id="login-password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Login
                        </button>
                    </div>
                </form>
            </div>

            <!-- Sign Up Form -->
            <div id="signupForm" class="hidden">
                <form class="space-y-6">
                    <div>
                        <label for="signup-name" class="block text-sm font-medium text-gray-700">Full Name</label>
                        <input type="text" id="signup-name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="signup-email" class="block text-sm font-medium text-gray-700">Email</label>
                        <input type="email" id="signup-email" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <label for="user-role" class="block text-sm font-medium text-gray-700">Role</label>
                        <select id="user-role" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <option value="student">Etudiant</option>
                            <option value="teacher">Teacher</option>
                        </select>
                    </div>
                    <div>
                        <label for="signup-password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input type="password" id="signup-password" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div>
                        <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Sign Up
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function showLogin() {
            document.getElementById('loginForm').classList.remove('hidden');
            document.getElementById('signupForm').classList.add('hidden');
            document.getElementById('loginTab').classList.add('text-blue-600', 'border-b-2', 'border-blue-600');
            document.getElementById('loginTab').classList.remove('text-gray-500');
            document.getElementById('signupTab').classList.remove('text-blue-600', 'border-b-2', 'border-blue-600');
            document.getElementById('signupTab').classList.add('text-gray-500');
        }

        function showSignup() {
            document.getElementById('signupForm').classList.remove('hidden');
            document.getElementById('loginForm').classList.add('hidden');
            document.getElementById('signupTab').classList.add('text-blue-600', 'border-b-2', 'border-blue-600');
            document.getElementById('signupTab').classList.remove('text-gray-500');
            document.getElementById('loginTab').classList.remove('text-blue-600', 'border-b-2', 'border-blue-600');
            document.getElementById('loginTab').classList.add('text-gray-500');
        }
    </script>
</body>
</html>