<?php
$title = "Create Comment";
$activeSidebar = $activeSidebar ?? 'comments';

ob_start();
?>
<div class="container mx-auto">
  <h1 class="text-3xl font-bold mb-6">Add New Comment</h1>
  <form action="<?= route('admin.comments.create') ?>" method="POST" class="bg-white shadow rounded p-6">
    <div class="mb-4">
      <label for="text" class="block text-gray-700">Text:</label>
      <textarea name="text" id="text" rows="4" class="w-full border rounded p-2" required></textarea>
    </div>
    <div class="mb-4">
      <label for="sender" class="block text-gray-700">Sender:</label>
      <input type="text" name="sender" id="sender" class="w-full border rounded p-2" required>
    </div>
    <div class="mb-4">
      <label for="ticket_id" class="block text-gray-700">Ticket ID:</label>
      <input type="number" name="ticket_id" id="ticket_id" class="w-full border rounded p-2" required>
    </div>
    <div class="mb-4">
      <label for="trainee_id" class="block text-gray-700">Trainee ID:</label>
      <input type="number" name="trainee_id" id="trainee_id" class="w-full border rounded p-2">
    </div>
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Create Comment</button>
  </form>
  <a href="<?= route('admin.comments.index') ?>" class="mt-4 inline-block text-blue-600 hover:underline">Back to List</a>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/app.php';
?>
