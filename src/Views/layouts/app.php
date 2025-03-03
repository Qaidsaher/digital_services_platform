<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= $title ?? 'My PHP App' ?></title>
  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
  <!-- Tailwind CSS via CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 flex flex-col min-h-screen overflow-x-hidden">
  <!-- Header -->
  <header class="bg-white shadow fixed w-full z-20">
    <div class="container mx-auto px-4 py-4 flex items-center justify-between">
      <div class="flex items-center">
        <!-- Mobile Sidebar Toggle -->
        <button id="sidebarToggle" class="md:hidden mr-4 focus:outline-none">
          <i class="fas fa-bars text-gray-700 text-xl"></i>
        </button>
        <a href="<?= route('admin.dashboard') ?>" class="">
          <div class="logo flex items-center space-x-3">
            <i class="fas fa-graduation-cap text-3xl bg-gradient-to-r from-blue-700 to-blue-500 text-transparent bg-clip-text"></i>
            <div>
              <h2 class="text-2xl font-extrabold tracking-wide bg-gradient-to-r from-blue-700 to-blue-500 text-transparent bg-clip-text">DigiTech College</h2>
              <p class="text-sm text-gray-600 italic text-right">Empowering the Future</p>
            </div>
          </div>
        </a>
      </div>
      <!-- Desktop Navigation -->
      <nav class="hidden md:flex space-x-6">

      </nav>
      <!-- Avatar Dropdown -->
      <div class="relative">
        <button id="avatarButton" class="flex items-center focus:outline-none">
          <i class="fas fa-user-circle text-blue-700 text-2xl"></i>
        </button>

        <div id="avatarDropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-50">
          <a href="#" class="flex items-center px-4 py-2 text-gray-700 hover:bg-blue-100">
            <i class="fas fa-user mr-2 text-indigo-500"></i> Admin
          </a>

          <a href="<?= route('logout') ?>" class="flex items-center px-4 py-2 text-gray-700 hover:bg-blue-100">
            <i class="fas fa-sign-out-alt mr-2 text-red-500"></i> Logout
          </a>
        </div>
      </div>
    </div>
  </header>

  <!-- Sidebar Overlay for Mobile -->
  <div id="sidebarOverlay" class="fixed inset-0 bg-black opacity-50 hidden z-20 md:hidden"></div>

  <!-- Main Layout -->
  <div class="flex flex-1 pt-16 relative">
    <!-- Sidebar -->
    <?php $activeSidebar = $activeSidebar ?? ''; ?>
    <aside id="sidebar" class="bg-white w-64 p-4 border-r border-gray-200 fixed inset-y-0 left-0 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out z-10">
      <nav class="mt-20">
        <ul class="space-y-4">
          <li>
            <a href="<?= route('admin.dashboard') ?>" class="flex items-center p-2 rounded hover:bg-blue-100 <?= $activeSidebar === 'dashboard' ? 'bg-blue-100 text-blue-700' : 'text-gray-700' ?>">
              <i class="fas fa-tachometer-alt mr-2 text-blue-500"></i> Dashboard
            </a>
          </li>
          <li>
            <a href="<?= route('admin.supervisors.index') ?>" class="flex items-center p-2 rounded hover:bg-blue-100 <?= $activeSidebar === 'supervisors' ? 'bg-blue-100 text-green-700' : 'text-gray-700' ?>">
              <i class="fas fa-chalkboard-teacher mr-2 text-green-500"></i> Supervisors
            </a>
          </li>
          <li>
            <a href="<?= route('admin.trainees.index') ?>" class="flex items-center p-2 rounded hover:bg-blue-100 <?= $activeSidebar === 'trainees' ? 'bg-blue-100 text-purple-700' : 'text-gray-700' ?>">
              <i class="fas fa-user-graduate mr-2 text-purple-500"></i> Trainees
            </a>
          </li>
          <li>
            <a href="<?= route('admin.tickets.index') ?>" class="flex items-center p-2 rounded hover:bg-blue-100 <?= $activeSidebar === 'tickets' ? 'bg-blue-100 text-red-700' : 'text-gray-700' ?>">
              <i class="fas fa-ticket-alt mr-2 text-red-500"></i> Tickets
            </a>
          </li>
          <li>
            <a href="<?= route('admin.contents.index') ?>" class="flex items-center p-2 rounded hover:bg-blue-100 <?= $activeSidebar === 'contents' ? 'bg-blue-100 text-orange-700' : 'text-gray-700' ?>">
              <i class="fas fa-file-alt mr-2 text-orange-500"></i> Contents
            </a>
          </li>
          <li>
            <a href="<?= route('admin.comments.index') ?>" class="flex items-center p-2 rounded hover:bg-blue-100 <?= $activeSidebar === 'comments' ? 'bg-blue-100 text-pink-700' : 'text-gray-700' ?>">
              <i class="fas fa-comments mr-2 text-pink-500"></i> Comments
            </a>
          </li>
        </ul>
      </nav>
    </aside>

    <!-- Main Content -->
    <main id="mainContent" class="flex-1 p-6 md:ml-64">
      <?= $content ?>
    </main>
  </div>

  <!-- Footer -->
  <footer class="bg-white border-t border-gray-200 text-center p-4">
    &copy; <?= date('Y') ?> My PHP App. All rights reserved.
  </footer>

  <!-- Scripts -->
  <script>
    // Sidebar toggle functionality for mobile devices
    const sidebarToggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('sidebar');
    const sidebarOverlay = document.getElementById('sidebarOverlay');
    const mainContent = document.getElementById('mainContent');

    sidebarToggle.addEventListener('click', () => {
      sidebar.classList.toggle('-translate-x-full');
      sidebarOverlay.classList.toggle('hidden');
    });

    // Hide sidebar when clicking on main content (mobile)
    mainContent.addEventListener('click', () => {
      if (window.innerWidth < 768 && !sidebar.classList.contains('-translate-x-full')) {
        sidebar.classList.add('-translate-x-full');
        sidebarOverlay.classList.add('hidden');
      }
    });

    // Hide sidebar when clicking on the overlay
    sidebarOverlay.addEventListener('click', () => {
      sidebar.classList.add('-translate-x-full');
      sidebarOverlay.classList.add('hidden');
    });

    // Avatar dropdown functionality
    const avatarButton = document.getElementById('avatarButton');
    const avatarDropdown = document.getElementById('avatarDropdown');

    avatarButton.addEventListener('click', (e) => {
      e.stopPropagation();
      avatarDropdown.classList.toggle('hidden');
    });

    // Hide avatar dropdown when clicking outside
    document.addEventListener('click', () => {
      if (!avatarDropdown.classList.contains('hidden')) {
        avatarDropdown.classList.add('hidden');
      }
    });

    // Prevent dropdown from closing when clicking inside
    avatarDropdown.addEventListener('click', (e) => {
      e.stopPropagation();
    });
  </script>
</body>

</html>