<?php
$title = "Create Ticket";
$activeSidebar = $activeSidebar ?? 'tickets';

ob_start();
?>
<div class="container mx-auto px-4">
  <h1 class="text-3xl font-bold mb-6">Add New Ticket</h1>

  <!-- Session Alerts -->
  <?php if(isset($_SESSION['success'])): ?>
    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
      <?= $_SESSION['success']; unset($_SESSION['success']); ?>
    </div>
  <?php endif; ?>
  <?php if(isset($_SESSION['error'])): ?>
    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
      <?= $_SESSION['error']; unset($_SESSION['error']); ?>
    </div>
  <?php endif; ?>

  <form action="<?= route('admin.tickets.create') ?>" method="POST" class="bg-white shadow rounded p-6">
    <div class="mb-4">
      <label for="title" class="block text-gray-700 font-medium">Title:</label>
      <input type="text" name="title" id="title" class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
    </div>

    <div class="mb-4">
      <label for="details" class="block text-gray-700 font-medium">Details:</label>
      <textarea name="details" id="details" rows="5" class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
    </div>

    <div class="mb-4">
      <label for="creator_id" class="block text-gray-700 font-medium">Trainee Creator:</label>
      <select name="creator_id" id="creator_id" class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        <option value="" disabled selected>Select a trainee</option>
        <?php foreach ($trainees as $trainee): ?>
          <option value="<?= $trainee->id ?>"><?= htmlspecialchars($trainee->name) ?></option>
        <?php endforeach; ?>
      </select>
    </div>

    <div class="mb-4">
      <label for="status" class="block text-gray-700 font-medium">Status:</label>
      <select name="status" id="status" class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
        <option value="Open">Open</option>
        <option value="Pending">Pending</option>
        <option value="Closed">Closed</option>
      </select>
    </div>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Create Ticket</button>
  </form>

  <a href="<?= route('admin.tickets.index') ?>" class="mt-4 inline-block text-blue-600 hover:underline">Back to List</a>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/app.php';
?>
