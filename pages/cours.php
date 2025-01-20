<?php
require_once '../classes/cours.php';
require_once '../classes/Tag.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$coursperpage = 6;

$thisPage = isset($_GET['page']) ? $_GET['page'] : 1;
$startIn = ($thisPage - 1) * $coursperpage;
$result = Cours::fetchdataforcurrentpage($startIn, $coursperpage);

if (!isset($_SESSION['user_role']) || $_SESSION['user_status'] === 'suspended') {
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://unpkg.com/htmx.org@2.0.4" integrity="sha384-HGfztofotfshcF7+8n44JQL2oJmowVChPTg48S+jvZoztPfvwD79OC/LTtG6dMp+" crossorigin="anonymous"></script>
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
                <a href="../pages/enrolledCours.php" class="hover:text-purple-600 transition-colors"><li>My Enrolled</li></a>
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
                    <a href="../Handling/AuthHandl.php" class="block px-4 py-3 text-sm text-red-600 hover:bg-red-50 flex items-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        <span>Logout</span>
                    </a>
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

<?php 
if (isset($_SESSION['Log'])) {
    $message = $_SESSION['Log'];
    $type = $message['type'];
    $text = $message['text'];

    echo "<script>
        Swal.fire({
            title: '$type',
            text: '$text',
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: 'Register',
            cancelButtonText: 'Log In'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '../pages/sign_up.php';
            } else if (result.isDismissed) {
                window.location.href = '../pages/login.php';
            }
        });
    </script>";

    unset($_SESSION['Log']);
}
?>


    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Search and Filters -->
        <div class="flex flex-col md:flex-row gap-4 mb-8">
            <div class="md:w-2/3">
            <input 
                type="text" 
                class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500"
                placeholder="Search for courses..."
                id="search-box"
                hx-get="../Handling/searchHandle.php"
                hx-trigger="keyup"
                hx-target="#results"
                hx-swap="innerHTML"
                name="searchfield"
            >
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
                <div id="results" class="grid grid-cols-1 md:grid-cols-3 gap-6">
                   <!-- Course Card 1 -->
                <?php 
                $cours = Cours::showAllCours();
                foreach($result as $cour){
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
                         <?php 
                         $counts = Cours::CountenrollCourses($cour->getId());
                         ?>
                        <div class="flex items-center space-x-4 mb-4">
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                </svg>
                                <?php echo $counts['enroll_Count'] ?>
                            </div>
                            <span class="mx-2">•</span>
                            <div>
                            <?php 
                            $tags = Tag::gettagsforCours($cour->getId());
                            foreach($tags as $tag){
                            ?>
                            <span class="bg-gray-100 px-3 py-1 rounded-full text-sm"><?php echo strlen($tag->getname()) > 10 ? substr($tag->getname(), 0, 10) . '...' : $tag->getname(); ?></span>
                            <?php
                            }
                            ?>
                            </div>
                        </div>
                        <!-- Price and Enroll Button -->
                        <div class="flex items-center justify-between mt-4">
                            <span class="text-lg font-bold text-purple-600"><?php echo $cour->getprice() ?>$</span>
                            <div>
                            <a href="../pages/course_firstPreview.php?course_id=<?php echo $cour->getId()?>"><button class="bg-purple-600 text-white px-6 py-2 rounded-full hover:bg-purple-700 transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50">
                                View
                            </button></a>
                            <a href="../Handling/enrollHandle.php?course_id=<?php echo $cour->getId()?>"><button class="bg-purple-600 text-white px-6 py-2 rounded-full hover:bg-purple-700 transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50">
                                Enroll Now
                            </button></a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
                </div>

                <!-- Pagination -->
                <?php
                $totalcountpages = Cours::countPagesForPagination();
                $totalPages = ($coursperpage > 0) ? ceil($totalcountpages / $coursperpage) : 0;
                
                if ($totalPages > 0) {
                    echo "<div class='flex justify-center space-x-2 mt-8'>";
                
                    if ($thisPage > 1) {
                        echo "<a href='?page=" . ($thisPage - 1) . "'><button class='px-3 py-2 rounded-md bg-gray-100'>Previous</button></a>";
                    }
                
                    for ($page = 1; $page <= $totalPages; $page++) {
                        $active = ($page == $thisPage) ? "bg-purple-500 text-white" : "bg-gray-100";
                        echo "<a href='?page=$page'><button class='px-3 py-2 rounded-md $active'>$page</button></a>";
                    }
                
                    if ($thisPage < $totalPages) {
                        echo "<a href='?page=" . ($thisPage + 1) . "'><button class='px-3 py-2 rounded-md bg-gray-100'>Next</button></a>";
                    }
                
                    echo "</div>";
                }
                
                ?>
        </div>
    </div>
</body>
</html>