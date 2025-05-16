<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitLife - Transform Your Life</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
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
<body class="font-sans">
    <!-- Nav Bar Start -->
    <div class="bg-darkest">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <a href="index.html" class="text-4xl font-bold text-white">FIT<span class="text-pale">life</span></a>
                <div class="hidden md:flex space-x-6">
                    <a href="index.html" class="text-white hover:text-light transition duration-300">Home</a>
                    <a href="about.html" class="text-white hover:text-light transition duration-300">About</a>
                    <a href="service.html" class="text-white hover:text-light transition duration-300">Facilities</a>
                    <a href="price.html" class="text-white hover:text-light transition duration-300">Memberships</a>
                    <a href="class.html" class="text-white hover:text-light transition duration-300">Classes</a>
                    <a href="team.html" class="text-white hover:text-light transition duration-300">Trainers</a>
                    <a href="portfolio.html" class="text-white hover:text-light transition duration-300">Gallery</a>
                    <a href="contact.html" class="text-white hover:text-light transition duration-300">Contact</a>
                    <div class="relative group">
                        <button class="text-white hover:text-light transition duration-300 focus:outline-none">Account <i class="fas fa-caret-down ml-1"></i></button>
                        <div class="absolute left-0 mt-2 w-40 bg-white rounded-md shadow-lg opacity-0 group-hover:opacity-100 group-focus:opacity-100 transition-opacity duration-200 z-10">
                            <a href="login.html" class="block px-4 py-2 text-darkest hover:bg-light hover:text-white transition">Login</a>
                            <a href="register.html" class="block px-4 py-2 text-darkest hover:bg-light hover:text-white transition">Register</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Nav Bar End -->

    <!-- Hero Section -->
    <section class="relative h-screen text-white" style="background-image: url('img/gym-bg.jpg'); background-size: cover; background-position: center;">
        <div class="absolute inset-0" style="background: linear-gradient(rgba(232,123,170,0.7), rgba(58,5,25,0.7));"></div>
        <div class="relative container mx-auto px-4 h-full flex items-center">
            <div class="max-w-2xl">
                <h1 class="text-5xl md:text-6xl font-bold mb-6">Transform Your Life with FitLife</h1>
                <p class="text-xl md:text-2xl mb-8">Join the ultimate fitness experience with state-of-the-art equipment and expert trainers.</p>
                <div class="space-x-4">
                    <a href="index.html" class="bg-light hover:bg-medium text-white px-8 py-3 rounded-lg font-semibold transition duration-300">Become a member</a>
                    <a href="#" class="border-2 border-white hover:bg-white hover:text-darkest px-8 py-3 rounded-lg font-semibold transition duration-300">Sign in</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-16 text-darkest">Premium Facilities</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition duration-300">
                    <div class="text-light text-4xl mb-4">
                        <i class="fas fa-dumbbell"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-4 text-darkest">Modern Equipment</h3>
                    <p class="text-gray-600">Access to the latest fitness technology and equipment for an optimal workout experience.</p>
                </div>
                <!-- Feature 2 -->
                <div class="bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition duration-300">
                    <div class="text-light text-4xl mb-4">
                        <i class="fas fa-user-friends"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-4 text-darkest">Personal Training</h3>
                    <p class="text-gray-600">One-on-one sessions with certified trainers to help you reach your fitness goals.</p>
                </div>
                <!-- Feature 3 -->
                <div class="bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition duration-300">
                    <div class="text-light text-4xl mb-4">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-4 text-darkest">24/7 Access</h3>
                    <p class="text-gray-600">Work out on your schedule with round-the-clock access to our premium facilities.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-20 bg-white">
        <div class="container mx-auto px-4">
            <h2 class="text-4xl font-bold text-center mb-16 text-darkest">Success Stories</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Testimonial 1 -->
                <div class="bg-gray-50 p-8 rounded-lg">
                    <div class="flex items-center mb-6">
                        <img src="img/testimonial-1.jpg" alt="Client" class="w-16 h-16 rounded-full object-cover">
                        <div class="ml-4">
                            <h4 class="font-bold text-darkest">Sarah Johnson</h4>
                            <p class="text-gray-600">Member since 2023</p>
                        </div>
                    </div>
                    <p class="text-gray-700">"FitLife has transformed my fitness journey. The trainers are amazing and the facilities are top-notch!"</p>
                </div>
                <!-- Testimonial 2 -->
                <div class="bg-gray-50 p-8 rounded-lg">
                    <div class="flex items-center mb-6">
                        <img src="img/testimonial-2.jpg" alt="Client" class="w-16 h-16 rounded-full object-cover">
                        <div class="ml-4">
                            <h4 class="font-bold text-darkest">Mike Thompson</h4>
                            <p class="text-gray-600">Member since 2022</p>
                        </div>
                    </div>
                    <p class="text-gray-700">"The personal training program helped me achieve my fitness goals faster than I ever thought possible."</p>
                </div>
                <!-- Testimonial 3 -->
                <div class="bg-gray-50 p-8 rounded-lg">
                    <div class="flex items-center mb-6">
                        <img src="img/testimonial-3.jpg" alt="Client" class="w-16 h-16 rounded-full object-cover">
                        <div class="ml-4">
                            <h4 class="font-bold text-darkest">Emily Davis</h4>
                            <p class="text-gray-600">Member since 2024</p>
                        </div>
                    </div>
                    <p class="text-gray-700">"The group classes are incredible! I've never been more motivated to work out."</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-darkest text-white py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Contact Info -->
                <div>
                    <h3 class="text-2xl font-bold mb-4">Fit<span class="text-pale">Life</span></h3>
                    <p class="mb-2">123 Street, New York, USA</p>
                    <p class="mb-2">+012 345 67890</p>
                    <p>info@example.com</p>
                </div>
                <!-- Quick Links -->
                <div>
                    <h4 class="text-xl font-bold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="about.html" class="hover:text-light transition duration-300">About Us</a></li>
                        <li><a href="class.html" class="hover:text-light transition duration-300">Classes</a></li>
                        <li><a href="team.html" class="hover:text-light transition duration-300">Trainers</a></li>
                        <li><a href="contact.html" class="hover:text-light transition duration-300">Contact</a></li>
                    </ul>
                </div>
                <!-- Social Media -->
                <div>
                    <h4 class="text-xl font-bold mb-4">Follow Us</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="hover:text-light transition duration-300"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="hover:text-light transition duration-300"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="hover:text-light transition duration-300"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="hover:text-light transition duration-300"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center">
                <p>&copy; 2024 FitLife. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html> 