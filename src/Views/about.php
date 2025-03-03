<?php
$title = "About Us";
ob_start();
?>
<!-- Hero Section -->
<section class="relative bg-cover bg-center bg-no-repeat" style="background-image: url('/images/about-hero.jpg');">
  <div class="absolute inset-0 bg-black opacity-50"></div>
  <div class="relative container mx-auto px-6 py-28 text-center">
    <h1 class="text-5xl md:text-7xl font-extrabold text-white mb-4">About Us</h1>
    <p class="text-xl md:text-2xl text-gray-200">
      Discover our story, our mission, and the passionate team behind our success.
    </p>
  </div>
</section>

<!-- Our Story Section -->
<section class="py-20 bg-gray-50">
  <div class="container mx-auto px-6">
    <div class="flex flex-col md:flex-row items-center">
      <div class="md:w-1/2">
        <h2 class="text-4xl font-bold text-gray-800 mb-6">Our Story</h2>
        <p class="text-gray-700 leading-relaxed mb-6">
          Founded with a vision to revolutionize digital education, Digital Technical College Training & Student began as a small initiative. Today, we have grown into a leading institution, dedicated to providing cutting-edge training programs that blend theory with practical experience.
        </p>
        <p class="text-gray-700 leading-relaxed">
          We believe in empowering every student with the knowledge and skills necessary to excel in the digital age, while fostering a culture of innovation and continuous learning.
        </p>
      </div>
      <div class="md:w-1/2 mt-8 md:mt-0">
        <img src="/images/our-story.jpg" alt="Our Story" class="w-full rounded-lg shadow-2xl">
      </div>
    </div>
  </div>
</section>

<!-- Mission & Vision Section -->
<section class="py-20 bg-white">
  <div class="container mx-auto px-6 text-center">
    <h2 class="text-4xl font-bold text-gray-800 mb-12">Our Mission & Vision</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
      <div class="p-8 bg-gray-50 rounded-lg shadow-lg transform hover:scale-105 transition">
        <h3 class="text-3xl font-bold text-blue-600 mb-4"><i class="fas fa-bullseye mr-2"></i>Our Mission</h3>
        <p class="text-gray-700 leading-relaxed">
          To empower individuals by providing state-of-the-art training and education, fostering innovation, and bridging the gap between academic learning and industry needs.
        </p>
      </div>
      <div class="p-8 bg-gray-50 rounded-lg shadow-lg transform hover:scale-105 transition">
        <h3 class="text-3xl font-bold text-blue-600 mb-4"><i class="fas fa-eye mr-2"></i>Our Vision</h3>
        <p class="text-gray-700 leading-relaxed">
          To become a global leader in digital education, nurturing talent and driving the future of technology and business through excellence in training.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- Meet the Team Section -->
<section class="py-20 bg-gray-100">
  <div class="container mx-auto px-6">
    <h2 class="text-4xl font-bold text-center text-gray-800 mb-12">Meet Our Team</h2>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      <!-- Team Member 1 -->
      <div class="bg-white rounded-lg shadow-lg p-8 text-center transform hover:scale-105 transition">
        <img src="/images/team1.jpg" alt="Team Member" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover">
        <h3 class="text-2xl font-bold text-gray-800">John Doe</h3>
        <p class="text-blue-600 mb-2">Founder & CEO</p>
        <p class="text-gray-600">A visionary leader passionate about transforming education and technology.</p>
      </div>
      <!-- Team Member 2 -->
      <div class="bg-white rounded-lg shadow-lg p-8 text-center transform hover:scale-105 transition">
        <img src="/images/team2.jpg" alt="Team Member" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover">
        <h3 class="text-2xl font-bold text-gray-800">Jane Smith</h3>
        <p class="text-blue-600 mb-2">Chief Academic Officer</p>
        <p class="text-gray-600">Dedicated to creating an innovative curriculum that bridges theory and practice.</p>
      </div>
      <!-- Team Member 3 -->
      <div class="bg-white rounded-lg shadow-lg p-8 text-center transform hover:scale-105 transition">
        <img src="/images/team3.jpg" alt="Team Member" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover">
        <h3 class="text-2xl font-bold text-gray-800">Alice Johnson</h3>
        <p class="text-blue-600 mb-2">Head of Training</p>
        <p class="text-gray-600">Committed to ensuring every student gains hands-on, real-world experience.</p>
      </div>
    </div>
  </div>
</section>

<!-- Call-to-Action Section -->
<section class="bg-gradient-to-r from-indigo-700 to-blue-600 text-white py-20">
  <div class="container mx-auto px-6 text-center">
    <h2 class="text-4xl font-bold mb-4">Join Our Journey</h2>
    <p class="text-xl mb-8 max-w-2xl mx-auto">
      Become a part of our innovative community and unlock your full potential with our comprehensive programs.
    </p>
    <a href="<?= route('register') ?>" class="bg-white text-blue-600 font-bold py-3 px-10 rounded-full shadow-lg hover:bg-gray-200 transition duration-300">
      Get Started Today
    </a>
  </div>
</section>

<?php
$content = ob_get_clean();
include __DIR__ . '/layouts/guest.php';
