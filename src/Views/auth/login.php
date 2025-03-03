<?php
// views/auth/login.php

$title = "Login";

ob_start();
?>


<div class="bg-sky-50 w-full   ">
  <div class="max-w-7xl mx-auto bg-white  rounded-lg my-10">

    <div class="grid grid-cols-1 lg:grid-cols-2">
      <!-- Left Column: Image (visible on large screens) -->
      <div class="hidden lg:block h-full">
        <img src="https://img.freepik.com/fotos-premium/imagen-fondo_910766-187.jpg?w=826" alt="Register Image" class="object-cover w-full h-full">
      </div>
      <div class="p-4 py-8">
        <div class="text-center">
          <h2 class="text-3xl font-bold mb-4 text-center">Login</h2>
          <p class="mt-2 text-sm text-gray-600">
            Login as an Admin, Supervisor, or Trainee
          </p>
        </div>

        <!-- Display error message if it exists -->
        <?php
        if (isset($_SESSION['error'])) {
          echo "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4'>" . $_SESSION['error'] . "</div>";
          unset($_SESSION['error']);
        }
        if (isset($_SESSION['success'])) {
          echo "<div class='bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4'>" . $_SESSION['success'] . "</div>";
          unset($_SESSION['success']);
        }
        ?>

        <form action="<?= route('login') ?>" method="POST" class="space-y-6 p-12">
          <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" required
              class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring focus:border-blue-300" autocomplete="off">
          </div>
          <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
            <input type="password" name="password" id="password" required
              class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring focus:border-blue-300" autocomplete="off">
          </div>

          <!-- User type selection with different colors -->
          <div>
            <span class="block text-sm font-medium text-gray-700">Login as</span>
            <div class="flex space-x-6 mt-2">
              <div class="mt-2 flex items-center">
                <input type="radio" id="admin" name="user_type" value="admin"
                  class="h-4 w-4 text-yellow-500 border-gray-300 focus:ring-red-500">
                <label for="admin" class="ml-2 block text-sm text-red-700 font-bold">Admin</label>
              </div>

              <div class="mt-2 flex items-center">
                <input type="radio" id="supervisor" name="user_type" value="supervisor"
                  class="h-4 w-4 text-green-500 border-gray-300 focus:ring-green-500" checked>
                <label for="supervisor" class="ml-2 block text-sm text-green-700 font-bold">Supervisor</label>
              </div>

              <div class="mt-2 flex items-center">
                <input type="radio" id="trainee" name="user_type" value="trainee"
                  class="h-4 w-4 text-blue-500 border-gray-300 focus:ring-blue-500">
                <label for="trainee" class="ml-2 block text-sm text-blue-700 font-bold">Trainee</label>
              </div>
            </div>

          </div>

          <div>
            <button type="submit"
              class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition-colors">
              Login
            </button>
          </div>
        </form>

        <div class="mt-6 text-center">
          <p class="text-sm text-gray-600">
            Don't have an account? <a href="<?= route('register') ?>" class="text-blue-600 hover:underline">Register</a>
          </p>
        </div>
      </div>
    </div>
  </div>

</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/guest.php';
?>