<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= $title ?? 'Guest Page' ?></title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

  <!-- Tailwind CSS CDN -->
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 text-gray-800 flex flex-col min-h-screen">
  <!-- Navbar -->
  <header class="bg-white shadow-lg">
    <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
      <!-- Logo and Site Title -->
      <div class="logo flex items-center space-x-3">
        <i class="fas fa-graduation-cap text-3xl bg-gradient-to-r from-blue-700 to-blue-500 text-transparent bg-clip-text"></i>
        <div>
          <h2 class="text-2xl font-extrabold tracking-wide bg-gradient-to-r from-blue-700 to-blue-500 text-transparent bg-clip-text">DigiTech College</h2>
          <p class="text-sm text-gray-600 italic text-right">Empowering the Future</p>
        </div>
      </div>
      <!-- Desktop Navigation -->
      <nav class="hidden md:flex space-x-6">
        <a href="<?= route('home') ?>" class="text-gray-600 hover:text-blue-600 transition-colors">Home</a>
        <a href="<?= route('about') ?>" class="text-gray-600 hover:text-blue-600 transition-colors">About</a>
        <a href="<?= route('services') ?>" class="text-gray-600 hover:text-blue-600 transition-colors">Services</a>
        <a href="<?= route('contact') ?>" class="text-gray-600 hover:text-blue-600 transition-colors">Contact</a>
      </nav>
      <!-- Authentication Links -->
      <div class="flex space-x-4">
        <?php if (auth()->check()): ?>
          <?php
          $dashboardRoute = match (auth()->type()) {
            'admin' => route('admin.dashboard'),
            'supervisor' => route('dashboard.supervisor'),
            'trainee' => route('.dashboard.trainee'),
            default => route('home')
          };
          ?>
          <a href="<?= $dashboardRoute ?>" class="px-6 py-1 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition-colors">Dashboard</a>
        <?php else: ?>
          <a href="<?= route('login') ?>" class="px-6 py-1 border border-blue-600 text-blue-600 rounded-full hover:bg-blue-600 hover:text-white transition-colors">Login</a>
          <a href="<?= route('register') ?>" class="px-6 py-1 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition-colors">Register</a>
        <?php endif; ?>
      </div>
    </div>
  </header>

  <!-- Main Content (min height 100vh minus header and footer) -->
  <main class="flex-grow w-full">
    <div class="w-full">
      <?= $content ?>
    </div>
  </main>

  <!-- Footer -->
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