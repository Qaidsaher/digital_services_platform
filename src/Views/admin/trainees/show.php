<?php
$title = "Trainee Details";
$activeSidebar = $activeSidebar ?? 'trainees';

ob_start();
?>
<div class="container mx-auto">
  <h1 class="text-3xl font-bold mb-6">Trainee Details</h1>
  <div class="bg-white shadow rounded p-6">
    <p><strong>ID:</strong> <?= $trainee->id ?></p>
    <p><strong>Name:</strong> <?= $trainee->name ?></p>
    <p><strong>Email:</strong> <?= $trainee->email ?></p>
    <p><strong>Major:</strong> <?= $trainee->major ?></p>
    <p><strong>Phone:</strong> <?= $trainee->phone ?></p>
  </div>
  <a href="<?= route('admin.trainees.index') ?>" class="mt-4 inline-block text-blue-600 hover:underline">Back to List</a>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/app.php';
?>
