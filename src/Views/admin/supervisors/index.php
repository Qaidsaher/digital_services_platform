<?php 
$title = "Supervisors List";
$activeSidebar = $activeSidebar ?? 'supervisors';

ob_start();
?>
<div class="container mx-auto">
  <h1 class="text-3xl font-bold mb-6">Supervisors</h1>
  <a href="<?= route('admin.supervisors.create') ?>" class="mb-4 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add New Supervisor</a>
  <div class="overflow-x-auto">
    <table class="min-w-full bg-white border">
      <thead>
        <tr class="bg-gray-200">
          <th class="py-2 px-4 border">ID</th>
          <th class="py-2 px-4 border">Name</th>
          <th class="py-2 px-4 border">Email</th>
          <th class="py-2 px-4 border">Department</th>
          <th class="py-2 px-4 border">Actions</th>
        </tr>
      </thead>
      <tbody class="text-center">
        <?php foreach($supervisors as $supervisor): ?>
        <tr class="hover:bg-gray-100">
          <td class="py-2 px-4 border"><?= $supervisor->id ?></td>
          <td class="py-2 px-4 border"><?= $supervisor->name ?></td>
          <td class="py-2 px-4 border"><?= $supervisor->email ?></td>
          <td class="py-2 px-4 border"><?= $supervisor->department ?></td>
          <td class="py-2 px-4 border">
            <a href="<?= route('admin.supervisors.show', ['id' => $supervisor->id]) ?>" class="text-blue-600 hover:underline mr-2">View</a>
            <a href="<?= route('admin.supervisors.edit', ['id' => $supervisor->id]) ?>" class="text-green-600 hover:underline mr-2">Edit</a>
            <a href="<?= route('admin.supervisors.delete', ['id' => $supervisor->id]) ?>" class="text-red-600 hover:underline">Delete</a>
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
