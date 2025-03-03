<?php
$title = "My Contents";
$activeSidebar = $activeSidebar ?? 'contents';

ob_start();
?>
<div class="container mx-auto px-4 py-8">
  <div class="flex flex-col md:flex-row justify-between items-center mb-6">
    <h1 class="text-4xl font-bold text-gray-800">My Contents</h1>

    <!-- Session Alerts -->
    <div class="w-full md:w-auto mt-4 md:mt-0">
      <?php if (isset($_SESSION['success'])): ?>
        <div class="mb-4 p-4 bg-green-50 border border-green-400 text-green-800 rounded shadow">
          <?= $_SESSION['success']; unset($_SESSION['success']); ?>
        </div>
      <?php endif; ?>
      <?php if (isset($_SESSION['error'])): ?>
        <div class="mb-4 p-4 bg-red-50 border border-red-400 text-red-800 rounded shadow">
          <?= $_SESSION['error']; unset($_SESSION['error']); ?>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <!-- Content List -->
  <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6">
    <?php if (empty($contents)): ?>
      <p class="text-gray-600 col-span-3">No contents available.</p>
    <?php else: ?>
      <?php foreach ($contents as $content): ?>
        <a href="<?= route('trainee.contents.show', ['id' => $content->id]) ?>" class="block">
          <div class="bg-white shadow-lg rounded-lg p-6 hover:shadow-xl transition border-t-4 border-blue-500 cursor-pointer">
            <h2 class="text-xl font-bold text-gray-700 flex items-center">
              <i class="fas fa-file-alt mr-2 text-blue-500"></i>#<?= $content->id ?> - <?= htmlspecialchars($content->content) ?>
            </h2>
            <p class="text-gray-600 mt-2">Type: <strong><?= htmlspecialchars($content->type) ?></strong></p>
            <p class="text-gray-500 mt-1 flex items-center"><i class="fas fa-calendar-alt mr-2"></i>Created: <?= htmlspecialchars($content->created_at) ?></p>
          </div>
        </a>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</div>
<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/auth.php';
?>
