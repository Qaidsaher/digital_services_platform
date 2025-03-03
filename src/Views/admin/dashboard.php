<?php
$title = "Admin Dashboard";
$activeSidebar = $activeSidebar ?? 'dashboard';
ob_start();
?>
<div class="container mx-auto px-4 py-6">
  <h1 class="text-3xl font-bold mb-6">Admin Dashboard</h1>

  <!-- Statistics Cards -->
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
    <!-- Supervisors Card -->
    <div class="flex items-center bg-white shadow rounded p-6">
      <div class="bg-blue-500 p-4 rounded-full mr-4">
        <i class="fas fa-chalkboard-teacher text-white text-3xl"></i>
      </div>
      <div>
        <h2 class="text-xl font-semibold text-gray-700">Supervisors</h2>
        <p class="text-3xl font-bold text-gray-800 w-10 h-10"><?= $stats['totalSupervisors'] ?></p>
      </div>
    </div>
    <!-- Trainees Card -->
    <div class="flex items-center bg-white shadow rounded p-6">
      <div class="bg-purple-500 p-4 rounded-full mr-4">
        <i class="fas fa-user-graduate text-white text-3xl w-10 h-10"></i>
      </div>
      <div>
        <h2 class="text-xl font-semibold text-gray-700">Trainees</h2>
        <p class="text-3xl font-bold text-gray-800 w-10 h-10"><?= $stats['totalTrainees'] ?></p>
      </div>
    </div>
    <!-- Tickets Card -->
    <div class="flex items-center bg-white shadow rounded p-6">
      <div class="bg-red-500 p-4 rounded-full mr-4">
        <i class="fas fa-ticket-alt text-white text-3xl w-10 h-10 text-center"></i>
      </div>
      <div>
        <h2 class="text-xl font-semibold text-gray-700">Tickets</h2>
        <p class="text-3xl font-bold text-gray-800  "><?= $stats['totalTickets'] ?></p>
      </div>
    </div>
    <!-- Contents Card -->
    <div class="flex items-center bg-white shadow rounded p-6">
      <div class="bg-orange-500 p-4 rounded-full mr-4">
        <i class="fas fa-file-alt text-white text-3xl  w-10 h-10 text-center"></i>
      </div>
      <div>
        <h2 class="text-xl font-semibold text-gray-700">Contents</h2>
        <p class="text-3xl font-bold text-gray-800  "><?= $stats['totalContents'] ?></p>
      </div>
    </div>
    <!-- Comments Card -->
    <div class="flex items-center bg-white shadow rounded p-6">
      <div class="bg-pink-500 p-4 rounded-full mr-4">
        <i class="fas fa-comments text-white text-3xl w-10 h-10 text-center"></i>
      </div>
      <div>
        <h2 class="text-xl font-semibold text-gray-700">Comments</h2>
        <p class="text-3xl font-bold text-gray-800  "><?= $stats['totalComments'] ?></p>
      </div>
    </div>
  </div>

  <!-- Tickets by Status Chart -->
  <div class="bg-white shadow rounded p-6 mb-6">
    <h2 class="text-xl font-semibold mb-4 flex items-center">
      <i class="fas fa-chart-bar mr-2 text-gray-600"></i> Tickets by Status
    </h2>
    <canvas id="ticketsStatusChart"></canvas>
  </div>

  <!-- Recent Tickets List -->
  <div class="bg-white shadow rounded p-6 mb-6">
    <h2 class="text-xl font-semibold mb-4 flex items-center">
      <i class="fas fa-ticket-alt mr-2 text-red-500"></i> Recent Tickets
    </h2>
    <?php if(count($recentTickets)): ?>
      <ul class="space-y-2">
        <?php foreach($recentTickets as $ticket): ?>
          <li class="p-2 bg-gray-50 rounded hover:bg-gray-100">
            <span class="font-semibold"><?= htmlspecialchars($ticket->title) ?></span>
            <span class="text-sm text-gray-500">- <?= date('M d, Y', strtotime($ticket->created_date)) ?></span>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php else: ?>
      <p class="text-gray-600">No recent tickets.</p>
    <?php endif; ?>
  </div>

  <!-- Recent Comments List -->
  <div class="bg-white shadow rounded p-6 mb-6">
    <h2 class="text-xl font-semibold mb-4 flex items-center">
      <i class="fas fa-comments mr-2 text-pink-500"></i> Recent Comments
    </h2>
    <?php if(count($recentComments)): ?>
      <ul class="space-y-2">
        <?php foreach($recentComments as $comment): ?>
          <li class="p-2 bg-gray-50 rounded hover:bg-gray-100">
            <span class="font-semibold"><?= htmlspecialchars(substr($comment->text, 0, 50)) ?>...</span>
            <span class="text-sm text-gray-500">(<?= date('M d, Y', strtotime($comment->date)) ?>)</span>
          </li>
        <?php endforeach; ?>
      </ul>
    <?php else: ?>
      <p class="text-gray-600">No recent comments.</p>
    <?php endif; ?>
  </div>

  <!-- New Supervisors & Trainees -->
  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- New Supervisors -->
    <div class="bg-white shadow rounded p-6">
      <h2 class="text-xl font-semibold mb-4 flex items-center">
        <i class="fas fa-chalkboard-teacher mr-2 text-green-500"></i> New Supervisors
      </h2>
      <?php if(count($newSupervisors)): ?>
        <ul class="space-y-1">
          <?php foreach($newSupervisors as $sup): ?>
            <li class="p-2 bg-gray-50 rounded hover:bg-gray-100">
              <?= htmlspecialchars($sup->name) ?> <span class="text-sm text-gray-500">(<?= htmlspecialchars($sup->email) ?>)</span>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php else: ?>
        <p class="text-gray-600">No new supervisors.</p>
      <?php endif; ?>
    </div>
    <!-- New Trainees -->
    <div class="bg-white shadow rounded p-6">
      <h2 class="text-xl font-semibold mb-4 flex items-center">
        <i class="fas fa-user-graduate mr-2 text-purple-500"></i> New Trainees
      </h2>
      <?php if(count($newTrainees)): ?>
        <ul class="space-y-1">
          <?php foreach($newTrainees as $trainee): ?>
            <li class="p-2 bg-gray-50 rounded hover:bg-gray-100">
              <?= htmlspecialchars($trainee->name) ?> <span class="text-sm text-gray-500">(<?= htmlspecialchars($trainee->email) ?>)</span>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php else: ?>
        <p class="text-gray-600">No new trainees.</p>
      <?php endif; ?>
    </div>
  </div>
</div>

<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('ticketsStatusChart').getContext('2d');
  const chartLabels = [
    <?php
      $labels = [];
      $dataCounts = [];
      foreach($ticketsByStatus as $row) {
          $labels[] = '"' . $row['status'] . '"';
          $dataCounts[] = $row['count'];
      }
      echo implode(", ", $labels);
    ?>
  ];
  const chartData = {
    labels: chartLabels,
    datasets: [{
      label: 'Tickets',
      data: [<?= implode(", ", $dataCounts) ?>],
      backgroundColor: [
        'rgba(239,68,68,0.5)',
        'rgba(234,179,8,0.5)',
        'rgba(34,197,94,0.5)',
        'rgba(59,130,246,0.5)',
        'rgba(107,114,128,0.5)'
      ],
      borderColor: [
        'rgba(239,68,68,1)',
        'rgba(234,179,8,1)',
        'rgba(34,197,94,1)',
        'rgba(59,130,246,1)',
        'rgba(107,114,128,1)'
      ],
      borderWidth: 1
    }]
  };
  const ticketsStatusChart = new Chart(ctx, {
    type: 'bar',
    data: chartData,
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true,
          precision: 0
        }
      }
    }
  });
</script>
<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/app.php';
?>
