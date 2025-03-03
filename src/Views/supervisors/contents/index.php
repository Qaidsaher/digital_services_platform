<?php 
$title = "Contents List";
$activeSidebar = $activeSidebar ?? 'contents';

ob_start();
?>
<div class="container mx-auto px-4 py-8">
  <div class="flex flex-col md:flex-row justify-between items-center mb-6">
    <h1 class="text-4xl font-bold text-gray-800">Contents</h1>
    
    <!-- Session Alerts -->
    <div class="w-full md:w-auto mt-4 md:mt-0">
      <?php if(isset($_SESSION['success'])): ?>
        <div class="mb-4 p-4 bg-green-50 border border-green-400 text-green-800 rounded shadow transition-opacity duration-500 fade-out">
          <?= $_SESSION['success']; unset($_SESSION['success']); ?>
        </div>
      <?php endif; ?>
      <?php if(isset($_SESSION['error'])): ?>
        <div class="mb-4 p-4 bg-red-50 border border-red-400 text-red-800 rounded shadow transition-opacity duration-500 fade-out">
          <?= $_SESSION['error']; unset($_SESSION['error']); ?>
        </div>
      <?php endif; ?>
    </div>
  </div>

  <div class="flex justify-end mb-6">
    <a href="<?= route('supervisor.contents.create') ?>" 
       class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg shadow-md transition duration-200 flex items-center">
      <i class="fas fa-plus-circle mr-2"></i> Add New Content
    </a>
  </div>



  <?php if(empty($contents)): ?>
    <p class="text-gray-600 text-center text-lg">No contents available.</p>
  <?php else: ?>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <?php foreach($contents as $contentItem): ?>
        <div class="bg-white shadow-lg rounded-lg p-6 hover:shadow-2xl transition-all duration-300 border border-gray-200">
          <h2 class="text-xl font-semibold text-gray-800 flex items-center">
            <i class="fas fa-file-alt text-blue-600 mr-2"></i> <?= htmlspecialchars($contentItem->title) ?>
          </h2>
          <p class="text-gray-500 text-sm mt-2"><?= htmlspecialchars($contentItem->type) ?></p>
          <p class="text-gray-400 text-xs mt-3">
            <i class="fas fa-clock mr-1"></i> <?= htmlspecialchars($contentItem->created_at) ?>
          </p>

          <!-- Action Buttons -->
          <div class="flex justify-between items-center mt-6">
            <a href="<?= route('supervisor.contents.show', ['id' => $contentItem->id]) ?>" 
               class="text-blue-600 hover:underline flex items-center">
              <i class="fas fa-eye mr-1"></i> View
            </a>

            <?php if ($contentItem->creator_supervisor_id == $_SESSION['supervisor_id']): ?>
              <a href="<?= route('supervisor.contents.edit', ['id' => $contentItem->id]) ?>" 
                 class="text-green-600 hover:underline flex items-center">
                <i class="fas fa-edit mr-1"></i> Edit
              </a>
              <a href="<?= route('supervisor.contents.delete', ['id' => $contentItem->id]) ?>" 
                 class="text-red-600 hover:underline flex items-center"
                 onclick="return confirm('Are you sure you want to delete this content?')">
                <i class="fas fa-trash-alt mr-1"></i> Delete
              </a>
            <?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>

<script>
  // Fade out success and error messages after 5 seconds
  setTimeout(() => {
    document.querySelectorAll('.fade-out').forEach(el => el.style.opacity = '0');
  }, 5000);
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../../layouts/auth.php';
?>
