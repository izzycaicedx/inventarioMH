<x-guest-layout>
    <!-- Logo de la empresa -->
    <div class="mb-4 text-center">
        <a href="/">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="mx-auto" style="max-width: 150px;">
        </a>
    </div>

    <!-- Muestra el mensaje de error de la sesión, si existe -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Correo electrónico -->
        <div>
            <x-input-label for="email" value="Correo electrónico" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Contraseña -->
        <div class="mt-4">
            <x-input-label for="password" value="Contraseña" />
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Recuérdame -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">Recuérdame</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-3">
                Iniciar Sesión
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
