<?php
$title = "Edit Ticket";
$activeSidebar = $activeSidebar ?? 'tickets';

ob_start();
?>
<div class="container mx-auto py-8">
  <div class="max-w-7xl mx-auto bg-white shadow-xl rounded-lg p-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Edit Ticket</h1>

    <!-- Session Alerts -->
    <?php if (isset($_SESSION['success'])): ?>
      <div class="mb-4 p-4 bg-green-50 border border-green-400 text-green-800 rounded shadow">
        <?= $_SESSION['success'];
        unset($_SESSION['success']); ?>
      </div>
    <?php endif; ?>
    <?php if (isset($_SESSION['error'])): ?>
      <div class="mb-4 p-4 bg-red-50 border border-red-400 text-red-800 rounded shadow">
        <?= $_SESSION['error'];
        unset($_SESSION['error']); ?>
      </div>
    <?php endif; ?>

    <!-- Ticket Details (Read-Only) -->
    <div class="mb-6 bg-gray-100 p-6 rounded-md shadow-md">
      <p class="text-gray-700"><strong>Title:</strong> <?= htmlspecialchars($ticket->title) ?></p>
      <p class="text-gray-700 mt-2"><strong>Details:</strong> <?= nl2br(htmlspecialchars($ticket->details)) ?></p>
    </div>

    <!-- Status Update Form -->
    <form action="<?= route('supervisor.tickets.update', ['id' => $ticket->id]) ?>" method="POST" class="space-y-6">
      <div>
        <label class="block text-gray-700 font-medium mb-2">Status:</label>
        <?php
        $statuses = ["Open", "Pending", "Closed"];
        $statusColors = [
          "Open" => "bg-green-600 hover:bg-green-700 text-white border-green-600",
          "Pending" => "bg-yellow-600 hover:bg-yellow-700 text-white border-yellow-600",
          "Closed" => "bg-red-600 hover:bg-red-700 text-white border-red-600"
        ];
        $currentStatus = $ticket->status;
        ?>
        <div class="flex space-x-4 mt-2">
          <?php foreach ($statuses as $status): ?>
            <label
              data-active-class="<?= $statusColors[$status] ?>"
              data-default-class="bg-white text-gray-600 border-gray-300"
              class="status-label cursor-pointer px-4 py-2 rounded-md border transition-all duration-300 <?= $currentStatus === $status ? $statusColors[$status] : 'bg-white text-gray-600 border-gray-300' ?>">
              <input type="radio" name="status" value="<?= $status ?>" <?= $currentStatus === $status ? "checked" : "" ?> class="hidden">
              <?= $status ?>
            </label>
          <?php endforeach; ?>
        </div>
      </div>

      <div class="flex justify-end">
        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-md transition duration-200">
          Update Ticket
        </button>
      </div>
    </form>

    <div class="mt-6 text-left">
      <a href="<?= route('supervisor.tickets.index') ?>" class="text-blue-600 hover:underline">
        Back to List
      </a>
    </div>
  </div>
</div>

<script>
  // JavaScript to update the status button styling on selection
  document.querySelectorAll('.status-label').forEach(label => {
    label.addEventListener('click', function() {
      // Reset all labels to their default classes
      document.querySelectorAll('.status-label').forEach(l => {
        l.className = "status-label cursor-pointer px-4 py-2 rounded-md border transition-all duration-300 " + l.dataset.defaultClass;
      });
      // Set the clicked label to its active class
      this.className = "status-label cursor-pointer px-4 py-2 rounded-md border transition-all duration-300 " + this.dataset.activeClass;
    });
  });
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/auth.php';
?>
