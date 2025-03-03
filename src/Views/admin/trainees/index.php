<?php
$title = "Trainees List";
$activeSidebar = $activeSidebar ?? 'trainees';

ob_start();
?>
<div class="container mx-auto">
  <h1 class="text-3xl font-bold mb-6">Trainees</h1>
  <a href="<?= route('admin.trainees.create') ?>" class="mb-4 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add New Trainee</a>
  <div class="overflow-x-auto">
    <table class="min-w-full bg-white border">
      <thead>
        <tr class="bg-gray-200">
          <th class="py-2 px-4 border">ID</th>
          <th class="py-2 px-4 border">Name</th>
          <th class="py-2 px-4 border">Email</th>
          <th class="py-2 px-4 border">Major</th>
          <th class="py-2 px-4 border">Actions</th>
        </tr>
      </thead>
      <tbody class="text-center">
        <?php foreach ($trainees as $trainee): ?>
          <tr class="hover:bg-gray-100">
            <td class="py-2 px-4 border"><?= $trainee->id ?></td>
            <td class="py-2 px-4 border"><?= $trainee->name ?></td>
            <td class="py-2 px-4 border"><?= $trainee->email ?></td>
            <td class="py-2 px-4 border"><?= $trainee->major ?></td>
            <td class="py-2 px-4 border">
              <a href="<?= route('admin.trainees.show', ['id' => $trainee->id]) ?>" class="text-blue-600 hover:underline mr-2">View</a>
              <a href="<?= route('admin.trainees.edit', ['id' => $trainee->id]) ?>" class="text-green-600 hover:underline mr-2">Edit</a>
              <a href="<?= route('admin.trainees.delete', ['id' => $trainee->id]) ?>" class="text-red-600 hover:underline">Delete</a>
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