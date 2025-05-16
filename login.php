<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - FitLife</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
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
    
    <!-- Login Form -->
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-8 relative z-10">
        <h2 class="text-3xl font-bold mb-6 text-darkest text-center">Login to <span class="text-light">FitLife</span></h2>

        <form action="process_login.php" method="POST">
            <div class="mb-4">
                <label class="block text-darkest mb-2" for="l_username_or_l_email">Email/Username</label>
                <input name="l_username_or_l_email" id="l_username_or_l_email" type="text"
                    class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-light"
                    required>
                <p class="text-sm text-gray-500 mt-1">Enter your email address or username</p>
            </div>
            <div class="mb-6">
                <label class="block text-darkest mb-2" for="l_password">Password</label>
                <input name="l_password" id="l_password" type="password"
                    class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-light"
                    required>
            </div>
            <button type="submit"
                    class="w-full bg-light hover:bg-medium text-white font-semibold py-2 rounded transition mb-4">
                Login
            </button>
        </form>

        <p class="text-center text-gray-600">Don't have an account? <a href="signup.php" class="text-light hover:underline">
            Register</a>
        </p>
    </div>
</body>
</html> 
