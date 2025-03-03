<?php
$title = "Edit Comment";
$activeSidebar = $activeSidebar ?? 'comments';

ob_start();
?>
<div class="container mx-auto">
  <h1 class="text-3xl font-bold mb-6">Edit Comment</h1>
  <form action="<?= route('admin.comments.update', ['id' => $comment->id]) ?>" method="POST" class="bg-white shadow rounded p-6">
    <div class="mb-4">
      <label for="text" class="block text-gray-700">Text:</label>
      <textarea name="text" id="text" rows="4" class="w-full border rounded p-2" required><?= $comment->text ?></textarea>
    </div>
    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Update Comment</button>
  </form>
  <a href="<?= route('admin.comments.index') ?>" class="mt-4 inline-block text-blue-600 hover:underline">Back to List</a>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/app.php';
?>