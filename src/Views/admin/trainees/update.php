<?php
$title = "Edit Trainee";
$activeSidebar = $activeSidebar ?? 'trainees';

ob_start();
?>
<div class="container mx-auto">
  <h1 class="text-3xl font-bold mb-6">Edit Trainee</h1>
  <form action="<?= route('admin.trainees.update', ['id' => $trainee->id]) ?>" method="POST" class="bg-white shadow rounded p-6">
    <div class="mb-4">
      <label for="name" class="block text-gray-700">Name:</label>
      <input type="text" name="name" id="name" value="<?= $trainee->name ?>" class="w-full border rounded p-2" required>
    </div>
    <div class="mb-4">
      <label for="email" class="block text-gray-700">Email:</label>
      <input type="email" name="email" id="email" value="<?= $trainee->email ?>" class="w-full border rounded p-2" required>
    </div>
    <div class="mb-4">
      <label for="major" class="block text-gray-700">Major:</label>
      <input type="text" name="major" id="major" value="<?= $trainee->major ?>" class="w-full border rounded p-2" required>
    </div>
    <div class="mb-4">
      <label for="phone" class="block text-gray-700">Phone:</label>
      <input type="text" name="phone" id="phone" value="<?= $trainee->phone ?>" class="w-full border rounded p-2" required>
    </div>
    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Update Trainee</button>
  </form>
  <a href="<?= route('admin.trainees.index') ?>" class="mt-4 inline-block text-blue-600 hover:underline">Back to List</a>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/app.php';
?>