<?php
$title = "Contents List";
$activeSidebar = $activeSidebar ?? 'contents';

ob_start();
?>
<div class="container mx-auto">
  <h1 class="text-3xl font-bold mb-6">Contents</h1>
  <a href="<?= route('admin.contents.create') ?>" class="mb-4 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add New Content</a>
  <div class="overflow-x-auto">
    <table class="min-w-full bg-white border">
      <thead>
        <tr class="bg-gray-200">
          <th class="py-2 px-4 border">ID</th>
          <th class="py-2 px-4 border">Type</th>
          <th class="py-2 px-4 border">Title</th>
          <th class="py-2 px-4 border">Content</th>
          <th class="py-2 px-4 border">Actions</th>
        </tr>
      </thead>
      <tbody class="text-center">
        <?php foreach($contents as $contentItem): ?>
        <tr class="hover:bg-gray-100">
          <td class="py-2 px-4 border"><?= $contentItem->id ?></td>
          <td class="py-2 px-4 border"><?= $contentItem->type ?></td>
          <td class="py-2 px-4 border"><?= $contentItem->title ?></td>
          <td class="py-2 px-4 border"><?= $contentItem->content ?></td>
          <td class="py-2 px-4 border">
            <a href="<?= route('admin.contents.show', ['id' => $contentItem->id]) ?>" class="text-blue-600 hover:underline mr-2">View</a>
            <a href="<?= route('admin.contents.edit', ['id' => $contentItem->id]) ?>" class="text-green-600 hover:underline mr-2">Edit</a>
            <a href="<?= route('admin.contents.delete', ['id' => $contentItem->id]) ?>" class="text-red-600 hover:underline">Delete</a>
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
