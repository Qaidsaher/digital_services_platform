<?php
$title = "Help & Support";
ob_start();
?>
<!-- Hero / Intro Section -->
<section class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white py-20">
  <div class="container mx-auto px-6 text-center">
    <h1 class="text-4xl md:text-6xl font-extrabold mb-4"><i class="fas fa-life-ring mr-3"></i>Help & Support</h1>
    <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto">
      We’re here to help! Find answers to frequently asked questions and reach out to our dedicated support team.
    </p>
  </div>
</section>

<!-- FAQ Section -->
<section class="py-20 bg-gray-50">
  <div class="container mx-auto px-6">
    <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Frequently Asked Questions</h2>
    <div class="space-y-8 max-w-4xl mx-auto">
      <div class="p-6 bg-white rounded-lg shadow hover:shadow-xl transition">
        <h3 class="text-2xl font-bold text-gray-800 flex items-center mb-2">
          <i class="fas fa-question-circle text-blue-600 mr-2"></i>How do I register?
        </h3>
        <p class="text-gray-700 leading-relaxed">
          Registration is simple and fast. Click the "Register" button on the homepage, fill in your details, and you’ll be ready to access our world-class training programs.
        </p>
      </div>
      <div class="p-6 bg-white rounded-lg shadow hover:shadow-xl transition">
        <h3 class="text-2xl font-bold text-gray-800 flex items-center mb-2">
          <i class="fas fa-question-circle text-blue-600 mr-2"></i>What courses do you offer?
        </h3>
        <p class="text-gray-700 leading-relaxed">
          We offer a variety of courses including Web Development, Data Science, Digital Marketing, and more. Each course is designed to provide practical, hands-on experience.
        </p>
      </div>
      <div class="p-6 bg-white rounded-lg shadow hover:shadow-xl transition">
        <h3 class="text-2xl font-bold text-gray-800 flex items-center mb-2">
          <i class="fas fa-question-circle text-blue-600 mr-2"></i>How can I contact support?
        </h3>
        <p class="text-gray-700 leading-relaxed">
          If you need further assistance, please visit our Contact page or email our support team directly at <a href="mailto:support@example.com" class="text-blue-600 hover:underline">support@example.com</a>.
        </p>
      </div>
      <div class="p-6 bg-white rounded-lg shadow hover:shadow-xl transition">
        <h3 class="text-2xl font-bold text-gray-800 flex items-center mb-2">
          <i class="fas fa-question-circle text-blue-600 mr-2"></i>What payment methods are accepted?
        </h3>
        <p class="text-gray-700 leading-relaxed">
          We accept all major credit cards, PayPal, and bank transfers. For more details, please check our payment policy on the registration page.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- Call-to-Action Section -->
<section class="bg-blue-600 text-white py-16">
  <div class="container mx-auto px-6 text-center">
    <h2 class="text-3xl font-bold mb-4">Need More Help?</h2>
    <p class="text-xl mb-8 max-w-2xl mx-auto">
      Our support team is available 24/7 to assist you with any questions or concerns.
    </p>
    <a href="/contact" class="bg-white text-blue-600 font-bold py-3 px-8 rounded-full shadow hover:bg-gray-200 transition duration-300">
      Contact Support
    </a>
  </div>
</section>

<?php
$content = ob_get_clean();
include __DIR__ . '/layouts/guest.php';
