<?php
$title = "Register";
ob_start();
?>
<div class="bg-sky-50 w-full   ">
  <div class="max-w-7xl mx-auto bg-white  rounded-lg my-10">
    <div class=" grid grid-cols-1 lg:grid-cols-2 gap-4">
      <!-- Left Column: Image (visible on large screens) -->
      <div class="hidden lg:block h-full">
        <img src="https://img.freepik.com/fotos-premium/imagen-fondo_910766-187.jpg?w=826" alt="Register Image" class="object-cover w-full h-full">
      </div>
      <!-- Right Column: Registration Form -->
      <div class="p-4 py-8">
        <div class="text-center">
          <h2 class="text-3xl font-extrabold text-gray-900">Create Your Account</h2>
          <p class="mt-2 text-sm text-gray-600">
            Register as a Supervisor or Trainee
          </p>
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

        </div>
        <form action="<?= route('register') ?>" method="POST" class="mt-8 space-y-6">
          <!-- Basic Information Fields -->
          <div class="rounded-md shadow-sm grid grid-cols-1 lg:grid-cols-2 gap-x-2 gap-y-4 ">
            <!-- Name -->
            <div>
              <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
              <input type="text" name="name" id="name" required
                class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring focus:border-blue-300" autocomplete="off">
            </div>
            <!-- Email -->
            <div>
              <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
              <input type="email" name="email" id="email" required
                class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring focus:border-blue-300" autocomplete="off">
            </div>
            <!-- Phone Number -->
            <div>
              <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
              <input type="tel" name="phone" id="phone" required
                class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring focus:border-blue-300" autocomplete="off">
            </div>
            <!-- Password with Toggle -->
            <div class="relative">
              <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
              <input type="password" name="password" id="password" required
                class="mt-1 block w-full border border-gray-300 rounded-md p-2 pr-10 focus:outline-none focus:ring focus:border-blue-300" autocomplete="off">
              <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-600 mt-5" onclick="togglePassword('password', this)">
                <i class="fas fa-eye"></i>
              </button>
            </div>
            <!-- Confirm Password with Toggle -->
            <div class="relative">
              <label for="confirm_password" class="block text-sm font-medium text-gray-700">Confirm Password</label>
              <input type="password" name="confirm_password" id="confirm_password" required
                class="mt-1 block w-full border border-gray-300 rounded-md p-2 pr-10 focus:outline-none focus:ring focus:border-blue-300" autocomplete="off">
              <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-600 mt-5" onclick="togglePassword('confirm_password', this)">
                <i class="fas fa-eye"></i>
              </button>
            </div>
          </div>

          <!-- User Type Selection -->
          <div>
            <span class="block text-gray-700 font-medium mb-2">Register as</span>
            <div class="flex items-center space-x-6">
              <div class="flex items-center">
                <input type="radio" id="supervisor" name="user_type" value="supervisor"
                  class="h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500" checked onclick="toggleExtraFields()">
                <label for="supervisor" class="ml-2 text-sm text-gray-700">Supervisor</label>
              </div>
              <div class="flex items-center">
                <input type="radio" id="trainee" name="user_type" value="trainee"
                  class="h-4 w-4 text-blue-600 border-gray-300 focus:ring-blue-500" onclick="toggleExtraFields()">
                <label for="trainee" class="ml-2 text-sm text-gray-700">Trainee</label>
              </div>
            </div>
          </div>

          <!-- Conditional Extra Fields -->
          <div id="extra-fields">
            <!-- Department Field for Supervisors -->
            <div id="supervisor-field">
              <label for="department" class="block text-sm font-medium text-gray-700">Department</label>
              <input type="text" name="department" id="department"
                class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring focus:border-blue-300" placeholder="Enter your department">
            </div>
            <!-- Major Field for Trainees (hidden by default) -->
            <div id="trainee-field" class="hidden">
              <label for="major" class="block text-sm font-medium text-gray-700">Major</label>
              <input type="text" name="major" id="major"
                class="mt-1 block w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring focus:border-blue-300" placeholder="Enter your major">
            </div>
          </div>

          <!-- Submit Button -->
          <div>
            <button type="submit"
              class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition-colors">
              Register
            </button>
          </div>
        </form>
        <!-- Already have an account -->
        <div class="mt-6 text-center">
          <p class="text-sm text-gray-600">
            Already have an account? <a href="<?= route('login') ?>" class="text-blue-600 hover:underline">Login</a>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- JavaScript to toggle extra fields based on user type -->
<script>
  function toggleExtraFields() {
    const supervisorRadio = document.getElementById('supervisor');
    const traineeRadio = document.getElementById('trainee');
    const supervisorField = document.getElementById('supervisor-field');
    const traineeField = document.getElementById('trainee-field');

    if (supervisorRadio.checked) {
      supervisorField.classList.remove('hidden');
      traineeField.classList.add('hidden');
    } else if (traineeRadio.checked) {
      traineeField.classList.remove('hidden');
      supervisorField.classList.add('hidden');
    }
  }
  document.addEventListener("DOMContentLoaded", toggleExtraFields);

  function togglePassword(fieldId, btn) {
    const field = document.getElementById(fieldId);
    if (field.type === "password") {
      field.type = "text";
      btn.innerHTML = '<i class="fas fa-eye-slash"></i>';
    } else {
      field.type = "password";
      btn.innerHTML = '<i class="fas fa-eye"></i>';
    }
  }
</script>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/guest.php';
