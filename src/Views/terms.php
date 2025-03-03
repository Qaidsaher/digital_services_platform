<?php
$title = "Terms of Service";
ob_start();
?>
<section class="py-20 bg-white">
  <div class="container mx-auto px-6">
    <h1 class="text-4xl font-bold text-center text-gray-800 mb-8"><i class="fas fa-file-contract mr-3 text-blue-600"></i>Terms of Service</h1>
    <div class="max-w-4xl mx-auto text-gray-700 leading-relaxed space-y-6">
      <h2 class="text-2xl font-bold text-gray-800">Introduction</h2>
      <p>
        Welcome to Digital Technical College Training & Student. These Terms of Service govern your use of our website and services. By accessing our site, you agree to these terms.
      </p>
      <h2 class="text-2xl font-bold text-gray-800">User Responsibilities</h2>
      <p>
        You agree to use our services responsibly and comply with all applicable laws. Unauthorized use of our site or services is strictly prohibited.
      </p>
      <h2 class="text-2xl font-bold text-gray-800">Account Terms</h2>
      <p>
        When you create an account, you must provide accurate information. You are responsible for maintaining the confidentiality of your account credentials and for all activities that occur under your account.
      </p>
      <h2 class="text-2xl font-bold text-gray-800">Payment & Refund Policy</h2>
      <p>
        Payments for our services are processed securely. All sales are final unless stated otherwise in our refund policy. Please review our payment terms before making a purchase.
      </p>
      <h2 class="text-2xl font-bold text-gray-800">Modifications to the Terms</h2>
      <p>
        We reserve the right to modify these Terms at any time. Continued use of our services indicates your acceptance of any changes.
      </p>
      <h2 class="text-2xl font-bold text-gray-800">Limitation of Liability</h2>
      <p>
        Under no circumstances shall Digital Technical College Training & Student be liable for any damages arising out of your use of our services.
      </p>
      <h2 class="text-2xl font-bold text-gray-800">Governing Law</h2>
      <p>
        These Terms shall be governed by and construed in accordance with the laws of the applicable jurisdiction.
      </p>
      <h2 class="text-2xl font-bold text-gray-800">Contact Information</h2>
      <p>
        For any questions regarding these Terms, please contact us via our <a href="/contact" class="text-blue-600 hover:underline">Contact Us</a> page.
      </p>
    </div>
  </div>
</section>
<?php
$content = ob_get_clean();
include __DIR__ . '/layouts/guest.php';
