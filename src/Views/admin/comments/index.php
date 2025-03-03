<?php
$title = "Comments List";
$activeSidebar = $activeSidebar ?? 'comments';

ob_start();
?>
<div class="container mx-auto">
  <h1 class="text-3xl font-bold mb-6">Comments</h1>
  <div class="overflow-x-auto">
    <table class="min-w-full bg-white border">
      <thead>
        <tr class="bg-gray-200">
          <th class="py-2 px-4 border">ID</th>
          <th class="py-2 px-4 border">Text</th>
          <th class="py-2 px-4 border">Sender</th>
          <th class="py-2 px-4 border">Actions</th>
        </tr>
      </thead>
      <tbody class="text-center">
        <?php foreach ($comments as $comment): ?>
          <tr class="hover:bg-gray-100">
            <td class="py-2 px-4 border"><?= $comment->id ?></td>
            <td class="py-2 px-4 border"><?= $comment->text ?></td>
            <td class="py-2 px-4 border">
              <?php if ($comment->creator_type === 'trainee'): ?>
                <span class="bg-blue-500 text-white text-xs font-semibold px-2 py-1 rounded">Trainee</span>
              <?php elseif ($comment->creator_type === 'supervisor'): ?>
                <span class="bg-green-500 text-white text-xs font-semibold px-2 py-1 rounded">Supervisor</span>
              <?php else: ?>
                <span class="bg-gray-500 text-white text-xs font-semibold px-2 py-1 rounded">Unknown</span>
              <?php endif; ?>
            </td>
            <td class="py-2 px-4 border">
              <a href="<?= route('admin.comments.show', ['id' => $comment->id]) ?>" class="text-blue-600 hover:underline mr-2">View</a>
              <a href="<?= route('admin.comments.edit', ['id' => $comment->id]) ?>" class="text-green-600 hover:underline mr-2">Edit</a>
              <a href="<?= route('admin.comments.delete', ['id' => $comment->id]) ?>" class="text-red-600 hover:underline">Delete</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/app.php';
?>