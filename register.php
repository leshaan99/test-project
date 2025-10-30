<?php
include 'header.php';

if (isset($_SESSION['u_id'])) {

    header("Location: /"); // redirect to homepage or dashboard
    exit();
}

$form_config = [
    'heading' => 'Student Registration',
    'form_action' => 'data/data_register_user.php',
    'inputs' => [
        'f1' => ['label' => 'Email Address', 'type' => 'email', 'required' => true, 'placeholder' => 'Email Address', 'disabled' => false, 'validation' => ['pattern' => '[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$', 'message' => 'Invalid email']],
        'f6' => ['label' => 'First Name', 'type' => 'text', 'required' => true, 'placeholder' => 'First Name', 'validation' => ['pattern' => '[A-Za-z]{2,25}', 'minlength' => 2, 'maxlength' => 25, 'message' => 'Must be 2-15 chars']],
        'f3' => ['label' => 'Phone Number', 'type' => 'tel', 'placeholder' => 'Phone Number', 'validation' => ['pattern' => '[0-9]{10,15}', 'message' => 'Phone number must be 10-15 digits', 'minlength' => 10, 'maxlength' => 15]],
        'f2' => ['label' => 'Password', 'type' => 'password', 'required' => true, 'placeholder' => 'Password', 'validation' => ['minlength' => 8, 'message' => 'Must be at least 8 chars']],
        'password' => ['label' => 'Confirm Password', 'type' => 'password', 'required' => true, 'placeholder' => 'Confirm Password', 'validation' => ['minlength' => 8, 'message' => 'Must be at least 8 chars']]
    ],
    'submit_text' => 'Register',
    'footer_text' => 'Already have an account?',
    'footer_link_text' => 'Login here',
    'footer_link_href' => 'login'
];
?>
<div id="content" class="hidden">
    <?php include "nav.php" ?>
    <section class="relative">
        <div class="h-56 md:h-96 bg-cover bg-center" style="background-image:url('assets/img/carasol_image1.jpg')"></div>
        <div class="absolute inset-0 bg-blue-900 bg-opacity-50 flex flex-col items-center justify-center">
            <h2 class="text-3xl font-extrabold mb-2 text-white">Register</h2>
            <h4 class="text-white mb-8 text-lg">Join us and be part of our community.</h4>
        </div>
    </section>
    <div class="flex justify-center py-12">
        <div class="w-full max-w-2xl bg-white rounded-lg shadow-lg p-8">
            <h3 class="text-2xl font-bold text-gray-800 mb-6 text-center"><?= $form_config['heading'] ?></h3>
            <div id="message" class="mb-4 text-center hidden p-3 rounded-md"></div>
            <form id="registerForm" action="<?= $form_config['form_action'] ?>" method="POST" class="space-y-6">
                <?php foreach ($form_config['inputs'] as $name => $input):
                    $val = $input['validation'] ?? []; ?>
                    <div>
                        <label for="<?= $name ?>" class="block text-gray-700 font-semibold mb-2">
                            <?= $input['label'] ?><?= !empty($input['required']) ? '<span class="text-red-500">*</span>' : '' ?>
                        </label>
                        <input
                            type="<?= $input['type'] ?>"
                            id="<?= $name ?>"
                            name="<?= $name ?>"
                            placeholder="<?= $input['placeholder'] ?? '' ?>"
                            <?= !empty($input['required']) ? 'required' : '' ?>
                            <?= !empty($input['disabled']) ? 'disabled' : '' ?>
                            class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                            <?= isset($val['pattern']) ? 'pattern="' . $val['pattern'] . '"' : '' ?>
                            <?= isset($val['minlength']) ? 'minlength="' . $val['minlength'] . '"' : '' ?>
                            <?= isset($val['maxlength']) ? 'maxlength="' . $val['maxlength'] . '"' : '' ?>>
                    </div>
                <?php endforeach; ?>
                <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-md shadow hover:bg-blue-700 transition"><?= $form_config['submit_text'] ?></button>
            </form>
            <p class="text-center text-gray-600 mt-6">
                <?= $form_config['footer_text'] ?>
                <a href="<?= $form_config['footer_link_href'] ?>" class="text-blue-600 hover:underline"><?= $form_config['footer_link_text'] ?></a>
            </p>
        </div>
    </div>
    <section class="bg-gray-100 py-12 mt-12 text-center">
        <h2 class="text-2xl font-bold text-gray-800">Need Help?</h2>
        <p class="text-gray-600 mt-2">Contact us for assistance with your registration.</p>
        <a href="contactus" class="mt-6 inline-block px-6 py-2 bg-blue-600 text-white rounded-md shadow hover:bg-blue-700 transition">Contact Us</a>
    </section>


    <?php include "footer.php" ?>
</div>

</body>

<script>
    const msg = document.getElementById('message');
    const showMsg = (txt, success = false) => {
        msg.textContent = txt;
        msg.className = `mb-4 text-center p-3 rounded-md ${success ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'}`;
    };
    document.getElementById('registerForm').addEventListener('submit', async e => {
        e.preventDefault();
        const f = e.target,
            fd = new FormData(f);
        if (f.f2.value !== f.password.value) return showMsg('Passwords do not match!');
        try {
            const r = await fetch(f.action, {
                method: 'POST',
                body: fd
            });
            const d = await r.json();
            showMsg(d.message || (d.success ? 'Registration successful! Redirecting...' : 'Registration failed.'), d.success);
            if (d.success) setTimeout(() => location.href = 'login', 1500);
        } catch {
            showMsg('Network error. Please try again.');
        }
    });
    document.querySelectorAll('input, select, textarea').forEach(el => el.addEventListener('input', () => {
        const vMsg = document.querySelector(`.validation-message[data-for="${el.id}"]`);
        if (vMsg) vMsg.classList.toggle('hidden', !el.validity.patternMismatch);
    }));
    document.getElementById('f3').addEventListener('input', function() {
        this.value = this.value.replace(/\D/g, ''); // remove non-digits
    });
    document.getElementById('f6').addEventListener('input', function() {
        this.value = this.value.replace(/[^A-Za-z]/g, ''); // remove non-letter characters
    });
</script>

</html>