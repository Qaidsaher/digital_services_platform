<?php
$title = "Tickets List";
$activeSidebar = $activeSidebar ?? 'tickets';

ob_start();
?>
<div class="container mx-auto px-4 py-8">
  <div class="flex flex-col md:flex-row justify-between items-center mb-6">
    <h1 class="text-4xl font-bold text-gray-800">Tickets</h1>
    <!-- Session Alerts -->
    <div class="w-full md:w-auto mt-4 md:mt-0">
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
    </div>
  </div>

  <div class="flex justify-end mb-4">
    <a href="<?= route('trainee.tickets.create') ?>" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded shadow transition duration-200">
      Add New Ticket
    </a>
  </div>

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

  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6">
    <?php foreach ($tickets as $ticket): ?>
      <div class="bg-white shadow-lg rounded-lg p-6 hover:shadow-xl transition border-t-4 
    <?php
      if ($ticket->status === 'Open') {
        echo 'border-green-500'; // Green for Open
      } elseif ($ticket->status === 'Pending') {
        echo 'border-yellow-500'; // Yellow for Pending
      } elseif ($ticket->status === 'Closed') {
        echo 'border-red-500'; // Red for Closed
      } else {
        echo 'border-gray-500'; // Default Gray for unknown statuses
      }
    ?>">
        <h2 class="text-xl font-bold text-gray-700 flex items-center">
          <i class="fas fa-ticket-alt mr-2 text-blue-500"></i>#<?= $ticket->id ?> - <?= $ticket->title ?>
        </h2>
        <p class="text-gray-600 mt-2">Details: <?= $ticket->details ?></p>
        <p class="text-gray-600 mt-2">
          Status:
          <span class="font-semibold 
        <?php
        if ($ticket->status === 'Open') {
          echo 'text-green-600';
        } elseif ($ticket->status === 'Pending') {
          echo 'text-yellow-600';
        } elseif ($ticket->status === 'Closed') {
          echo 'text-red-600';
        } else {
          echo 'text-gray-600'; // Default color for unexpected statuses
        }
        ?>">
            <?= htmlspecialchars($ticket->status) ?>
          </span>
        </p>
        <p class="text-gray-500 mt-1 flex items-center"><i class="fas fa-calendar-alt mr-2"></i>Created: <?= $ticket->created_date ?></p>
        <div class="mt-4 flex justify-between text-sm">
          <a href="<?= route('trainee.tickets.show', ['id' => $ticket->id]) ?>" class="text-blue-600 hover:underline flex items-center">
            <i class="fas fa-eye mr-1"></i>View
          </a>
          <a href="<?= route('trainee.tickets.edit', ['id' => $ticket->id]) ?>" class="text-green-600 hover:underline flex items-center">
            <i class="fas fa-edit mr-1"></i>Edit
          </a>
          <a href="<?= route('trainee.tickets.delete', ['id' => $ticket->id]) ?>" class="text-red-600 hover:underline flex items-center" onclick="return confirm('Are you sure you want to delete this ticket?')">
            <i class="fas fa-trash-alt mr-1"></i>Delete
          </a>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/auth.php';
?>