<?php
$title = "My Profile";
$activeSidebar = "account";
ob_start();
?>

<div class="container mx-auto py-8">
    <div class="max-w-7xl mx-auto bg-white shadow-lg rounded-lg p-6">
        <h1 class="text-4xl font-bold text-gray-900 mb-6">My Profile</h1>

        <!-- Session Alerts -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="mb-4 p-4 bg-green-50 border border-green-400 text-green-800 rounded shadow">
                <?= $_SESSION['success'];
                unset($_SESSION['success']); ?>
            </div>
        <?php endif; ?>
        <?php if (isset($_SESSION['error'])): ?>
            <div class="mb-4 p-4 bg-red-50 border border-red-400 text-red-800 rounded shadow">
                <?= $_SESSION['error'];
                unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <!-- Profile Information -->
        <div class="mb-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Account Details</h2>
            <div class="text-gray-700">
                <p><strong>Name:</strong> <?= htmlspecialchars($user->getName()) ?></p>
                <p><strong>Email:</strong> <?= htmlspecialchars($user->getEmail()) ?></p>
                <p><strong>Phone:</strong> <?= htmlspecialchars($user->phone ?? 'N/A') ?></p>
                <?php if ($_SESSION['user_type'] === 'trainee'): ?>
                    <p><strong>Major:</strong> <?= htmlspecialchars($user->major ?? 'N/A') ?></p>
                <?php else: ?>
                    <p><strong>Department:</strong> <?= htmlspecialchars($user->department ?? 'N/A') ?></p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Edit Profile Form -->
        <div class="mb-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Edit Profile</h2>
            <form action="<?= route('account.update') ?>" method="POST" class="bg-gray-50 p-6 rounded-lg shadow">
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium">Name</label>
                    <input type="text" name="name" value="<?= htmlspecialchars($user->getName()) ?>" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium">Email</label>
                    <input type="email" name="email" value="<?= htmlspecialchars($user->getEmail()) ?>" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium">Phone</label>
                    <input type="text" name="phone" value="<?= htmlspecialchars($user->phone ?? '') ?>" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>

                <?php if ($_SESSION['user_type'] === 'trainee'): ?>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium">Major</label>
                        <input type="text" name="major" value="<?= htmlspecialchars($user->major ?? '') ?>" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                    </div>
                <?php else: ?>
                    <div class="mb-4">
                        <label class="block text-gray-700 font-medium">Department</label>
                        <input type="text" name="department" value="<?= htmlspecialchars($user->department ?? '') ?>" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                    </div>
                <?php endif; ?>

                <div class="text-right">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-md shadow-md hover:bg-blue-700 transition">
                        <i class="fas fa-save mr-2"></i> Update Profile
                    </button>
                </div>
            </form>
        </div>

        <!-- Password Reset -->
        <div class="mb-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Change Password</h2>
            <form action="<?= route('account.password.update') ?>" method="POST" class="bg-gray-50 p-6 rounded-lg shadow">
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium">Current Password</label>
                    <div class="relative">
                        <input type="password" name="current_password" id="current_password" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <i class="fas fa-eye absolute top-3 right-4 text-gray-500 cursor-pointer toggle-password" data-target="current_password"></i>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium">New Password</label>
                    <div class="relative">
                        <input type="password" name="new_password" id="new_password" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <i class="fas fa-eye absolute top-3 right-4 text-gray-500 cursor-pointer toggle-password" data-target="new_password"></i>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium">Confirm Password</label>
                    <div class="relative">
                        <input type="password" name="confirm_password" id="confirm_password" class="w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
                        <i class="fas fa-eye absolute top-3 right-4 text-gray-500 cursor-pointer toggle-password" data-target="confirm_password"></i>
                    </div>
                </div>

                <div class="text-right">
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white font-semibold rounded-md shadow-md hover:bg-green-700 transition">
                        <i class="fas fa-lock mr-2"></i> Change Password
                    </button>
                </div>
            </form>
        </div>

        <!-- Logout and Delete Account -->
        <div class="flex justify-between mt-6">
            <a href="<?= route('logout') ?>" class="px-4 py-2 bg-gray-600 text-white rounded-md shadow-md font-medium hover:bg-gray-700">
                <i class="fas fa-sign-out-alt mr-2"></i> Logout
            </a>
            <a href="<?= route('account.delete') ?>" class="px-4 py-2 bg-red-600 text-white rounded-md shadow-md font-medium hover:bg-red-700" onclick="return confirm('Are you sure you want to delete your account? This action cannot be undone.')">
                <i class="fas fa-trash-alt mr-2"></i> Delete Account
            </a>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll(".toggle-password").forEach((icon) => {
        icon.addEventListener("click", function() {
            const target = document.getElementById(this.dataset.target);
            if (target.type === "password") {
                target.type = "text";
                this.classList.replace("fa-eye", "fa-eye-slash");
            } else {
                target.type = "password";
                this.classList.replace("fa-eye-slash", "fa-eye");
            }
        });
    });
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/auth.php';
?>