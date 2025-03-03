<?php
use App\Models\Ticket;

$title = "Welcome";

// Start output buffering to capture the page content
ob_start();
?>

<!-- Hero Section -->
<section class="bg-blue-600 text-white py-32">
    <div class="container mx-auto px-8 text-center max-w-5xl">
        <h1 class="text-5xl md:text-7xl font-extrabold leading-tight mb-6">
            Welcome to Digital Technical College Training & Student
        </h1>
        <p class="text-xl md:text-3xl mb-10 font-light">
            Empowering your future with world-class training and education.
        </p>
        <?php if (!auth()->check()): ?>
        <div class="space-x-4">
            <a href="<?= route('register') ?>" class="bg-white text-blue-600 font-bold py-4 px-10 rounded-full shadow-lg hover:bg-gray-200 transition duration-300 text-xl">
                Get Started
            </a>
            <a href="<?= route('login') ?>" class="bg-transparent border border-white text-white font-bold py-4 px-10 rounded-full hover:bg-white hover:text-blue-600 transition duration-300 text-xl">
                Login
            </a>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- About Section -->
<section class="py-32 bg-gray-100">
    <div class="container mx-auto px-8 flex flex-col md:flex-row items-center max-w-6xl">
        <div class="md:w-1/2">
            <h2 class="text-4xl font-extrabold mb-6">About Us</h2>
            <p class="text-gray-700 text-lg mb-6">
                At Digital Technical College Training & Student, we provide industry-leading courses, hands-on projects, and expert mentorship. Our mission is to empower students and professionals with the skills needed to thrive in the digital world.
            </p>
        </div>
        <div class="md:w-1/2 mt-8 md:mt-0">
            <img src="/images/about.jpg" alt="About Us" class="rounded-xl shadow-xl">
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-32 bg-white">
    <div class="container mx-auto px-8 max-w-6xl">
        <h2 class="text-4xl font-extrabold text-center mb-16">Our Features</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
            <div class="bg-white rounded-xl shadow-xl p-8 text-center">
                <h3 class="text-2xl font-bold mb-4">Tickets Management</h3>
                <p class="text-gray-700 text-lg">Manage and track support tickets efficiently.</p>
            </div>
            <div class="bg-white rounded-xl shadow-xl p-8 text-center">
                <h3 class="text-2xl font-bold mb-4">Supervisors</h3>
                <p class="text-gray-700 text-lg">Connect with experienced supervisors for guidance.</p>
            </div>
            <div class="bg-white rounded-xl shadow-xl p-8 text-center">
                <h3 class="text-2xl font-bold mb-4">Trainees</h3>
                <p class="text-gray-700 text-lg">Engage with hands-on training programs.</p>
            </div>
        </div>
    </div>
</section>

<!-- Tickets Section -->
<section class="py-32 bg-gray-100">
    <div class="container mx-auto px-8 max-w-6xl">
        <h2 class="text-4xl font-extrabold text-center mb-16">Ticket System</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
            <?php foreach (Ticket::all() as $ticket): ?>
                <div class="bg-white rounded-xl shadow-xl overflow-hidden">
                    <div class="p-8">
                        <h3 class="text-2xl font-bold mb-4">Ticket #<?= $ticket->id ?></h3>
                        <p class="text-gray-700 text-lg mb-6">Status: <?= $ticket->status ?></p>
                        <a href="<?= route('ticket.details', ['id' => $ticket->id]) ?>" class="text-blue-600 font-bold hover:underline text-lg">View Details</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Call-to-Action Section -->
<section class="bg-blue-600 text-white py-32">
    <div class="container mx-auto px-8 text-center max-w-5xl">
        <h2 class="text-4xl font-extrabold mb-8">Ready to take the next step?</h2>
        <a href="<?= route('register') ?>" class="bg-white text-blue-600 font-bold py-4 px-12 rounded-full shadow-lg hover:bg-gray-200 transition duration-300 text-xl">
            Register Now
        </a>
    </div>
</section>



<?php
// Capture the content into a variable
$content = ob_get_clean();

// Include the layout
include __DIR__ . '/layouts/guest.php';
?>