<?php
$title = "Privacy Policy";
ob_start();
?>
<section class="py-20 bg-gray-50">
  <div class="container mx-auto px-6">
    <h1 class="text-4xl font-bold text-center text-gray-800 mb-8"><i class="fas fa-user-shield mr-3 text-blue-600"></i>Privacy Policy</h1>
    <div class="max-w-4xl mx-auto text-gray-700 leading-relaxed space-y-6">
      <p>
        At Digital Technical College Training & Student, your privacy is our priority. We are committed to protecting your personal data and being transparent about how we collect, use, and store your information.
      </p>
      <h2 class="text-2xl font-bold text-gray-800">Information We Collect</h2>
      <p>
        We collect information you provide directly to us during registration, when you fill out forms, or interact with our services. This may include your name, email address, contact details, and payment information.
      </p>
      <h2 class="text-2xl font-bold text-gray-800">How We Use Your Information</h2>
      <p>
        Your information is used to deliver and improve our services, communicate with you, process payments, and personalize your experience. We do not share your personal data with third parties except as necessary to comply with the law.
      </p>
      <h2 class="text-2xl font-bold text-gray-800">Data Security</h2>
      <p>
        We implement robust security measures to protect your data. Our systems are regularly monitored and updated to ensure your information remains secure.
      </p>
      <h2 class="text-2xl font-bold text-gray-800">Changes to This Policy</h2>
      <p>
        We may update our Privacy Policy periodically. Any changes will be posted on this page with an updated revision date.
      </p>
      <h2 class="text-2xl font-bold text-gray-800">Contact Us</h2>
      <p>
        If you have any questions about our Privacy Policy, please contact us via our <a href="/contact" class="text-blue-600 hover:underline">Contact page</a>.
      </p>
    </div>
  </div>
</section>
<?php
$content = ob_get_clean();
include __DIR__ . '/layouts/guest.php';
