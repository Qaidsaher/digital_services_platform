<?php 
$title = "Supervisor Details";
$activeSidebar = $activeSidebar ?? 'supervisors';

ob_start();
?>
<div class="container mx-auto">
  <h1 class="text-3xl font-bold mb-6">Supervisor Details</h1>
  <div class="bg-white shadow rounded p-6">
    <p><strong>ID:</strong> <?= $supervisor->id ?></p>
    <p><strong>Name:</strong> <?= $supervisor->name ?></p>
    <p><strong>Email:</strong> <?= $supervisor->email ?></p>
    <p><strong>Department:</strong> <?= $supervisor->department ?></p>
    <p><strong>Phone:</strong> <?= $supervisor->phone ?></p>
  </div>
  <a href="<?= route('admin.supervisors.index') ?>" class="mt-4 inline-block text-blue-600 hover:underline">Back to List</a>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/app.php';
?>
