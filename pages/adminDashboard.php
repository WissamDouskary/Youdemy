<?php
require_once '../classes/admin.php';
require_once '../classes/category.php';
require_once '../classes/cours.php';
require_once '../classes/Teacher.php';
require_once '../classes/Tag.php';

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] != 1) {
    header('Location: ../index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" integrity="sha512-xmGTNt20S0t62wHLmQec2DauG9T+owP9e6VU8GigI0anN7OXLip9i7IwEhelasml2osdxX71XcYm6BQunTQeQg==" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js" integrity="sha512-9UR1ynHntZdqHnwXKTaOm1s6V9fExqejKvg5XMawEMToW4sSw+3jtLrYfZPijvnwnnE8Uol1O9BcAskoxgec+g==" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- DataTables CDN (CSS) -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.dataTables.css" />

<!-- jQuery and DataTables JS (JavaScript) -->
<script src="https://cdn.datatables.net/2.2.1/js/dataTables.min.js"></script>



    <title>YouDemy - Admin Dashboard</title>
    <style>
        .bg-primary { background-color: #7b39ed; }
        .modal.active {
            display: flex;
        }
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
        }
        .bootstrap-tagsinput {
            display: flex;
            flex-wrap: wrap;
            border: 1px solid #ccc;
            background-color: #fff;
            padding: 2px 8px;
            min-height: 36px;
            z-index: 9999;
        }

        .bootstrap-tagsinput .tag {
            background-color: #007bff;
            color: white;
            border-radius: 4px;
            margin: 2px;
            padding: 4px 8px;
        }

        .bootstrap-tagsinput input {
            border: none;
            outline: none;
            min-width: 120px;
            margin: 2px;
        }


    </style>
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
                    <span class="text-gray-600">Admin Panel</span>
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

    <!-- Main Content -->
    <div class="p-8 max-w-7xl mx-auto">
        <h1 class="text-2xl font-bold mb-8">Statistics Overview</h1>
        
        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-gray-500 text-sm mb-1">Total Users</h3>
                <p class="text-3xl font-bold"><?php echo Cours::GetTotalEnrolledStudents(); ?></p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-gray-500 text-sm mb-1">Total Courses</h3>
                <p class="text-3xl font-bold"><?php echo Cours::GetTotalCourses(); ?></p>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm">
                <h3 class="text-gray-500 text-sm mb-1">Active Instructors</h3>
                <p class="text-3xl font-bold"><?php echo Teacher::totalTeachers(); ?></p>
            </div>
        </div>

        <div class="mb-6 flex space-x-4">
            <button onclick="openModal('addCategoryModal')" class="bg-primary px-4 py-2 rounded-lg hover:bg-purpel-500 flex items-center text-white">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Add Category
            </button>
        </div>

        <div class="mb-6 flex space-x-4">
            <button onclick="openModal('addtagsModal')" class="bg-primary px-4 py-2 rounded-lg hover:bg-purpel-500 flex items-center text-white">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Add Tags
            </button>
        </div>

        <!-- Category Table -->
<!-- Category Table -->
<div class="bg-white rounded-lg shadow-md mt-6 mb-6">
    <div class="p-6 border-b border-gray-200">
        <h2 class="text-xl font-semibold text-gray-800">Categories Management</h2>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full display" id="categoriestable" >
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Name</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php
                $rows = Category::showCategories();
                 foreach($rows as $row) { 
                ?>
                <tr class="hover:bg-gray-50 transition-colors duration-200">
                    <td class="px-6 py-4 text-sm text-gray-900 pr-28"><?php echo $row['category_id'] ?></td>
                    <td class="px-6 py-4">
                        <span class="text-sm font-medium text-gray-900 pr-60"><?php echo $row['name'] ?></span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center space-x-6">
                            <a href="../Handling/deletecategorieHandl.php?id=<?php echo $row['category_id'] ?>"><button class="text-red-600 hover:text-red-800 transition-colors duration-200">Delete</button></a>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- tags Table -->
<div class="bg-white rounded-lg shadow-md mt-6 mb-6">
    <div class="p-6 border-b border-gray-200">
        <h2 class="text-xl font-semibold text-gray-800">tags Management</h2>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full display" id="tagstable" >
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">ID</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Name</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php
                $rows = Tag::showalltags();
                 foreach($rows as $row) { 
                ?>
                <tr class="hover:bg-gray-50 transition-colors duration-200">
                    <td class="px-6 py-4 text-sm text-gray-900 pr-28"><?php echo $row->tag_id ?></td>
                    <td class="px-6 py-4">
                        <span class="text-sm font-medium text-gray-900 pr-60"><?php echo $row->getname() ?></span>
                    </td>
                    <td class="px-6 py-4">
                        <div class="flex items-center space-x-6">
                            <a href="../Handling/deletetaghandling.php?id=<?php echo $row->tag_id ?>"><button class="text-red-600 hover:text-red-800 transition-colors duration-200">Delete</button></a>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

        <!-- Recent Users -->
        <div class="bg-white p-6 rounded-lg shadow-sm mb-8">
            <h2 class="text-xl font-bold mb-4">Recent Users</h2>
            <div class="overflow-x-auto">
                <table class="w-full" id="user-table">
                    <thead>
                        <tr class="text-left text-gray-500">
                            <th class="pb-4">Name</th>
                            <th class="pb-4">Role</th>
                            <th class="pb-4">Status</th>
                            <th class="pb-4">Actions</th>
                        </tr>
                    </thead>
                    <?php
                    
                    $users = Admin::getallusers();
                    foreach($users as $user){
                    ?>
                    <tbody>
                        <tr class="border-b">
                            <td class="py-4"><?php echo $user->getPrenom() . " " . $user->getNom() ?></td>
                            <td><?php echo $user->getrole() ?></td>
                            <?php if($user->getStatus() === 'waiting'){ ?>
                                <td><span class="bg-gray-100 text-gray-800 px-2 py-1 rounded-full text-sm"><?php echo $user->getStatus() ?></span></td>
                            <?php } else if ($user->getStatus() === 'active'){ ?>
                            <td><span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-sm"><?php echo $user->getStatus() ?></span></td>
                            <?php }else if ($user->getStatus() === 'suspended'){ ?>
                                <td><span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-sm"><?php echo $user->getStatus() ?></span></td>
                            <?php } ?>
                            <td >
                                <div class="flex gap-3">
                                <form action="../Handling/userHandl.php" method="post">
                                    <input type="hidden" name="action" value="active">
                                    <input type="hidden" name="user_id" value="<?php echo $user->getId(); ?>">
                                    <button type="submit" class="text-green-600 hover:text-green-800">Approve</button>
                                </form>
                                <form action="../Handling/userHandl.php" method="post">
                                    <input type="hidden" name="action" value="suspended">
                                    <input type="hidden" name="user_id" value="<?php echo $user->getId(); ?>">
                                    <button type="submit" class="text-red-600 hover:text-red-800">Ban</button>
                                </form>       
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    <?php } ?>
                </table>
            </div>
        </div>
    </div>

        <!-- Add Category Modal -->
        <div id="addCategoryModal" class="modal z-50">
        <div class="bg-white rounded-lg w-1/3 mx-auto my-auto p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold">Add New Category</h3>
                <button onclick="closeModal('addCategoryModal')" class="text-gray-500 hover:text-gray-700">×</button>
            </div>
            <form class="space-y-4" method="POST" action="../Handling/categoryHandl.php">
                <div>
                    <label class="block text-sm font-medium mb-1">Category Name</label>
                    <input type="text" name="cat_name" class="w-full border rounded-lg p-2">
                </div>
                <div class="flex justify-end space-x-4">
                    <button type="button" onclick="closeModal('addCategoryModal')" class="px-4 py-2 border rounded-lg">Cancel</button>
                    <button type="submit" name="Category_submit" class="px-4 py-2 text-white bg-primary rounded-lg">Add Category</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Scripts at the bottom of the body -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.min.js"></script>


    <!-- Add Category Modal -->
    <div id="addCategoryModal" class="modal z-50">
        <div class="bg-white rounded-lg w-1/3 mx-auto my-auto p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold">Add New Category</h3>
                <button onclick="closeModal('addCategoryModal')" class="text-gray-500 hover:text-gray-700">×</button>
            </div>
            <form class="space-y-4" method="POST" action="../Handling/categoryHandl.php">
                <div>
                    <label class="block text-sm font-medium mb-1">Category Name</label>
                    <input type="text" name="cat_name" class="w-full border rounded-lg p-2">
                </div>
                <div class="flex justify-end space-x-4">
                    <button type="button" onclick="closeModal('addCategoryModal')" class="px-4 py-2 border rounded-lg">Cancel</button>
                    <button type="submit" name="Category_submit" class="px-4 py-2 text-white bg-primary rounded-lg">Add Category</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Add tags Modal -->
    <div id="addtagsModal" class="modal z-50">
        <div class="bg-white rounded-lg w-1/3 mx-auto my-auto p-6">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold">Add New tags</h3>
                <button onclick="closeModal('addtagsModal')" class="text-gray-500 hover:text-gray-700">×</button>
            </div>
            <form class="space-y-4" method="POST" action="../Handling/tagHandling.php">
                <div>
                    <label class="block text-sm font-medium mb-1">tags Name</label>
                    <input type="text" name="tag_name" id="tagsInput" class="w-full border rounded-lg p-2">
                </div>
                <div class="flex justify-end space-x-4">
                    <button type="button" onclick="closeModal('addtagsModal')" class="px-4 py-2 border rounded-lg">Cancel</button>
                    <button type="submit" name="tags_submit" class="px-4 py-2 text-white bg-primary rounded-lg">Add tags</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
    
    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.add('active');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.remove('active');
        }

        $(document).ready(function () {

$('#tagsInput').tagsinput();
});

        $(document).ready(function() {
        
        $('#categoriestable').DataTable({
            "paging": true,
            "ordering": true,
            "searching": true,
            "lengthChange": false,
            "info": true,
            "autoWidth": false
        });
        $('#user-table').DataTable({
            "paging": true,
            "ordering": true,
            "searching": true,
            "lengthChange": false,
            "info": true,
            "autoWidth": false
        });

        $('#tagstable').DataTable({
            "paging": true,
            "ordering": true,
            "searching": true,
            "lengthChange": false,
            "info": true,
            "autoWidth": false,
        });
});

    </script>
</body>
</html>