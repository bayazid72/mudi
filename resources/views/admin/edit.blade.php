<x-app-layout>
    <div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded shadow">
        <h1 class="text-2xl font-bold mb-4">Gebruiker bewerken</h1>

        <form method="POST" action="{{ route('admin.users.update', $user) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block mb-1">Naam</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                       class="w-full border p-2 rounded" required>
                @error('name') <p class="text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block mb-1">Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                       class="w-full border p-2 rounded" required>
                @error('email') <p class="text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block mb-1">Rol</label>
                <select name="role" class="w-full border p-2 rounded">
                    <option value="admin" @selected(old('role', $user->role ?? '') === 'admin')>Admin</option>
                    <option value="ophaler" @selected(old('role', $user->role ?? '') === 'ophaler')>Ophaler</option>
                    <option value="invoerder" @selected(old('role', $user->role ?? '') === 'invoerder')>Invoerder</option>
                </select>
                @error('role') <p class="text-red-500">{{ $message }}</p> @enderror
            </div>

            <button class="bg-blue-600 text-white px-4 py-2 rounded">
                Opslaan
            </button>
        </form>
    </div>
</x-app-layout>
