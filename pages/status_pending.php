<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Account Pending - YouDemy</title>
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Navigation -->
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <span class="text-2xl font-bold text-purple-600">YouDemy</span>
                </div>
                <div class="flex items-center space-x-4">
                <a href="../Handling/AuthHandl.php"><button type="submit" name="logout"
                        class="bg-gray-100 text-gray-700 px-6 py-2 rounded-md hover:bg-gray-200 transition-colors duration-200">
                    Logout
                </button></a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Status Pending Content -->
    <div class="max-w-2xl mx-auto mt-20 px-4">
        <div class="bg-white rounded-lg shadow-md p-8 text-center">
            <div class="mb-6">
                <!-- Pending Animation Circle -->
                <div class="mx-auto w-24 h-24 rounded-full border-4 border-purple-200 border-t-purple-600 animate-spin"></div>
            </div>
            
            <h1 class="text-2xl font-bold text-gray-800 mb-4">Account Pending Approval</h1>
            
            <div class="space-y-4 text-gray-600">
                <p>Thank you for registering with YouDemy! Your account is currently under review.</p>
                <p>Our team will verify your information and activate your account soon.</p>
                
                <div class="bg-purple-50 rounded-lg p-6 mt-6">
                    <h2 class="font-semibold text-purple-800 mb-2">What happens next?</h2>
                    <ul class="text-left text-purple-700 space-y-2">
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            Our team will review your application
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            You'll receive an email when your account is activated
                        </li>
                        <li class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            You can then log in and access all features
                        </li>
                    </ul>
                </div>

                <div class="mt-8 p-4 bg-blue-50 rounded-lg">
                    <p class="text-blue-700">Expected approval time: <span class="font-semibold">24-48 hours</span></p>
                </div>

                <div class="mt-8">
                    <p class="text-sm text-gray-500">Need help? Contact our support team at</p>
                    <a href="mailto:douskary.wissam@gmail.com" class="text-purple-600 hover:text-purple-700 font-medium">support@youdemy.com</a>
                </div>
            </div>

            <div class="mt-8">
                <a href="../Handling/AuthHandl.php"><button type="submit" name="logout"
                        class="bg-gray-100 text-gray-700 px-6 py-2 rounded-md hover:bg-gray-200 transition-colors duration-200">
                    Logout
                </button></a>
            </div>
        </div>
    </div>

    <!-- Simple Footer -->
    <footer class="mt-20 pb-8">
        <div class="text-center text-gray-500 text-sm">
            <p>&copy; 2025 YouDemy. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>