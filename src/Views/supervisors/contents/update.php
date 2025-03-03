<?php 
$title = "Edit Content";
$activeSidebar = $activeSidebar ?? 'contents';

ob_start();
?>
<div class="container mx-auto py-8">
  <div class="max-w-7xl mx-auto bg-white shadow-xl rounded-lg p-8">
    <!-- Page Title -->
    <h1 class="text-3xl font-bold text-gray-800 mb-6 flex items-center">
      <i class="fas fa-edit text-green-600 mr-3"></i> Edit Content
    </h1>

    <!-- Edit Content Form -->
    <form action="<?= route('supervisor.contents.update', ['id' => $contentItem->id]) ?>" method="POST" class="space-y-6">
      <!-- Title -->
      <div>
        <label for="title" class="block text-gray-700 font-medium mb-2">Title:</label>
        <input type="text" name="title" id="title" value="<?= htmlspecialchars($contentItem->title) ?>"
               class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
      </div>

      <!-- Type -->
      <div>
        <label for="type" class="block text-gray-700 font-medium mb-2">Type:</label>
        <input type="text" name="type" id="type" value="<?= htmlspecialchars($contentItem->type) ?>"
               class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
      </div>

      <!-- Content -->
      <div>
        <label for="content" class="block text-gray-700 font-medium mb-2">Content:</label>
        <textarea name="content" id="content" rows="5"
                  class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required><?= htmlspecialchars($contentItem->content) ?></textarea>
      </div>

      <!-- Action Buttons -->
      <div class="flex justify-end space-x-4">
        <a href="<?= route('supervisor.contents.index') ?>" 
           class="px-6 py-3 text-white bg-gray-600 hover:bg-gray-700 rounded-lg shadow-md font-medium transition">
          <i class="fas fa-arrow-left mr-2"></i> Cancel
        </a>
        <button type="submit" class="px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow-md transition duration-200">
          <i class="fas fa-save mr-2"></i> Update Content
        </button>
      </div>
    </form>
  </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/auth.php';
?>
