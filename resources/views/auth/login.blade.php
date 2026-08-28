<x-guest-layout>
<section class="min-h-screen flex items-center justify-center dark:bg-gray-900 py-4">

    <div class="w-full max-w-md mx-auto">

        <!-- Card -->
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-xl p-4 sm:p-8">

            <!-- Title -->
            <h2 class="text-2xl font-bold text-center text-gray-900 dark:text-white">
                Login SIM Karyawan
            </h2>

            <!-- Session Status -->
            @if (session('status'))
                <div class="mb-2 text-sm text-green-600 text-center font-medium bg-green-50 py-2 rounded-lg">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <!-- Email -->
                <div class="space-y-2">
                    <label for="email" class="text-sm font-semibold text-gray-700 dark:text-gray-300">
                        Email
                    </label>
                    <input type="email" name="email" id="email"
                        autocomplete="current-email"
                        value="{{ old('email') }}"
                        class="w-full p-3 text-sm border border-gray-300 rounded-lg bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-shadow
                        dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                        placeholder="name@email.com" required autofocus>

                    @error('email')
                        <p class="text-xs text-red-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="space-y-2">
                    <label for="password" class="text-sm font-semibold text-gray-700 dark:text-gray-300">
                        Password
                    </label>
                    <div class="relative">
                        <input type="password" name="password" id="password"
                            autocomplete="current-password"
                            class="w-full p-3 pr-10 text-sm border border-gray-300 rounded-lg bg-gray-50 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-shadow
                            dark:bg-gray-700 dark:border-gray-600 dark:text-white"
                            placeholder="••••••••" required>
                        
                        <!-- Tombol Icon Mata -->
                        <button type="button" id="togglePassword" class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-500 hover:text-gray-700 focus:outline-none transition-colors">
                            <!-- Icon Mata Terbuka -->
                            <svg id="eyeIcon" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <!-- Icon Mata Dicoret (Disembunyikan default) -->
                            <svg id="eyeSlashIcon" class="w-5 h-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                            </svg>
                        </button>
                    </div>

                    @error('password')
                        <p class="text-xs text-red-500 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember + Forgot -->
                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center gap-2 text-gray-600 dark:text-gray-300 cursor-pointer">
                        <input type="checkbox" name="remember" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500 cursor-pointer">
                        Ingat Saya
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="font-medium text-blue-600 hover:text-blue-700 hover:underline dark:text-blue-400">
                            Lupa password?
                        </a>
                    @endif
                </div>

                <!-- Button -->
                <div class="pt-2">
                    <button type="submit"
                        class="w-full py-3 text-sm font-bold text-white bg-blue-600 rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 transition-all">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- Script AJAX untuk tombol Refresh Captcha & Toggle Password -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Toggle Password Visibility
        const togglePassword = document.getElementById("togglePassword");
        const passwordInput = document.getElementById("password");
        const eyeIcon = document.getElementById("eyeIcon");
        const eyeSlashIcon = document.getElementById("eyeSlashIcon");

        togglePassword.addEventListener("click", function () {
            const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
            passwordInput.setAttribute("type", type);
            eyeIcon.classList.toggle("hidden");
            eyeSlashIcon.classList.toggle("hidden");
        });

       
    });
</script>
</x-guest-layout>