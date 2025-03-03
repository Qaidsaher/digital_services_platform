<?php
$title = "Ticket Details";
$activeSidebar = $activeSidebar ?? 'tickets';

ob_start();
?>
<div class="container mx-auto py-2">
  <div class="max-w-7xl mx-auto bg-white shadow-lg rounded-lg p-6">
    <h1 class="text-4xl font-bold text-gray-900 mb-6 flex items-center">
      <i class="fas fa-ticket-alt text-blue-600 mr-3"></i> Ticket Details
    </h1>

    <!-- Session Alerts (Hidden After 5 Seconds) -->
    <?php if (isset($_SESSION['success'])): ?>
      <div id="success-message" class="mb-4 p-4 bg-green-100 border border-green-400 text-green-800 rounded-md shadow">
        <?= $_SESSION['success'];
        unset($_SESSION['success']); ?>
      </div>
    <?php endif; ?>
    <?php if (isset($_SESSION['error'])): ?>
      <div id="error-message" class="mb-4 p-4 bg-red-100 border border-red-400 text-red-800 rounded-md shadow">
        <?= $_SESSION['error'];
        unset($_SESSION['error']); ?>
      </div>
    <?php endif; ?>

    <!-- Ticket Details Card -->
    <div class="bg-gray-50 p-6 rounded-lg shadow-md mb-8">
      <div class="grid grid-cols-2 gap-4">
        <p><i class="fas fa-hashtag text-gray-500"></i> <span class="font-semibold text-gray-700">ID:</span> <span class="text-gray-600">#<?= htmlspecialchars($ticket->id) ?></span></p>
        <p><i class="fas fa-info-circle text-gray-500"></i> <span class="font-semibold text-gray-700">Status:</span> <span class="text-gray-600"><?= htmlspecialchars($ticket->status) ?></span></p>
        <p><i class="fas fa-heading text-gray-500"></i> <span class="font-semibold text-gray-700">Title:</span> <span class="text-gray-600"><?= htmlspecialchars($ticket->title) ?></span></p>
        <p><i class="fas fa-calendar-alt text-gray-500"></i> <span class="font-semibold text-gray-700">Created Date:</span> <span class="text-gray-600"><?= htmlspecialchars($ticket->created_date) ?></span></p>
      </div>
      <p class="mt-4 flex items-center"><i class="fas fa-align-left text-gray-500 mr-2"></i> <span class="font-semibold text-gray-700">Details:</span></p>
      <p class="text-gray-600"> <?= nl2br(htmlspecialchars($ticket->details)) ?></p>
    </div>

    <!-- Comments Section -->
    <div class="mb-8">
      <h2 class="text-2xl font-semibold text-gray-900 mb-4 flex items-center">
        <i class="fas fa-comments text-blue-600 mr-3"></i> Comments
      </h2>
      <?php if (empty($comments)): ?>
        <p class="text-gray-600">No comments yet.</p>
      <?php else: ?>
        <div class="space-y-4 px-4">
          <?php foreach ($comments as $comment): ?>
            <div class="bg-gray-100 border border-gray-200 rounded-md p-4 shadow-sm">
              <p class="text-gray-700 mb-2"><i class="fas fa-user text-gray-500"></i> <?= nl2br(htmlspecialchars($comment->getText())) ?> </p>
              <p class="text-sm text-gray-500"><i class="fas fa-calendar text-gray-500"></i> By <strong><?= htmlspecialchars($comment->creator_type) ?></strong> on <?= htmlspecialchars($comment->date) ?></p>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>

    <!-- Supervisor Comment Form -->
    <div class="mt-8">
      <h2 class="text-2xl font-semibold text-gray-900 mb-4 flex items-center">
        <i class="fas fa-comment-dots text-blue-600 mr-3"></i> Add a Comment (Supervisor)
      </h2>
      <form action="<?= route('supervisor.comments.store') ?>" method="POST" class="bg-white p-6 shadow-md rounded-md border border-gray-200">
        <input type="hidden" name="ticket_id" value="<?= htmlspecialchars($ticket->id) ?>">

        <div class="mb-4">
          <label for="comment" class="block text-gray-700 font-medium mb-2">Your Comment</label>
          <textarea id="comment" name="text" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400" required></textarea>
        </div>

        <div class="text-right">
          <button type="submit" class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-md shadow-md hover:bg-blue-700 transition">
            <i class="fas fa-paper-plane mr-2"></i> Submit Comment
          </button>
        </div>
      </form>
    </div>

    <!-- Back Link -->
    <div class="text-right mt-6">
      <a href="<?= route('supervisor.tickets.index') ?>" class="px-4 py-2 text-white bg-blue-600 hover:bg-blue-700 rounded-md shadow-md font-medium">
        <i class="fas fa-arrow-left mr-2"></i> Back to List
      </a>
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
include __DIR__ . '/../../layouts/auth.php';
?>