<?php
// Start session safely
include_once './inc/session.php';



// Retrieve and clear login errors
$loginError = $_SESSION['login_error'] ?? '';
unset($_SESSION['login_error']);
?>



<!-- Login and Sign Up Modal Dialog -->
<div
  id="authentication-modal"
  tabindex="-1"
  aria-hidden="true"
  class="hidden fixed inset-0 z-[100] justify-center items-center bg-black bg-opacity-40 overflow-auto w-full h-full">
  <div class="relative  w-full max-w-screen-md">
    <div class="bg-white rounded-lg shadow-sm">
      <!-- Modal Header -->
      <div class="flex items-center justify-between p-4 border-b">
        <h3 id="login-title" class="text-xl font-bold text-gray-900">
          Sign in to our platform
        </h3>
        <button type="button" onclick="resetForm();"
          class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
          data-modal-hide="authentication-modal">
          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
            viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
          </svg>
          <span class="sr-only">Close modal</span>
        </button>
      </div>
      <!-- Modal Body -->
      <div class="p-4 flex flex-col md:flex-row justify-center items-center">
        <!-- Sign-In Form -->
        <div id="sign-in-form" class="w-full md:w-1/2 my-4">
          <form id="signin-form-element" class="space-y-4" autocomplete="off">
            <div>
              <label for="login_email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
              <input
                type="email"
                name="login_email"
                id="login_email"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="Enter your email"
                required />
            </div>
            <div>
              <label for="login_password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
              <input
                type="password"
                name="login_password"
                id="login_password"
                placeholder="••••••••"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                required />
            </div>
            <div id="success-div-login" class="text-green-500 hidden"></div>
            <div id="error-div-login" class="text-red-500 hidden"></div>
            <div id="info-div-login" class="text-blue-500 hidden"></div>
            <button
              type="button"
              onclick="check_login()"
              class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
              Login to your account
            </button>
            <div class="text-sm font-medium text-gray-500">
              Not registered?
              <a href="#" id="go-to-emailVerify" class="text-blue-700 hover:underline">Create account</a>
            </div>
          </form>
        </div>
        <!-- Sign-Up Form -->
        <div id="sign-up-form" class="hidden w-full md:w-1/2 my-4">
          <form id="signup-form-element" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label for="name-signUp" class="block mb-2 text-sm font-medium text-gray-900">First Name</label>
                <input
                  type="text"
                  name="name-signUp"
                  id="name-signUp"
                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                  placeholder="Enter your name"
                  required />
              </div>
              <div>
                <label for="mobile-signUp" class="block mb-2 text-sm font-medium text-gray-900">Contact Number</label>
                <input
                  type="text"
                  name="mobile-signUp"
                  id="mobile-signUp"
                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                  placeholder="Enter your contact number"
                  required />
              </div>
            </div>
            <div>
              <label for="email-signUp" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
              <input
                type="email"
                name="email-signUp"
                id="email-signUp"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="Enter your email"
                disabled />
            </div>
            <div>
              <label for="password-signUp" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
              <input
                type="password"
                name="password-signUp"
                id="password-signUp"
                placeholder="••••••••"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                required />
            </div>
            <div>
              <label for="confirmPassword-signUp" class="block mb-2 text-sm font-medium text-gray-900">Confirm Password</label>
              <input
                type="password"
                name="confirmPassword-signUp"
                id="confirmPassword-signUp"
                placeholder="••••••••"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                required />
            </div>
            <div id="error-div-reg" class="text-red-500 hidden"></div>
            <div id="success-div-reg" class="text-green-500 hidden"></div>
            <div id="info-div-reg" class="text-blue-500 hidden"></div>
            <button
              type="button"
              onclick="submitRegistrationForm()"
              class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
              Create your account
            </button>
            <div class="text-sm font-medium text-gray-500">
              Already registered?
              <a href="#" id="go-to-sign-in" class="text-blue-700 hover:underline">Sign in</a>
            </div>
          </form>
        </div>
        <!-- Email Verification Form -->
        <div id="email-form" class="hidden w-full md:w-1/2 my-4">
          <form id="email-form-element" class="space-y-4">
            <div>
              <label for="registerEmail" class="block mb-2 text-sm font-medium text-gray-900">Enter Email</label>
              <input
                type="email"
                name="registerEmail"
                id="registerEmail"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="Enter email"
                required />
            </div>
            <div id="success-div-otp" class="text-green-500 hidden"></div>
            <div id="error-div-otp" class="text-red-500 hidden"></div>
            <div id="info-div-otp" class="text-blue-500 hidden"></div>
            <button
              type="button"
              onclick="getOtp()"
              class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
              Get OTP
            </button>
          </form>
        </div>
        <!-- OTP Form -->
        <div id="otp-form" class="hidden w-full md:w-1/2 my-4">
          <form id="otp-form-element" class="space-y-4">
            <div>
              <label for="otp" class="block mb-2 text-sm font-medium text-gray-900">Enter OTP</label>
              <input
                type="text"
                name="otp"
                id="otp"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                placeholder="123456"
                required />
            </div>
            <button
              type="button"
              onclick="verifyOtp()"
              class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
              Verify OTP
            </button>
            <div class="text-sm font-medium text-gray-500">
              Didn't receive OTP?
              <a href="#" id="resend-otp" onclick="getOtp()" class="text-blue-700 hover:underline">Resend</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


<script>
  // Login Function
  function check_login() {
    const login_email = $('#login_email').val().trim();
    const login_password = $('#login_password').val().trim();

    if (!login_email || !login_password) {
      showLoginFeedback('error', 'Please enter both email and password.');
      return;
    }
    if (!validateEmail(login_email)) {
      showLoginFeedback('error', 'Please enter a valid email address.');
      return;
    }

    showLoginFeedback('info', 'Please wait...');

    $.ajax({
      url: 'data/data_login.php',
      type: 'POST',
      data: {
        email: login_email,
        password: login_password
      },
      success(response) {
        try {
          const res = JSON.parse(response);
          if (res.success === 1) {
            showLoginFeedback('success', res.message);
            setTimeout(() => {
              window.location.href = 'profile';
            }, 1500);
          } else {
            showLoginFeedback('error', res.message);
          }
        } catch (error) {
          console.error('Error parsing response:', error, response);
          showLoginFeedback('error', 'Invalid server response. Please try again.');
        }
      },
      error() {
        showLoginFeedback('error', 'Failed to contact the server. Please try again later.');
      },
    });
  }

  // Get OTP Function
  function getOtp() {
    const email = $('#registerEmail').val().trim();
    if (!validateEmail(email)) {
      showOtpFeedback('error', 'Please enter a valid email address.');
      return;
    }
    showOtpFeedback('info', 'Please wait...');
    $.ajax({
      url: 'data/data_get_otp.php',
      type: 'POST',
      data: {
        email
      },
      success(response) {
        try {
          const res = typeof response === 'string' ? JSON.parse(response) : response;
          if (res.success) {
            showOtpFeedback('success', res.message);
            // Hide email form and show OTP form
            $('#email-form').addClass('hidden');
            $('#otp-form').removeClass('hidden');
          } else {
            showOtpFeedback('error', res.message);
          }
        } catch (e) {
          console.error('Error parsing JSON:', e);
          showOtpFeedback('error', 'Unexpected server response. Please try again.');
        }
      },
      error(jqXHR, textStatus, errorThrown) {
        console.error('AJAX error:', textStatus, errorThrown);
        showOtpFeedback('error', 'Error connecting to the server. Please try again.');
      },
    });
  }

  // Verify OTP Function
  function verifyOtp() {
    const otp = $('#otp').val().trim();
    const email = $('#registerEmail').val().trim();
    $('#email-signUp').val(email);
    if (!otp) {
      showOtpFeedback('error', 'Please enter the OTP.');
      return;
    }
    showOtpFeedback('info', 'Please wait...');
    $.ajax({
      url: 'data/data_verify_otp.php', // Adjust endpoint as needed
      type: 'POST',
      data: {
        otp
      },
      success(response) {
        try {
          const res = JSON.parse(response);
          if (res.success) {
            showOtpFeedback('success', 'OTP verified successfully!');
            // Hide OTP form and show Sign-Up form
            $('#otp-form').addClass('hidden');
            $('#sign-up-form').removeClass('hidden');
          } else {
            showOtpFeedback('error', res.message);
          }
        } catch (e) {
          console.error(e);
          showOtpFeedback('error', 'Unexpected server response. Please try again.');
        }
      },
      error() {
        showOtpFeedback('error', 'Error verifying OTP. Please try again.');
      },
    });
  }

  // Registration Submission Function
  function submitRegistrationForm() {
    const email =  $('#registerEmail').val().trim();
    const password = $('#password-signUp').val().trim();
    const confirmPassword = $('#confirmPassword-signUp').val().trim();
    const name = $('#name-signUp').val().trim();
    const phone = $('#mobile-signUp').val().trim();

    if (password !== confirmPassword) {
      showFeedback('error', 'Passwords do not match.');
      return;
    }
    if (!validateEmail(email)) {
      showFeedback('error', 'Please enter a valid email address.');
      return;
    }
    if (!validateContactNumber(phone)) {
      showFeedback('error', 'Please enter a valid contact number.');
      return;
    }

    showFeedback('info', 'Please wait...');
    const formData = {
      f1: email,
      f2: password,
      f3: phone,
      f6: name
    };

    $.ajax({
      url: 'data/data_register_user.php',
      type: 'POST',
      data: formData,
      success(response) {
        try {
          const res = JSON.parse(response);
          if (res.success) {
            showFeedback('success', 'Registration successful! Redirecting...');
            setTimeout(() => {
              window.location.href = 'profile';
            }, 1500);
          } else {
            showFeedback('error', res.message);
          }
        } catch (e) {
          console.error(e);
          showFeedback('error', 'Unexpected server response.');
        }
      },
      error() {
        showFeedback('error', 'Error submitting the registration form.');
      },
    });
  }

  // Common Helper Functions
  function validateEmail(email) {
    return /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(email);
  }

  function validateContactNumber(contactNumber) {
    return /^\+?[0-9]{7,15}$/.test(contactNumber);
  }

  function showFeedback(type, message) {
    // For the registration (sign-up) feedback
    $(`#${type}-div-reg`).text(message).removeClass('hidden');
    $('#success-div-reg, #error-div-reg, #info-div-reg')
      .not(`#${type}-div-reg`)
      .addClass('hidden');
  }

  function showOtpFeedback(type, message) {
    $(`#${type}-div-otp`).text(message).removeClass('hidden');
    $('#success-div-otp, #error-div-otp, #info-div-otp')
      .not(`#${type}-div-otp`)
      .addClass('hidden');
  }

  function showLoginFeedback(type, message) {
    $(`#${type}-div-login`).text(message).removeClass('hidden');
    $('#success-div-login, #error-div-login, #info-div-login')
      .not(`#${type}-div-login`)
      .addClass('hidden');
  }
</script>