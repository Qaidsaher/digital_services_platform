<?php
$title = "Supervisor Dashboard";
ob_start();
?>

<div class="container mx-auto p-6">
  <h1 class="text-4xl font-bold text-gray-800 mb-8">Supervisor Dashboard</h1>

  <!-- Session Alerts (Hidden After 5 Seconds) -->
  <?php if (isset($_SESSION['success'])): ?>
    <div id="success-message" class="mb-4 p-4 bg-green-100 border border-green-400 text-green-800 rounded-md shadow">
      <?= $_SESSION['success']; unset($_SESSION['success']); ?>
    </div>
  <?php endif; ?>
  <?php if (isset($_SESSION['error'])): ?>
    <div id="error-message" class="mb-4 p-4 bg-red-100 border border-red-400 text-red-800 rounded-md shadow">
      <?= $_SESSION['error']; unset($_SESSION['error']); ?>
    </div>
  <?php endif; ?>

  <!-- Metrics Cards -->
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <!-- Total Tickets Card -->
    <div class="bg-white shadow rounded-lg p-6">
      <div class="flex items-center">
        <div class="p-3 bg-purple-500 rounded-full text-white mr-4">
          <i class="fas fa-ticket-alt fa-2x"></i>
        </div>
        <div>
          <p class="text-sm text-gray-500">Total Tickets</p>
          <p class="text-2xl font-semibold text-gray-800"><?= $totalTickets ?></p>
        </div>
      </div>
    </div>

    <!-- Pending Tickets Card -->
    <div class="bg-white shadow rounded-lg p-6">
      <div class="flex items-center">
        <div class="p-3 bg-yellow-500 rounded-full text-white mr-4">
          <i class="fas fa-hourglass-half fa-2x"></i>
        </div>
        <div>
          <p class="text-sm text-gray-500">Pending Tickets</p>
          <p class="text-2xl font-semibold text-gray-800"><?= $pendingTickets ?></p>
        </div>
      </div>
    </div>

    <!-- Open Tickets Card -->
    <div class="bg-white shadow rounded-lg p-6">
      <div class="flex items-center">
        <div class="p-3 bg-blue-500 rounded-full text-white mr-4">
          <i class="fas fa-folder-open fa-2x"></i>
        </div>
        <div>
          <p class="text-sm text-gray-500">Open Tickets</p>
          <p class="text-2xl font-semibold text-gray-800"><?= $openTickets ?></p>
        </div>
      </div>
    </div>

    <!-- Closed Tickets Card -->
    <div class="bg-white shadow rounded-lg p-6">
      <div class="flex items-center">
        <div class="p-3 bg-green-500 rounded-full text-white mr-4">
          <i class="fas fa-check-circle fa-2x"></i>
        </div>
        <div>
          <p class="text-sm text-gray-500">Closed Tickets</p>
          <p class="text-2xl font-semibold text-gray-800"><?= $closedTickets ?></p>
        </div>
      </div>
    </div>

    <!-- Total Contents Created -->
    <div class="bg-white shadow rounded-lg p-6">
      <div class="flex items-center">
        <div class="p-3 bg-indigo-500 rounded-full text-white mr-4">
          <i class="fas fa-file-alt fa-2x"></i>
        </div>
        <div>
          <p class="text-sm text-gray-500">Contents Created</p>
          <p class="text-2xl font-semibold text-gray-800"><?= $totalContents ?></p>
        </div>
      </div>
    </div>
  </div>

  <!-- Recent Tickets -->
  <div class="mt-12">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Recent Tickets</h2>
    <div class="bg-white shadow rounded-lg p-6">
      <?php if (empty($recentTickets)): ?>
        <p class="text-gray-600">No recent tickets assigned.</p>
      <?php else: ?>
        <ul class="divide-y divide-gray-200">
          <?php foreach ($recentTickets as $ticket): ?>
            <li class="py-4">
              <p class="text-gray-800"><strong>#<?= htmlspecialchars($ticket->id) ?>:</strong> <?= htmlspecialchars($ticket->title) ?></p>
              <p class="text-sm text-gray-500"><?= htmlspecialchars($ticket->created_at) ?></p>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
    </div>
  </div>

  <!-- Recent Comments -->
  <div class="mt-12">
    <h2 class="text-2xl font-bold text-gray-800 mb-4">Recent Comments</h2>
    <div class="bg-white shadow rounded-lg p-6">
      <?php if (empty($recentComments)): ?>
        <p class="text-gray-600">No recent comments.</p>
      <?php else: ?>
        <ul class="divide-y divide-gray-200">
          <?php foreach ($recentComments as $comment): ?>
            <li class="py-4">
              <p class="text-gray-800"><strong><?= htmlspecialchars($comment->creator_type) ?>:</strong> <?= nl2br(htmlspecialchars($comment->text)) ?></p>
              <p class="text-sm text-gray-500"><?= htmlspecialchars($comment->date) ?></p>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
    </div>
  </div>
</div>

<!-- Hide Alerts After 5 Seconds -->
<script>
  setTimeout(function() {
    let successMsg = document.getElementById("success-message");
    let errorMsg = document.getElementById("error-message");
    if (successMsg) successMsg.style.display = "none";
    if (errorMsg) errorMsg.style.display = "none";
  }, 5000);
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/auth.php';
?>
