<?php 
include 'header.php'; 

$form_config = [
    'page_title'       => 'Login',
    'page_subtitle'    => 'Access your account securely.',
    'form_title'       => 'Sign In to Your Account',
    'form_action'      => 'data/data_login.php',
    'submit_text'      => 'Login',
    'fields'           => [
        [
            'label' => 'Email Address',
            'name'  => 'email',
            'type'  => 'email',
            'required' => true
        ],
        [
            'label' => 'Password',
            'name'  => 'password',
            'type'  => 'password',
            'required' => true
        ]
    ],
    'footer_text'      => 'Don\'t have an account?',
    'footer_link_text' => 'Register here',
    'footer_link_href' => 'register'
];
?>

<div id="content" class="hidden">
    <?php include "nav.php" ?>

    <!-- Hero Section -->
    <section class="relative">
        <div class="h-56 md:h-96 bg-cover bg-center" style="background-image: url('assets/img/carasol_image1.jpg')"></div>
        <div class="absolute inset-0 bg-blue-900 bg-opacity-50 flex flex-col items-center justify-center">
            <h2 class="text-3xl font-extrabold mb-2 text-white"><?= $form_config['page_title'] ?></h2>
            <h4 class="text-white mb-8 text-lg"><?= $form_config['page_subtitle'] ?></h4>
        </div>
    </section>

    <!-- Login Form -->
    <div class="flex justify-center py-12">
        <div class="w-full max-w-lg bg-white rounded-lg shadow-lg p-8">
            <h3 class="text-2xl font-bold text-gray-800 mb-6 text-center"><?= $form_config['form_title'] ?></h3>
            
            <!-- Message Container -->
            <div id="message" class="mb-4 text-center hidden p-3 rounded-md"></div>
            
            <form id="loginForm" action="<?= $form_config['form_action'] ?>" method="POST" class="space-y-6">
                
                <?php foreach ($form_config['fields'] as $field): ?>
                    <div>
                        <label for="<?= $field['name'] ?>" class="block text-gray-700 font-semibold mb-2"><?= $field['label'] ?></label>
                        <input 
                            type="<?= $field['type'] ?>" 
                            name="<?= $field['name'] ?>" 
                            id="<?= $field['name'] ?>" 
                            <?= $field['required'] ? 'required' : '' ?>
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>
                <?php endforeach; ?>

                <div>
                    <button type="submit"
                            class="w-full bg-blue-600 text-white py-2 px-4 rounded-md shadow hover:bg-blue-700 transition">
                        <?= $form_config['submit_text'] ?>
                    </button>
                </div>
            </form>

            <p class="text-center text-gray-600 mt-6">
                <?= $form_config['footer_text'] ?> 
                <a href="<?= $form_config['footer_link_href'] ?>" class="text-blue-600 hover:underline"><?= $form_config['footer_link_text'] ?></a>
            </p>
        </div>
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            
            const form = e.target;
            const formData = new FormData(form);
            const message = document.getElementById('message');
            
            // Reset message state
            message.classList.add('hidden');
            message.classList.remove('bg-green-100', 'text-green-700', 'bg-red-100', 'text-red-700');
            
            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    body: formData
                });
                
                const data = await response.json();
                
                if (data.success) {
                    // Show success message
                    message.textContent = data.message || 'Login successful! Redirecting...';
                    message.classList.add('bg-green-100', 'text-green-700');
                    message.classList.remove('hidden');
                    
                    // Redirect after delay
                    setTimeout(() => {
                        window.location.href = 'profile'; // Change to your dashboard URL
                    }, 1500);
                } else {
                    // Show error message
                    message.textContent = data.message || 'Login failed. Please try again.';
                    message.classList.add('bg-red-100', 'text-red-700');
                    message.classList.remove('hidden');
                    
                    // Clear password field on failure
                    form.password.value = '';
                }
            } catch (error) {
                // Show network error
                message.textContent = 'Network error. Please try again.';
                message.classList.add('bg-red-100', 'text-red-700');
                message.classList.remove('hidden');
                console.error('Login error:', error);
            }
        });
    </script>

    <?php include "footer.php" ?>
</div>
</body>
</html>