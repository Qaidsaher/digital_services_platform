<?php
$title = "Contact Us";
ob_start();
?>
<!-- Hero Section -->
<section class="bg-gradient-to-r from-indigo-700 to-blue-600 text-white py-20">
  <div class="container mx-auto px-6 text-center">
    <h1 class="text-4xl md:text-6xl font-extrabold mb-4"><i class="fas fa-envelope-open-text mr-3"></i>Contact Us</h1>
    <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto">
      We’d love to hear from you! Whether you have questions, feedback, or need assistance, our team is here to help.
    </p>
  </div>
</section>

<!-- Contact Form & Details -->
<section class="py-20 bg-white">
  <div class="container mx-auto px-6">
    <div class="flex flex-col md:flex-row gap-12">
      <!-- Contact Form -->
      <div class="w-full md:w-2/3">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Send Us a Message</h2>
        <form action="/contact-submit" method="POST" class="bg-gray-50 p-8 rounded-lg shadow-lg">
          <div class="mb-6">
            <label for="name" class="block text-gray-700 font-bold mb-2">
              <i class="fas fa-user mr-2"></i>Name
            </label>
            <input type="text" id="name" name="name" required class="w-full p-3 border rounded-md focus:outline-none focus:ring focus:border-blue-300">
          </div>
          <div class="mb-6">
            <label for="email" class="block text-gray-700 font-bold mb-2">
              <i class="fas fa-envelope mr-2"></i>Email
            </label>
            <input type="email" id="email" name="email" required class="w-full p-3 border rounded-md focus:outline-none focus:ring focus:border-blue-300">
          </div>
          <div class="mb-6">
            <label for="subject" class="block text-gray-700 font-bold mb-2">
              <i class="fas fa-tag mr-2"></i>Subject
            </label>
            <input type="text" id="subject" name="subject" required class="w-full p-3 border rounded-md focus:outline-none focus:ring focus:border-blue-300">
          </div>
          <div class="mb-6">
            <label for="message" class="block text-gray-700 font-bold mb-2">
              <i class="fas fa-comment-dots mr-2"></i>Message
            </label>
            <textarea id="message" name="message" rows="5" required class="w-full p-3 border rounded-md focus:outline-none focus:ring focus:border-blue-300"></textarea>
          </div>
          <div class="text-center">
            <button type="submit" class="bg-blue-600 text-white font-bold py-3 px-10 rounded-full hover:bg-blue-700 transition duration-300">
              Send Message
            </button>
          </div>
        </form>
      </div>
      <!-- Contact Details -->
      <div class="w-full md:w-1/3">
        <h2 class="text-3xl font-bold text-gray-800 mb-6">Get in Touch</h2>
        <div class="space-y-6 text-gray-700">
          <div class="flex items-center">
            <i class="fas fa-phone fa-2x text-blue-600 mr-4"></i>
            <div>
              <h3 class="font-bold">Phone</h3>
              <p>+1 234 567 890</p>
            </div>
          </div>
          <div class="flex items-center">
            <i class="fas fa-map-marker-alt fa-2x text-blue-600 mr-4"></i>
            <div>
              <h3 class="font-bold">Address</h3>
              <p>1234 College St, Digital City, Country</p>
            </div>
          </div>
          <div class="flex items-center">
            <i class="fas fa-envelope fa-2x text-blue-600 mr-4"></i>
            <div>
              <h3 class="font-bold">Email</h3>
              <p><a href="mailto:info@example.com" class="text-blue-600 hover:underline">info@example.com</a></p>
            </div>
          </div>
          <div class="flex items-center">
            <i class="fas fa-clock fa-2x text-blue-600 mr-4"></i>
            <div>
              <h3 class="font-bold">Business Hours</h3>
              <p>Mon - Fri: 9am - 6pm</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
$content = ob_get_clean();
include __DIR__ . '/layouts/guest.php';
