<?php
$title = "Content Details";
$activeSidebar = $activeSidebar ?? 'contents';

ob_start();
?>
<div class="container mx-auto py-8">
  <div class="max-w-7xl mx-auto bg-white shadow-xl rounded-lg p-8">
    <!-- Page Title -->
    <h1 class="text-4xl font-bold text-gray-900 mb-6 text-center flex items-center justify-center">
      <i class="fas fa-file-alt text-blue-600 mr-3"></i> Content Details
    </h1>

    <!-- Content Information -->
    <div class="bg-gray-50 p-6 rounded-lg shadow-md border border-gray-200">
      <div class="mb-4 flex space-x-4">
        <p class="text-lg font-semibold text-gray-700 flex items-center">
          <i class="fas fa-hashtag text-gray-500 mr-2"></i> ID:
        </p>
        <p class="text-gray-600 text-lg"><?= htmlspecialchars($contentItem->id) ?></p>
      </div>

      <div class="mb-4  flex space-x-4">
        <p class="text-lg font-semibold text-gray-700 flex items-center">
          <i class="fas fa-tag text-gray-500 mr-2"></i> Type:
        </p>
        <p class="text-gray-600 text-lg"><?= htmlspecialchars($contentItem->type) ?></p>
      </div>

      <div class="mb-4  flex space-x-4">
        <p class="text-lg font-semibold text-gray-700 flex items-center">
          <i class="fas fa-heading text-gray-500 mr-2"></i> Title:
        </p>
        <p class="text-gray-600 text-lg"><?= htmlspecialchars($contentItem->title) ?></p>
      </div>

      <div class="mb-4  flex space-x-4">
        <p class="text-lg font-semibold text-gray-700 flex items-center">
          <i class="fas fa-align-left text-gray-500 mr-2"></i> Content:
        </p>
        <div class="flex-1 bg-white p-4 border border-gray-300 rounded-md shadow-sm text-gray-700 text-lg leading-relaxed">
          <?= nl2br(htmlspecialchars($contentItem->content)) ?>
        </div>
      </div>

     

      <div class="mb-4 flex space-x-4">
        <p class="text-lg font-semibold text-gray-700 flex items-center">
          <i class="fas fa-calendar text-gray-500 mr-2"></i> Created At:
        </p>
        <p class="text-gray-600 text-lg"><?= htmlspecialchars($contentItem->created_at) ?></p>
      </div>
    </div>

    <!-- Action Buttons -->
    <div class="mt-6 flex justify-between space-x-6">
      <a href="<?= route('supervisor.contents.index') ?>"
        class="px-6 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded-md shadow-md font-medium transition">
        <i class="fas fa-arrow-left mr-2"></i> Back to List
      </a>

      <?php if ($_SESSION['supervisor_id'] == $contentItem->creator_supervisor_id): ?>
        <div class="flex  space-x-6">
          <a href="<?= route('supervisor.contents.edit', ['id' => $contentItem->id]) ?>"
            class="px-6 py-2 text-white bg-green-600 hover:bg-green-700 rounded-md shadow-md font-medium transition">
            <i class="fas fa-edit mr-2"></i> Edit
          </a>
          <a href="<?= route('supervisor.contents.delete', ['id' => $contentItem->id]) ?>"
            class="px-6 py-2 text-white bg-red-600 hover:bg-red-700 rounded-md shadow-md font-medium transition"
            onclick="return confirm('Are you sure you want to delete this content?');">
            <i class="fas fa-trash-alt mr-2"></i> Delete
          </a>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/auth.php';
?>