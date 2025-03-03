<?php
$title = "Content Details";
$activeSidebar = "contents";

ob_start();
?>
<div class="container mx-auto px-4 py-8">
  <div class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-6">
    <h1 class="text-7xl font-bold text-gray-900 mb-6"><?= htmlspecialchars($content->title) ?></h1>
    
    <div class="text-gray-700">
      <p><strong>Type:</strong> <?= htmlspecialchars($content->type) ?></p>
      {# <p class="mt-4"><?= nl2br(htmlspecialchars($content->content)) ?></p> #}
    </div>

    <p class="text-sm text-gray-500 mt-4">
      <i class="fas fa-calendar-alt"></i> Created on: <?= htmlspecialchars($content->created_at) ?>
    </p>

    <!-- Back Button -->
    <div class="mt-6">
      <a href="<?= route('trainee.contents.index') ?>" class="px-4 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded-md shadow-md font-medium">
        <i class="fas fa-arrow-left mr-2"></i> Back to My Contents
      </a>
    </div>
  </div>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/auth.php';
?>
