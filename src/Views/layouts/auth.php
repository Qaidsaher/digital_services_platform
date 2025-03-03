<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= $title ?? 'Dashboard' ?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

    <!-- Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script>
        document.addEventListener("click", function(event) {
            const profileMenu = document.getElementById("profile-menu");
            const mobileMenu = document.getElementById("mobile-menu");
            const profileButton = document.querySelector("button[onclick='toggleProfileMenu()']");
            const menuButton = document.querySelector("button[onclick='toggleMenu()']");

            if (profileMenu && !profileMenu.contains(event.target) && !profileButton.contains(event.target)) {
                profileMenu.classList.add("hidden");
            }
            if (mobileMenu && !mobileMenu.contains(event.target) && !menuButton.contains(event.target)) {
                mobileMenu.classList.add("hidden");
            }
        });

        function toggleMenu() {
            document.getElementById("mobile-menu").classList.toggle("hidden");
        }

        function toggleProfileMenu() {
            document.getElementById("profile-menu").classList.toggle("hidden");
        }
    </script>
</head>

<body class="bg-gray-100 text-gray-800 flex flex-col min-h-screen">
    <header class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <div class="logo flex items-center space-x-3">
                <i class="fas fa-graduation-cap text-3xl bg-gradient-to-r from-blue-700 to-blue-500 text-transparent bg-clip-text"></i>
                <div>
                    <h2 class="text-2xl font-extrabold tracking-wide bg-gradient-to-r from-blue-700 to-blue-500 text-transparent bg-clip-text">DigiTech College</h2>
                    <p class="text-sm text-gray-600 italic">Empowering the Future</p>
                </div>
            </div>

            <!-- Mobile Menu Button -->
            <button class="md:hidden text-blue-500 focus:outline-none text-2xl" onclick="toggleMenu()">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Navigation Links -->
            <nav class="hidden md:flex space-x-6 text-medium">
                <?php if ($_SESSION['user_type'] === 'trainee'): ?>
                    <a href="<?= route(name: 'dashboard.trainee') ?>" class="text-blue-500 hover:text-blue-700 font-medium">Dashboard</a>
                    <a href="<?= route('trainee.tickets.index') ?>" class="text-blue-500 hover:text-blue-700 font-medium">My Tickets</a>
                    <a href="<?= route('trainee.contents.index') ?>" class="text-blue-500 hover:text-blue-700 font-medium"> Contents</a>
                <?php elseif ($_SESSION['user_type'] === 'supervisor'): ?>
                    <a href="<?= route(name: 'dashboard.supervisor') ?>" class="text-blue-500 hover:text-blue-700 font-medium">Dashboard</a>
                    <a href="<?= route('supervisor.tickets.index') ?>" class="text-blue-500 hover:text-blue-700 font-medium">Manage Tickets</a>
                    <a href="<?= route('supervisor.contents.index') ?>" class="text-blue-500 hover:text-blue-700 font-medium">Manage Contents</a>
                <?php endif; ?>
            </nav>


            <!-- Profile Menu -->
            <div class="relative hidden md:block">
                <button onclick="toggleProfileMenu()" class="text-blue-500 text-2xl focus:outline-none">
                    <i class="fas fa-user-circle"></i>
                </button>
                <div id="profile-menu" class="hidden absolute right-0 mt-2 w-48 bg-white shadow-md rounded-md py-2">
                    <a href="<?= route('account') ?>" class="block px-4 py-2 text-blue-500 hover:bg-gray-100">
                        <i class="fas fa-user"></i> Profile
                    </a>
                    <a href="<?= route('logout') ?>" class="block px-4 py-2 text-red-500 hover:bg-gray-100">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>

            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white shadow-md p-4">
            <?php if ($_SESSION['user_type'] === 'trainee'): ?>
                <a href="<?= route(name: 'dashboard.trainee') ?>" class="text-blue-500 hover:text-blue-700  py-2 font-medium block">Dashboard</a>
                <a href="<?= route('trainee.tickets.index') ?>" class="text-blue-500 hover:text-blue-700  py-2 font-medium block">My Tickets</a>
                <a href="<?= route('trainee.contents.index') ?>" class="text-blue-500 hover:text-blue-700  py-2 font-medium block"> Contents</a>
            <?php elseif ($_SESSION['user_type'] === 'supervisor'): ?>
                <a href="<?= route(name: 'dashboard.supervisor') ?>" class="text-blue-500 hover:text-blue-700  py-2 font-medium block">Dashboard</a>
                <a href="<?= route('supervisor.tickets.index') ?>" class="text-blue-500 hover:text-blue-700  py-2 font-medium block">Manage Tickets</a>
                <a href="<?= route('supervisor.contents.index') ?>" class="text-blue-500 hover:text-blue-700  py-2 font-medium block">Manage Contents</a>
            <?php endif; ?>
            <a href="<?= route('account') ?>" class="block py-2 text-blue-500 hover:text-blue-700 font-medium">My Account</a>
            <a href="<?= route('logout') ?>" class="block py-2 text-red-500 hover:text-blue-700 font-medium"><i class="fas fa-sign-out-alt"></i> Logout</a>
        </div>
    </header>

    <main class="max-w-7xl mx-auto p-6 flex-1 w-full">
        <?= $content ?>
    </main>

    <footer class="bg-gray-800 text-white py-10">
        <div class="container mx-auto px-8 text-center max-w-6xl">
            <p class="text-lg">&copy; <?= date("Y") ?> Digital Technical College Training & Student. All rights reserved.</p>
            <p class="mt-4">
                <a href="<?= route('terms') ?>" class="text-blue-400 hover:underline text-lg">Terms of Service</a> |
                <a href="<?= route('privacy') ?>" class="text-blue-400 hover:underline text-lg">Privacy Policy</a> |
                <a href="<?= route('help') ?>" class="text-blue-400 hover:underline text-lg">Help</a>
            </p>
        </div>
    </footer>
</body>

</html>