<?php
$title = "Create Trainee";
$activeSidebar = $activeSidebar ?? 'trainees';

ob_start();
?>
<div class="container mx-auto">
  <h1 class="text-3xl font-bold mb-6">Add New Trainee</h1>
  <form action="<?= route('admin.trainees.create') ?>" method="POST" class="bg-white shadow rounded p-6">
    <div class="mb-4">
      <label for="name" class="block text-gray-700">Name:</label>
      <input type="text" name="name" id="name" class="w-full border rounded p-2" required>
    </div>
    <div class="mb-4">
      <label for="email" class="block text-gray-700">Email:</label>
      <input type="email" name="email" id="email" class="w-full border rounded p-2" required>
    </div>
    <div class="mb-4">
      <label for="major" class="block text-gray-700">Major:</label>
      <input type="text" name="major" id="major" class="w-full border rounded p-2" required>
    </div>
    <div class="mb-4">
      <label for="phone" class="block text-gray-700">Phone:</label>
      <input type="text" name="phone" id="phone" class="w-full border rounded p-2" required>
    </div>
    <div class="mb-4">
      <label for="password" class="block text-gray-700">Password:</label>
      <input type="password" name="password" id="password" class="w-full border rounded p-2" required>
    </div>
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Create Trainee</button>
  </form>
  <a href="<?= route('admin.trainees.index') ?>" class="mt-4 inline-block text-blue-600 hover:underline">Back to List</a>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/app.php';
?>
