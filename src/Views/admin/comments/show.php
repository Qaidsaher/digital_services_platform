<?php
$title = "Comment Details";
$activeSidebar = $activeSidebar ?? 'comments';

ob_start();
?>
<div class="container mx-auto">
  <h1 class="text-3xl font-bold mb-6">Comment Details</h1>
  <div class="bg-white shadow rounded p-6">
    <p><strong>ID:</strong> <?= $comment->id ?></p>
    <p><strong>Text:</strong> <?= $comment->text ?></p>
    <p><strong>Sender:</strong>
      <td class="py-2 px-4 border">
        <?php if ($comment->creator_type === 'trainee'): ?>
          <span class="bg-blue-500 text-white text-xs font-semibold px-2 py-1 rounded">Trainee</span>
        <?php elseif ($comment->creator_type === 'supervisor'): ?>
          <span class="bg-green-500 text-white text-xs font-semibold px-2 py-1 rounded">Supervisor</span>
        <?php else: ?>
          <span class="bg-gray-500 text-white text-xs font-semibold px-2 py-1 rounded">Unknown</span>
        <?php endif; ?>
      </td>
    </p>
  </div>
  <a href="<?= route('admin.comments.index') ?>" class="mt-4 inline-block text-blue-600 hover:underline">Back to List</a>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/app.php';
?>