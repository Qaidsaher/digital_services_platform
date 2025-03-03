<?php
$title = "Create Ticket";
$activeSidebar = $activeSidebar ?? 'tickets';

ob_start();
?>
<div class="container mx-auto py-8">
  <div class="max-w-7xl mx-auto bg-white shadow-xl rounded-lg p-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6 ">Add New Ticket</h1>

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

    <form action="<?= route('trainee.tickets.create') ?>" method="POST" class="space-y-6">
      <div>
        <label for="title" class="block text-gray-700 font-medium mb-2">Title:</label>
        <input type="text" name="title" id="title" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
      </div>

      <div>
        <label for="details" class="block text-gray-700 font-medium mb-2">Details:</label>
        <textarea name="details" id="details" rows="5" class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
      </div>


  </div>

  <div class="flex justify-end">
    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-md transition duration-200">
      Create Ticket
    </button>
  </div>
  </form>

  <div class="mt-6 text-left">
    <a href="<?= route('trainee.tickets.index') ?>" class="text-blue-600 hover:underline">
      Back to List
    </a>
  </div>
</div>
</div>

<script>
  // Update the styling of the status buttons when one is clicked.
  document.querySelectorAll('.status-label').forEach(label => {
    label.addEventListener('click', function() {
      // Reset all labels to their default class
      document.querySelectorAll('.status-label').forEach(l => {
        l.className = "status-label cursor-pointer px-2 py-1 rounded-sm border transition-all duration-300 " + l.dataset.defaultClass;
      });
      // Set the clicked label to its active class
      this.className = "status-label cursor-pointer px-2 py-1 rounded-sm border transition-all duration-300 " + this.dataset.activeClass;
    });
  });
</script>
<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/auth.php';
?>