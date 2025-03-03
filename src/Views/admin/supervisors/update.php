<?php 
$title = "Edit Supervisor";
$activeSidebar = $activeSidebar ?? 'supervisors';

ob_start();
?>
<div class="container mx-auto">
  <h1 class="text-3xl font-bold mb-6">Edit Supervisor</h1>
  <form action="<?= route('admin.supervisors.update', ['id' => $supervisor->id]) ?>" method="POST" class="bg-white shadow rounded p-6">
    <div class="mb-4">
      <label for="name" class="block text-gray-700">Name:</label>
      <input type="text" name="name" id="name" value="<?= $supervisor->name ?>" class="w-full border rounded p-2" required>
    </div>
    <div class="mb-4">
      <label for="email" class="block text-gray-700">Email:</label>
      <input type="email" name="email" id="email" value="<?= $supervisor->email ?>" class="w-full border rounded p-2" required>
    </div>
    <div class="mb-4">
      <label for="department" class="block text-gray-700">Department:</label>
      <input type="text" name="department" id="department" value="<?= $supervisor->department ?>" class="w-full border rounded p-2" required>
    </div>
    <div class="mb-4">
      <label for="phone" class="block text-gray-700">Phone:</label>
      <input type="text" name="phone" id="phone" value="<?= $supervisor->phone ?>" class="w-full border rounded p-2" required>
    </div>
    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Update Supervisor</button>
  </form>
  <a href="<?= route('admin.supervisors.index') ?>" class="mt-4 inline-block text-blue-600 hover:underline">Back to List</a>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/app.php';
?>
