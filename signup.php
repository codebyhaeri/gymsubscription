<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - FitLife</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        darkest: '#3B0016',
                        dark: '#6B0837',
                        medium: '#A53A6B',
                        light: '#E573A2',
                        pale: '#F7A1C4',
                    },
                    fontFamily: {
                        sans: ['Open Sans', 'sans-serif'],
                    },
                }
            }
        }
    </script>
</head>
<body class="min-h-screen flex items-center justify-center font-sans relative">
    <!-- Background Image with Overlay -->
    <div class="absolute inset-0 z-0">
        <img src="img/gym-bg.jpg" alt="Gym Background" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-darkest bg-opacity-70"></div>
    </div>
    
    <!-- Register Form -->
        <form action="process_signup.php" method="post" class="bg-white rounded-lg shadow-lg w-full max-w-md p-8 relative z-10 mx-auto">
            <h2 class="text-3xl font-bold mb-6 text-darkest text-center">Register for <span class="text-light">FitLife</span></h2>
            
            <div class="mb-4">
                <label class="block text-darkest mb-2">Full Name</label>
                <input name="s_fullname" type="text" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-light" required>
            </div>

            <div class="mb-4">
                <label class="block text-darkest mb-2">Username</label>
                <input name="s_username" type="text" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-light" required>
            </div>

            <div class="mb-4">
                <label class="block text-darkest mb-2">Password</label>
                <input name="s_password" type="password" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-light" required>
            </div>

            <div class="mb-4">
                <label class="block text-darkest mb-2">Confirm Password</label>
                <input name="s_conf_password" type="password" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-light" required>
            </div>

            <div class="mb-4">
                <label class="block text-darkest mb-2">Email</label>
                <input name="s_email" type="email" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-light" required>
            </div>

            <div class="mb-4">
                <label class="block text-darkest mb-2">Contact Number</label>
                <input name="s_contact_number" type="text" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-light" required>
            </div>

            <div class="mb-4">
                <label class="block text-darkest mb-2">Address</label>
                <input name="s_address" type="text" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-light" required>
            </div>

            <div class="mb-6">
                <label class="block text-darkest mb-2">Gender</label>
                <select name="s_gender" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-light" required>
                    <option value="M">Male</option>
                    <option value="F">Female</option>
                    <option value="X">Rather Not Say</option>
                </select>
            </div>

            <button type="submit" class="w-full bg-light hover:bg-medium text-white font-semibold py-2 rounded transition mb-4">Register</button>

            <p class="text-center text-gray-600">Already a member? <a href="login.php" class="text-light hover:underline">Log In</a></p>
        </form>

</body>
</html> 