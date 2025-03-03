<?php
$title = "Create Content";
$activeSidebar = $activeSidebar ?? 'contents';

ob_start();
?>
<div class="container mx-auto">
  <h1 class="text-3xl font-bold mb-6">Add New Content</h1>

  <!-- Session Alerts -->
  <?php if (isset($_SESSION['success'])): ?>
    <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
      <?= $_SESSION['success'];
      unset($_SESSION['success']); ?>
    </div>
  <?php endif; ?>
  <?php if (isset($_SESSION['error'])): ?>
    <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
      <?= $_SESSION['error'];
      unset($_SESSION['error']); ?>
    </div>
  <?php endif; ?>

  <form action="<?= route('admin.contents.create') ?>" method="POST" class="bg-white shadow rounded p-6">
    <div class="mb-4">
      <label for="type" class="block text-gray-700">Type:</label>
      <input type="text" name="type" id="type" class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
    </div>

    <div class="mb-4">
      <label for="content" class="block text-gray-700">Content:</label>
      <textarea name="content" id="content" rows="5" class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
    </div>

    <!-- Hidden Field for Creator Supervisor ID -->
    <div class="mb-4">
      <label for="creator_supervisor_id" class="block text-gray-700">Assigned Supervisor:</label>
      <select name="creator_supervisor_id" id="creator_supervisor_id" class="w-full border rounded p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        <?php foreach ($supervisors as $supervisor): ?>
          <option value="<?= $supervisor->id ?>" >
            <?= htmlspecialchars($supervisor->name) ?> (<?= htmlspecialchars($supervisor->email) ?>)
          </option>
        <?php endforeach; ?>
      </select>
    </div>
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Create Content</button>
  </form>

  <a href="<?= route('admin.contents.index') ?>" class="mt-4 inline-block text-blue-600 hover:underline">Back to List</a>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/app.php';
?>