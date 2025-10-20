<?php
require_once 'includes/functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Privacy Policy - Gamenda</title>
    <link rel="icon" type="image/x-icon" href="/static/favicon.ico">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Press+Start+2P&family=Ubuntu:wght@400;500;700&display=swap');
        .font-pixel { font-family: 'Press Start 2P', cursive; }
        .font-main { font-family: 'Ubuntu', sans-serif; }
        .hero-gradient {
            background: linear-gradient(135deg, #6e45e2 0%, #88d3ce 100%);
        }
    </style>
</head>
<body class="font-main bg-gray-900 text-white">
    <!-- Navigation -->
    <nav class="bg-gray-800 bg-opacity-90 backdrop-filter backdrop-blur-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <a href="index.php" class="font-pixel text-xl text-purple-400">GAMENDA</a>
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-10 flex items-baseline space-x-4">
                            <a href="index.php" class="px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:text-white">Home</a>
                            <a href="categories.php" class="px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:text-white">Categories</a>
                            <a href="about.php" class="px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:text-white">About</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Header -->
    <header class="hero-gradient">
        <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-pixel mb-6 text-white">
                PRIVACY POLICY
            </h1>
            <p class="text-xl text-purple-100">
                Last updated: December 1, 2023
            </p>
        </div>
    </header>

    <!-- Content -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="bg-gray-800 rounded-2xl p-8 md:p-12">
            <div class="prose prose-invert prose-purple max-w-none">
                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-purple-400 mb-4">1. Information We Collect</h2>
                    <h3 class="text-xl font-semibold text-white mb-3">Personal Information</h3>
                    <p class="text-gray-300 mb-4">
                        When you use Gamenda, we may collect personal information that you voluntarily provide to us, such as:
                    </p>
                    <ul class="list-disc list-inside text-gray-300 space-y-2 ml-4 mb-4">
                        <li>Email address (for support inquiries)</li>
                        <li>Device information and IP address</li>
                        <li>Download history and preferences</li>
                    </ul>
                    
                    <h3 class="text-xl font-semibold text-white mb-3">Automatically Collected Information</h3>
                    <p class="text-gray-300">
                        We automatically collect certain information when you visit our website, including:
                    </p>
                    <ul class="list-disc list-inside text-gray-300 space-y-2 ml-4">
                        <li>Browser type and version</li>
                        <li>Pages visited and time spent on pages</li>
                        <li>Download statistics and game preferences</li>
                    </ul>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-purple-400 mb-4">2. How We Use Your Information</h2>
                    <p class="text-gray-300 mb-4">
                        We use the information we collect for various purposes:
                    </p>
                    <ul class="list-disc list-inside text-gray-300 space-y-2 ml-4">
                        <li>To provide and maintain our Service</li>
                        <li>To notify you about changes to our Service</li>
                        <li>To provide customer support</li>
                        <li>To gather analysis or valuable information to improve our Service</li>
                        <li>To monitor the usage of our Service</li>
                        <li>To detect, prevent and address technical issues</li>
                    </ul>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-purple-400 mb-4">3. Data Sharing and Disclosure</h2>
                    <p class="text-gray-300 mb-4">
                        We do not sell, trade, or otherwise transfer your personally identifiable information to third parties. This does not include trusted third parties who assist us in operating our website, conducting our business, or servicing you, so long as those parties agree to keep this information confidential.
                    </p>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-purple-400 mb-4">4. Cookies and Tracking</h2>
                    <p class="text-gray-300 mb-4">
                        We use cookies and similar tracking technologies to track activity on our Service and hold certain information. Cookies are files with small amount of data which may include an anonymous unique identifier.
                    </p>
                    <p class="text-gray-300">
                        You can instruct your browser to refuse all cookies or to indicate when a cookie is being sent. However, if you do not accept cookies, you may not be able to use some portions of our Service.
                    </p>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-purple-400 mb-4">5. Data Security</h2>
                    <p class="text-gray-300 mb-4">
                        The security of your data is important to us, but remember that no method of transmission over the Internet, or method of electronic storage is 100% secure. While we strive to use commercially acceptable means to protect your Personal Data, we cannot guarantee its absolute security.
                    </p>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-purple-400 mb-4">6. Your Data Protection Rights</h2>
                    <p class="text-gray-300 mb-4">
                        Depending on your location, you may have the following rights regarding your personal data:
                    </p>
                    <ul class="list-disc list-inside text-gray-300 space-y-2 ml-4">
                        <li>The right to access – You have the right to request copies of your personal data.</li>
                        <li>The right to rectification – You have the right to request correction of any information you believe is inaccurate.</li>
                        <li>The right to erasure – You have the right to request that we erase your personal data.</li>
                        <li>The right to restrict processing – You have the right to request that we restrict the processing of your personal data.</li>
                        <li>The right to data portability – You have the right to request that we transfer the data that we have collected to another organization, or directly to you.</li>
                    </ul>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-purple-400 mb-4">7. Children's Privacy</h2>
                    <p class="text-gray-300 mb-4">
                        Our Service does not address anyone under the age of 13. We do not knowingly collect personally identifiable information from anyone under the age of 13. If you are a parent or guardian and you are aware that your child has provided us with Personal Data, please contact us.
                    </p>
                </section>

                <section class="mb-8">
                    <h2 class="text-2xl font-bold text-purple-400 mb-4">8. Changes to This Privacy Policy</h2>
                    <p class="text-gray-300">
                        We may update our Privacy Policy from time to time. We will notify you of any changes by posting the new Privacy Policy on this page and updating the "Last updated" date.
                    </p>
                </section>

                <div class="mt-12 p-6 bg-gray-700 rounded-lg">
                    <h3 class="text-lg font-bold text-white mb-2">Contact Us</h3>
                    <p class="text-gray-300">
                        If you have any questions about this Privacy Policy, please contact us at:
                        <a href="mailto:privacy@gamenda.com" class="text-purple-400 hover:text-purple-300">privacy@gamenda.com</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="font-pixel text-white text-lg mb-4">GAMENDA</h3>
                    <p class="text-gray-400">
                        Your ultimate gaming destination with thousands of free and premium games across all platforms.
                    </p>
                </div>
                <div>
                    <h4 class="text-white font-medium mb-4">Legal</h4>
                    <ul class="space-y-2">
                        <li><a href="terms.php" class="text-gray-400 hover:text-white">Terms of Service</a></li>
                        <li><a href="privacy.php" class="text-purple-400 font-medium">Privacy Policy</a></li>
                        <li><a href="cookies.php" class="text-gray-400 hover:text-white">Cookie Policy</a></li>
                        <li><a href="dmca.php" class="text-gray-400 hover:text-white">DMCA</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-medium mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="index.php" class="text-gray-400 hover:text-white">Home</a></li>
                        <li><a href="categories.php" class="text-gray-400 hover:text-white">Categories</a></li>
                        <li><a href="about.php" class="text-gray-400 hover:text-white">About</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-medium mb-4">Contact</h4>
                    <ul class="space-y-2">
                        <li class="text-gray-400">Email: contact@gamenda.com</li>
                        <li class="text-gray-400">Support: support@gamenda.com</li>
                    </ul>
                    <div class="mt-4">
                        <p class="text-gray-400 text-sm">
                            © 2023 Gamenda. All rights reserved.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        feather.replace();
    </script>
</body>
</html>