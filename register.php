<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Register - FitLife</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet" />
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            darkest: "#3B0016",
            dark: "#6B0837",
            medium: "#A53A6B",
            light: "#E573A2",
            pale: "#F7A1C4",
          },
          fontFamily: {
            sans: ["Open Sans", "sans-serif"],
          },
        },
      },
    };
  </script>
  <style>
    .step {
      display: none;
    }
    .step.active {
      display: block;
    }
  </style>
</head>
<body class="min-h-screen flex items-center justify-center font-sans bg-pale p-4">

  <form id="fitlifeForm" class="bg-white p-6 rounded shadow-md w-full max-w-md" method="POST" action="process_register.php" novalidate>

    <h2 class="text-darkest text-xl font-semibold mb-6" style="text-align:center">Register to FitLife</h2>

    <!-- Step 1: Basic user info -->
    <div class="step active mb-4">
        <label class="block text-darkest mb-2">Full Name</label>
        <input name="s_fullname" type="text" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-light" required />

        <label class="block text-darkest mb-2 mt-4">Username</label>
        <input name="s_username" type="text" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-light" required />

        <div class="mb-4">
            <label class="block text-darkest mb-2">Password</label>
            <input id="s_password" name="s_password" type="password" minlength="6" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-light" required>
        </div>

        <div class="mb-4">
            <label class="block text-darkest mb-2">Confirm Password</label>
            <input id="s_conf_password" name="s_conf_password" type="password" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-light" required>
            <p id="passwordMsg" class="text-sm text-red-500 mt-1"></p>
        </div>
    </div>

    <!-- Step 2: Contact info -->
        <div class="step mb-4">
        <label class="block text-darkest mb-2">Contact Number</label>
        <input name="s_contact_number" type="tel" pattern="[0-9]{11}" maxlength="11" placeholder="e.g., 09xxxxxxxxx"
                class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-light" required>

        <label class="block text-darkest mb-2 mt-4">Address</label>
        <textarea name="s_address" rows="3" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-light" required></textarea>

        <label class="block text-darkest mb-2 mt-4">Gender</label>
        <select name="s_gender" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-light" required>
            <option value="" disabled selected>Select Gender</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
        </select>

        <label class="block text-darkest mb-2 mt-4">Email</label>
        <input name="s_email" type="email" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-light" required />
        </div>

    <!-- Step 3: Fitness Profile Questions -->
    <div class="step mb-4">
      <label class="block text-darkest mb-2">Age</label>
      <input name="s_age" type="number" min="12" max="80" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-light" required />

      <label class="block text-darkest mb-2 mt-4">Height (in cm)</label>
        <input name="s_height" type="number" step="0.1" min="100" max="250"
             class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-light" required>

      <label class="block text-darkest mb-2 mt-4">Weight (in kg)</label>
        <input name="s_weight" type="number" step="0.1" min="30" max="300"
            class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-light" required>
    </div>

    <div class="step mb-4">
      <label class="block text-darkest mb-2">What’s your current fitness level?</label>
      <select name="s_fitness_level" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-light" required>
        <option value="" disabled selected>Select your fitness level</option>
        <option value="beginner">Beginner</option>
        <option value="intermediate">Intermediate</option>
        <option value="advanced">Advanced</option>
      </select>
    </div>

    <div class="step mb-4">
      <label class="block text-darkest mb-2">What’s your primary goal?</label>
      <select name="s_goal" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-light" required>
        <option value="" disabled selected>Select your goal</option>
        <option value="lose_weight">Lose Weight</option>
        <option value="build_muscle">Build Muscle</option>
        <option value="muscle_toning">Muscle Toning</option>
        <option value="improve_endurance">Improve Endurance</option>
        <option value="general_fitness">General Fitness</option>
      </select>
    </div>

    <div class="step mb-4">
      <label class="block text-darkest mb-2">Do you have any medical conditions we should consider?</label>
      <textarea name="s_conditions" rows="3" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-light"></textarea>
    </div>

    <div class="step mb-4">
      <label class="block text-darkest mb-2">When do you prefer to work out?</label>
      <select name="s_time_pref" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-light" required>
        <option value="" disabled selected>Select your preferred time</option>
        <option value="morning">Morning</option>
        <option value="afternoon">Afternoon</option>
        <option value="evening">Evening</option>
        <option value="no_preference">No Preference</option>
      </select>
    </div>

    <div class="step mb-6">
      <label class="block text-darkest mb-2">How active are you currently?</label>
      <select name="s_activity_level" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-light" required>
        <option value="" disabled selected>Select your activity level</option>
        <option value="sedentary">Sedentary</option>
        <option value="lightly_active">Lightly Active</option>
        <option value="active">Active</option>
        <option value="very_active">Very Active</option>
      </select>
    </div>

    <div class="flex justify-between items-center">
      <button type="button" id="prevBtn" class="bg-medium text-white px-4 py-2 rounded hover:bg-dark transition-opacity opacity-50 cursor-not-allowed" disabled>Previous</button>
      <button type="button" id="nextBtn" class="bg-dark text-white px-4 py-2 rounded hover:bg-medium transition">Next</button>
    </div>

    
    <!-- Progress bar -->
    <div class="flex items-center justify-center gap-2" style="padding-top: 40px">
        <div class="progress-step w-4 h-4 rounded-full bg-light"></div>
        <div class="progress-step w-4 h-4 rounded-full bg-gray-300"></div>
        <div class="progress-step w-4 h-4 rounded-full bg-gray-300"></div>
        <div class="progress-step w-4 h-4 rounded-full bg-light"></div>
        <div class="progress-step w-4 h-4 rounded-full bg-gray-300"></div>
        <div class="progress-step w-4 h-4 rounded-full bg-gray-300"></div>
        <div class="progress-step w-4 h-4 rounded-full bg-light"></div>
        <div class="progress-step w-4 h-4 rounded-full bg-gray-300"></div>
    </div>


    <div style="margin-top:20px; text-align:end"> 
        <p>Already have an account?<a href="login.php" class="text-light hover:underline"> Log In</a> </p>    
    </div>
            

  </form>

  <script src="js/register_script.js"></script>
</body>
</html>