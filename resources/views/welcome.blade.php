<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('storage/images/placeholder.png') }}" type="image/png">
    <title>PlaceIt - Monetize Your Empty Spaces</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-nmkRI2k3l2GKtWo8ZxLpW2VfZHRlXYWnPbm2LFl9hAL5ZtntF7D1h6jcNcdEHOo5AC5f5E3i6fq4+Qkv3DdOdw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @vite(['resources/css/app.css', 'resources/js/app.js']) <!-- Ensure Tailwind is loaded -->
    
</head>
<body class="bg-white font-sans antialiased">
    <!-- Navbar -->
    <nav class="p-6 bg-white shadow md:flex md:justify-between md:items-center">
        <!-- Logo Section -->
        <div class="flex justify-between items-center">
            <a href="{{ url('/') }}" class="text-orange-600 text-3xl font-bold">place.it</a>
            <!-- Hamburger Icon for Mobile -->
            <div class="md:hidden">
                <button class="text-gray-700 focus:outline-none" id="menu-btn">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Navigation Links -->
        <div class="hidden md:flex md:flex-grow justify-center space-y-4 md:space-y-0 md:space-x-8 mt-4 md:mt-0" id="menu">
            <a href="#top" class="text-red-600 hover:text-gray-800 uppercase block md:inline-block">HOME</a>
            <a href="#about-us" class="text-red-600 hover:text-gray-800 uppercase block md:inline-block">ABOUT US</a>
            <a href="#contacts" class="text-red-600 hover:text-gray-800 uppercase block md:inline-block">CONTACT US</a>

            <!-- Mobile Login and Get Started Buttons -->
            <div class="block md:hidden space-y-4">
                @if (Route::has('login') && Auth::check())
                    <a href="{{ url('/home') }}" class="text-red-600 hover:text-gray-800 block">Dashboard</a>
                @elseif (Route::has('login') && !Auth::check())
                    <a href="{{ url('/login') }}" class="text-red-600 text-center border-2 block rounded-lg py-2 px-4 hover:text-blue-800">Login</a>
                    <a href="{{ url('/register') }}" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-md block text-center">Get Started</a>
                @endif
            </div>
        </div>

        <!-- Desktop Login and Get Started Buttons -->
        <div class="hidden md:flex items-center space-x-4 mt-4 md:mt-0">
            @if (Route::has('login') && Auth::check())
                <a href="{{ url('/home') }}" class="text-red-600  hover:text-gray-800 ">Dashboard</a>
            @elseif (Route::has('login') && !Auth::check())
                <a href="{{ url('/login') }}" class="text-red-600 border-2 border-red-700 rounded-lg py-2 px-4 hover:text-blue-800">Login</a>
                <a href="{{ url('/register') }}" class="bg-red-500 hover:bg-red-600 text-white py-2 px-4 rounded-md">Get Started</a>
            @endif
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative bg-white py-16 px-6 lg:px-8">
        <div class="container mx-auto flex flex-col-reverse lg:flex-row items-center">
            <!-- Left Content -->
            <div class="lg:w-1/2 text-center lg:text-left mt-8 lg:mt-0">
                <h1 class="text-4xl md:text-6xl font-bold text-orange-600 leading-tight mb-4">PlaceIt</h1>
                <h2 class="text-3xl md:text-4xl font-bold text-red-600 mb-4">Monetize your empty spaces!</h2>
                <p class="text-gray-600 text-base md:text-lg mb-6">Transforming spaces, maximizing potential. PlaceIt — where opportunities meet visibility.</p>
                <a href="{{ url('/learn-more') }}" class="bg-red-500 hover:bg-red-600 text-white py-3 px-6 rounded-md text-lg">Learn More</a>
            </div>

            <!-- Right Image -->
            <div class="lg:w-1/2">
                <img src="https://freemockup.net/wp-content/uploads/2021/01/Free-Vertical-Building-Billboard-Mockup-PSD.jpg" alt="Building Image" class="w-full h-auto rounded-md shadow-lg">
            </div>
        </div>
    </section>

<!-- About Us Section -->
<section id="about-us" class="bg-gray-100 py-12">
    <div class="container mx-auto text-center">
        <h2 class="text-3xl font-bold text-red-600 mb-4">Our Team</h2>
        <p class="text-gray-600 text-lg mb-6">Meet the PlaceIt Team.</p>

        <!-- Team Members Grid with 3 on top and 2 on the bottom -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Top Row - 3 Team Members -->
            <div class="text-center">
                <img src="{{ asset('storage/images/eyac.jpg') }}" alt="Team Member 1" class="w-40 h-40 mx-auto rounded-full mb-4 border-2 border-orange-600">
                <h3 class="text-xl font-bold">LEMARC EYAC</h3>
                <p class="text-orange-600 mb-2">SOFTWARE ENGINEER</p>
                <div class="flex justify-center space-x-3 text-gray-500">
                    <a href="https://www.facebook.com/JahIsGood"><img src="{{ asset('storage/images/facebook-app-symbol.png') }}" alt="Description of icon" style="width: 18px; height: auto;" /></a>
                    <a href="#"><img src="{{ asset('storage/images/instagram.png') }}" alt="Description of icon" style="width: 18px; height: auto;" /></i></a>
                    <a href="#"><img src="{{ asset('storage/images/twitter.png') }}" alt="Description of icon" style="width: 18px; height: auto;" /></a>
                    <a href="#"><img src="{{ asset('storage/images/linkedin-logo.png') }}" alt="Description of icon" style="width: 18px; height: auto;" /></a>
                </div>
            </div>

            <div class="text-center">
                <img src="{{ asset('storage/images/eyac.jpg') }}" alt="Team Member 2" class="w-40 h-40 mx-auto rounded-full mb-4 border-2 border-orange-600">
                <h3 class="text-xl font-bold">LEMARC EYAC</h3>
                <p class="text-orange-600 mb-2">PROJECT MANAGER</p>
                <div class="flex justify-center space-x-3 text-gray-500">
                <a href="#"><img src="{{ asset('storage/images/facebook-app-symbol.png') }}" alt="Description of icon" style="width: 18px; height: auto;" /></a>
                    <a href="#"><img src="{{ asset('storage/images/instagram.png') }}" alt="Description of icon" style="width: 18px; height: auto;" /></i></a>
                    <a href="#"><img src="{{ asset('storage/images/twitter.png') }}" alt="Description of icon" style="width: 18px; height: auto;" /></a>
                    <a href="#"><img src="{{ asset('storage/images/linkedin-logo.png') }}" alt="Description of icon" style="width: 18px; height: auto;" /></a>
                </div>
            </div>

            <div class="text-center">
                <img src="{{ asset('storage/images/eyac.jpg') }}" alt="Team Member 3" class="w-40 h-40 mx-auto rounded-full mb-4 border-2 border-orange-600">
                <h3 class="text-xl font-bold">LEMARC EYAC</h3>
                <p class="text-orange-600 mb-2">QUALITY ASSURANCE</p>
                <div class="flex justify-center space-x-3 text-gray-500">
                <a href="#"><img src="{{ asset('storage/images/facebook-app-symbol.png') }}" alt="Description of icon" style="width: 18px; height: auto;" /></a>
                    <a href="#"><img src="{{ asset('storage/images/instagram.png') }}" alt="Description of icon" style="width: 18px; height: auto;" /></i></a>
                    <a href="#"><img src="{{ asset('storage/images/twitter.png') }}" alt="Description of icon" style="width: 18px; height: auto;" /></a>
                    <a href="#"><img src="{{ asset('storage/images/linkedin-logo.png') }}" alt="Description of icon" style="width: 18px; height: auto;" /></a>
                </div>
            </div>
        </div>

        <!-- Bottom Row - 2 Team Members -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mt-8">
            <div class="text-center">
                <img src="{{ asset('storage/images/eyac.jpg') }}" alt="Team Member 4" class="w-40 h-40 mx-auto rounded-full mb-4 border-2 border-orange-600">
                <h3 class="text-xl font-bold">LEMARC EYAC</h3>
                <p class="text-orange-600 mb-2">DATABASE MANAGER</p>
                <div class="flex justify-center space-x-3 text-gray-500">
                <a href="#"><img src="{{ asset('storage/images/facebook-app-symbol.png') }}" alt="Description of icon" style="width: 18px; height: auto;" /></a>
                    <a href="#"><img src="{{ asset('storage/images/instagram.png') }}" alt="Description of icon" style="width: 18px; height: auto;" /></i></a>
                    <a href="#"><img src="{{ asset('storage/images/twitter.png') }}" alt="Description of icon" style="width: 18px; height: auto;" /></a>
                    <a href="#"><img src="{{ asset('storage/images/linkedin-logo.png') }}" alt="Description of icon" style="width: 18px; height: auto;" /></a>
                </div>
            </div>

            <div class="text-center">
                <img src="{{ asset('storage/images/eyac.jpg') }}" alt="Team Member 5" class="w-40 h-40 mx-auto rounded-full mb-4 border-2 border-orange-600">
                <h3 class="text-xl font-bold">LEMARC EYAC</h3>
                <p class="text-orange-600 mb-2">UI/UX DESIGNER</p>
                <div class="flex justify-center space-x-3 text-gray-500">
                    <a href="#"><img src="{{ asset('storage/images/facebook-app-symbol.png') }}" alt="Description of icon" style="width: 18px; height: auto;" /></a>
                    <a href="#"><img src="{{ asset('storage/images/instagram.png') }}" alt="Description of icon" style="width: 18px; height: auto;" /></a>
                    <a href="#"><img src="{{ asset('storage/images/twitter.png') }}" alt="Description of icon" style="width: 18px; height: auto;" /></a>
                    <a href="#"><img src="{{ asset('storage/images/linkedin-logo.png') }}" alt="Description of icon" style="width: 18px; height: auto;" /></a>
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- Contacts Section -->
    <!-- Contact Us Section -->
<section id="contacts" class="bg-white py-12">
    <div class="container mx-auto text-center">
        <!-- Title -->
        <h2 class="text-3xl font-bold text-red-600 mb-4">Contact Us</h2>
        <p class="text-gray-500 mb-8">Feel free to get in touch with us for any queries or assistance.</p>

        <!-- Contact Info Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
            <!-- Address -->
            <div class="flex flex-col items-center">
            <img src="{{ asset('storage/images/location.png') }}" alt="Description of icon" class="mb-4" style="width: auto; height: 80px;" />
                <h3 class="text-xl font-bold mb-2">ADDRESS</h3>
                <p class="text-gray-600">27 13 Lowe Haven</p>
            </div>

            <!-- Phone -->
            <div class="flex flex-col items-center">
            <img src="{{ asset('storage/images/phone-call.png') }}" alt="Description of icon" class="mb-4" style="width: auto; height: 80px;" />
                <h3 class="text-xl font-bold mb-2">PHONE</h3>
                <p class="text-gray-600">+63 9324 345 203</p>
            </div>

            <!-- Email -->
            <div class="flex flex-col items-center">
            <img src="{{ asset('storage/images/email.png') }}" alt="Description of icon" class="mb-4" style="width: auto; height: 80px;" />
                <h3 class="text-xl font-bold mb-2">EMAIL</h3>
                <p class="text-gray-600">business@info.com</p>
            </div>
        </div>
    </div>
</section>


    <!-- Footer Section -->
    <footer class="bg-gray-800 py-6 text-center text-white">
        <p class="text-sm">Copyright &copy; <a href="#top">PlaceIt</a>, All Rights Reserved.</p>
    </footer>

    <!-- JavaScript for Hamburger Menu (Mobile) and Smooth Scroll -->
    <script>
        const menuBtn = document.getElementById('menu-btn');
        const menu = document.getElementById('menu');

        menuBtn.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });

        // Smooth scrolling when clicking on nav links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();

                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Smooth scroll to top for "PlaceIt" in the footer
        const scrollToTop = document.querySelector('a[href="#top"]');
        scrollToTop.addEventListener('click', function(e) {
            e.preventDefault();
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    </script>
</body>
</html>
