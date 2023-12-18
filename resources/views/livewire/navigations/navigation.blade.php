<nav class="bg-blue-500">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
            
               <!-- Logo -->
               <a href="{{ route('dashboard') }}" class="flex items-center">
                <img src="{{ asset('storage/logo/venty.png') }}" alt="Logo" class="h-10 w-auto">
            </a>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Venty') }}
                    </x-nav-link>

                </div>
            </div>

            <!-- User Profile and Logout -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @guest
                    <a href="{{ route('login') }}" class="text-white hover:text-gray-300">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </a>
                    <a href="{{ route('register') }}" class="ml-4 text-white hover:text-gray-300">
                        <i class="fas fa-user-plus"></i> Signup
                    </a>
                @endguest

                @auth

                    <!--A link for notification-->
                    <a href="{{ route('notifications') }}"
                        class="text-white hover:text-gray-300 mr-8 px-3 py-2 rounded-md text-sm font-medium bg-blue-500 hover:bg-blue-600">
                        <i class="fas fa-bell"></i> Notifications
                    </a>

                    <!-- Posts Link -->
                    <a href="{{ route('user.posts', ['userId' => auth()->id()]) }}"
                        class="text-white hover:text-gray-300 mr-8 px-3 py-2 rounded-md text-sm font-medium bg-blue-500 hover:bg-blue-600">
                        <i class="far fa-id-badge"></i> Posts
                    </a>

   

                    <!--Proifile component link--->
                    <a href="{{ route('profile.update-profile') }}" class="text-white hover:text-gray-300">
                        <i class="far fa-id-badge"></i> Profile
                    </a>

                    <!-- Logout Button -->
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit"
                            class="text-white hover:text-gray-300 px-3 py-2 rounded-md text-sm font-medium">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </button>
                    </form>
                @endauth

            </div>
            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = !open"
                    class="inline-flex items-center justify-center p-2 text-white hover:text-gray-300">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

    </div>
</nav>
