<?php
$title = "Ticket Details";
$activeSidebar = $activeSidebar ?? 'tickets';

ob_start();
?>
<div class="container mx-auto px-4">
  <h1 class="text-3xl font-bold mb-6">Ticket Details</h1>

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

  <div class="bg-white shadow rounded p-6">
    <p><strong>ID:</strong> <?= $ticket->id ?></p>
    <p><strong>Title:</strong> <?= $ticket->title ?></p>
    <p><strong>Details:</strong> <?= $ticket->details ?></p>
    <p><strong>Status:</strong> <?= $ticket->status ?></p>
    <p><strong>Created Date:</strong> <?= $ticket->created_date ?></p>
  </div>
  <a href="<?= route('admin.tickets.index') ?>" class="mt-4 inline-block text-blue-600 hover:underline">Back to List</a>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/app.php';
?>
