<?php
require_once '../classes/category.php';

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 2) {
    header('Location: ../index.php');
    exit();
}

if ($_SESSION['user_status'] === 'waiting') {
    header("Location: ../pages/status_pending.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" integrity="sha512-xmGTNt20S0t62wHLmQec2DauG9T+owP9e6VU8GigI0anN7OXLip9i7IwEhelasml2osdxX71XcYm6BQunTQeQg==" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js" integrity="sha512-9UR1ynHntZdqHnwXKTaOm1s6V9fExqejKvg5XMawEMToW4sSw+3jtLrYfZPijvnwnnE8Uol1O9BcAskoxgec+g==" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>YouDemy - Create Course</title>
    <style>
        .bootstrap-tagsinput .tag {
            background: red;
            padding: 4px;
            font-size: 14px;
        }
    </style>
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
                    <span class="text-gray-600"><?php echo $_SESSION['user_nom'] . " " . $_SESSION['user_prenom'] ?></span>
                    <a href="../Handling/AuthHandl.php"><button class="text-gray-600 hover:text-gray-900">Logout</button></a>
                </div>
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

                <form class="space-y-8" method="post" action="../Handling/courseHandl.php" enctype="multipart/form-data">
                    <!-- Basic Information -->
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <h2 class="text-xl font-semibold mb-6">Basic Information</h2>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Course Title</label>
                                <input type="text" name="course_title" class="w-full p-2 border rounded-md" placeholder="Enter course title"/>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Course Image</label>
                                <input type="file" name="course_image" class="w-full p-2 border rounded-md" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Course Description</label>
                                <textarea name="course_description" class="w-full p-2 border rounded-md h-32" placeholder="Enter course description"></textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tags</label>
                                <input name="tags" id="tagsInput" type="text" class="w-full p-2 border rounded-md" placeholder="Enter course Tags"/>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                                    <select class="w-full p-2 border rounded-md" name="categories_select">
                                        <?php
                                        $rows = Category::showCategories();
                                        foreach($rows as $row){ ?>
                                        <option value="<?php echo $row['category_id'] ?>"><?php echo $row['name'] ?></option>
                                        <?php } ?>
                                        
                                    </select>
                                </div>
                                <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Course Type:</label>
                                    <select name="course_type" id="course_type" class="w-full p-2 border rounded-md" required onchange="toggleFields()">
                                        <option value="video">Video</option>
                                        <option value="document">Document</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Course Content -->
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <h2 class="text-xl font-semibold mb-6">Course Content</h2>
                           
                        <div id="video_fields" style="display:none;">
                            <label for="video_file" class="block text-sm font-medium text-gray-700 mb-2">Upload Video (MP4 only):</label>
                            <input type="file" name="video_file" class="w-full p-2 border rounded-md" accept="video/mp4"><br>
                        </div>

                        <div id="document_fields" style="display:none;">
                            <label for="document_content" class="block text-sm font-medium text-gray-700 mb-2">Document Content (Text):</label>
                            <textarea placeholder="Enter Your Course Content.." name="document_content" rows="10" cols="50" class="w-full p-2 border rounded-md"></textarea><br>
                        </div>
                    </div>

                    <!-- Pricing -->
                    <div class="bg-white p-6 rounded-lg shadow-sm">
                        <h2 class="text-xl font-semibold mb-6">Pricing</h2>
                        <div class="space-y-4">
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Price ($)</label>
                                    <input type="number" name="course_price" class="w-full p-2 border rounded-md" placeholder="Enter price"/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex justify-end space-x-4">
                        <button type="submit" name="CreateCourseSub" class="bg-purple-600 text-white px-6 py-2 rounded-md hover:bg-purple-700">
                            Publish Course
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
    function toggleFields() {
        const courseType = document.getElementById('course_type').value;
        
        if (courseType === 'video') {
            document.getElementById('video_fields').style.display = 'block';
            document.getElementById('document_fields').style.display = 'none';
        } else if (courseType === 'document') {
            document.getElementById('video_fields').style.display = 'none';
            document.getElementById('document_fields').style.display = 'block';
        }
    }

    window.onload = toggleFields;

  $(document).ready(function () {

    $('#tagsInput').tagsinput();
  });
</script>
</body>
</html>