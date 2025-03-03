<?php 
$title = "Tickets List";
$activeSidebar = $activeSidebar ?? 'tickets';

ob_start();
?>
<div class="container mx-auto px-4">
  <h1 class="text-3xl font-bold mb-6">Tickets</h1>

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

  <a href="<?= route('admin.tickets.create') ?>" class="mb-4 inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
    Add New Ticket
  </a>
  <div class="overflow-x-auto">
    <table class="min-w-full bg-white border rounded shadow">
      <thead>
        <tr class="bg-gray-200">
          <th class="py-2 px-4 border">ID</th>
          <th class="py-2 px-4 border">Title</th>
          <th class="py-2 px-4 border">Status</th>
          <th class="py-2 px-4 border">Created Date</th>
          <th class="py-2 px-4 border">Actions</th>
        </tr>
      </thead>
      <tbody class="text-center">
        <?php foreach($tickets as $ticket): ?>
        <tr class="hover:bg-gray-100">
          <td class="py-2 px-4 border"><?= $ticket->id ?></td>
          <td class="py-2 px-4 border"><?= $ticket->title ?></td>
          <td class="py-2 px-4 border"><?= $ticket->status ?></td>
          <td class="py-2 px-4 border"><?= $ticket->created_date ?></td>
          <td class="py-2 px-4 border">
            <a href="<?= route('admin.tickets.show', ['id' => $ticket->id]) ?>" class="text-blue-600 hover:underline mr-2">View</a>
            <a href="<?= route('admin.tickets.edit', ['id' => $ticket->id]) ?>" class="text-green-600 hover:underline mr-2">Edit</a>
            <a href="<?= route('admin.tickets.delete', ['id' => $ticket->id]) ?>" class="text-red-600 hover:underline">Delete</a>
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
