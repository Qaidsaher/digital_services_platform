<?php 
$title = "Create Content";
$activeSidebar = "contents";

ob_start();
?>
<div class="container mx-auto py-8">
  <div class="max-w-7xl mx-auto bg-white shadow-xl rounded-lg p-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6 flex items-center">
      <i class="fas fa-plus-circle text-blue-600 mr-3"></i> Add New Content
    </h1>

    <!-- Session Alerts -->
    <?php if (isset($_SESSION['success'])): ?>
      <div class="mb-4 p-4 bg-green-50 border border-green-400 text-green-800 rounded shadow transition-opacity duration-500 fade-out">
        <?= $_SESSION['success']; unset($_SESSION['success']); ?>
      </div>
    <?php endif; ?>
    <?php if (isset($_SESSION['error'])): ?>
      <div class="mb-4 p-4 bg-red-50 border border-red-400 text-red-800 rounded shadow transition-opacity duration-500 fade-out">
        <?= $_SESSION['error']; unset($_SESSION['error']); ?>
      </div>
    <?php endif; ?>

    <form action="<?= route('supervisor.contents.create') ?>" method="POST" class="space-y-6">
      
      <!-- Title Field -->
      <div>
        <label for="title" class="block text-gray-700 font-medium mb-2">Title:</label>
        <input type="text" name="title" id="title" placeholder="Enter content title" 
               class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm" required>
      </div>

      <!-- Type Field -->
      <div>
        <label for="type" class="block text-gray-700 font-medium mb-2">Type:</label>
        <input type="text" name="type" id="type" placeholder="Enter content type"
               class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm" required>
      </div>

      <!-- Content Field -->
      <div>
        <label for="content" class="block text-gray-700 font-medium mb-2">Content:</label>
        <textarea name="content" id="content" rows="5" placeholder="Write your content here..." 
                  class="w-full border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 shadow-sm" required></textarea>
      </div>

     

      <!-- Submit Button -->
      <div class="flex justify-end">
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg transition duration-200 shadow-md flex items-center">
          <i class="fas fa-save mr-2"></i> Create Content
        </button>
      </div>
    </form>

    <!-- Back to List -->
    <div class="mt-6">
      <a href="<?= route('supervisor.contents.index') ?>" class="text-blue-600 hover:underline flex items-center">
        <i class="fas fa-arrow-left mr-2"></i> Back to List
      </a>
    </div>
  </div>
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
