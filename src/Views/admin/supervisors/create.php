<?php 
$title = "Create Supervisor";
$activeSidebar = $activeSidebar ?? 'supervisors';

ob_start();
?>
<div class="container mx-auto">
  <h1 class="text-3xl font-bold mb-6">Add New Supervisor</h1>
  <form action="<?= route('admin.supervisors.create') ?>" method="POST" class="bg-white shadow rounded p-6">
    <div class="mb-4">
      <label for="name" class="block text-gray-700">Name:</label>
      <input type="text" name="name" id="name" class="w-full border rounded p-2" required>
    </div>
    <div class="mb-4">
      <label for="email" class="block text-gray-700">Email:</label>
      <input type="email" name="email" id="email" class="w-full border rounded p-2" required>
    </div>
    <div class="mb-4">
      <label for="department" class="block text-gray-700">Department:</label>
      <input type="text" name="department" id="department" class="w-full border rounded p-2" required>
    </div>
    <div class="mb-4">
      <label for="phone" class="block text-gray-700">Phone:</label>
      <input type="text" name="phone" id="phone" class="w-full border rounded p-2" required>
    </div>
    <div class="mb-4">
      <label for="password" class="block text-gray-700">Password:</label>
      <input type="password" name="password" id="password" class="w-full border rounded p-2" required>
    </div>
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Create Supervisor</button>
  </form>
  <a href="<?= route('admin.supervisors.index') ?>" class="mt-4 inline-block text-blue-600 hover:underline">Back to List</a>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/app.php';
?>
