<?php
$title = "Content Details";
$activeSidebar = $activeSidebar ?? 'contents';

ob_start();
?>
<div class="container mx-auto">
  <h1 class="text-3xl font-bold mb-6">Content Details</h1>
  <div class="bg-white shadow rounded p-6">
    <p><strong>ID:</strong> <?= $contentItem->id ?></p>
    <p><strong>Type:</strong> <?= $contentItem->type ?></p>
    <p><strong>Content:</strong> <?= $contentItem->title ?></p>
    <p><strong>Ticket ID:</strong> <?= $contentItem->content ?></p>
  </div>
  <a href="<?= route('admin.contents.index') ?>" class="mt-4 inline-block text-blue-600 hover:underline">Back to List</a>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/app.php';
?>
