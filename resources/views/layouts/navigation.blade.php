<nav class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="flex items-center">
                    <a href="{{ route('dashboard') }}" class="font-bold text-xl text-gray-800 dark:text-white">
                        LOGO
                    </a>
                </div>


                @if(Auth::user()->role === 'admin')
                    <div class="hidden sm:flex sm:ml-10 space-x-8">
                        <a href="{{ route('admin.users.index') }}" class="inline-flex items-center text-gray-700 dark:text-gray-300">
                            Gebruikers Beheer
                        </a>
                    </div>
                @endif
            </div>

            <div class="flex items-center space-x-4">
                <span class="text-gray-700 dark:text-gray-300">
                    {{ Auth::user()->name }}
                </span>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="text-red-600">
                        Uitloggen
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
