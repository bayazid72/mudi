<x-app-layout>
    <div class="max-w-5xl mx-auto mt-10 bg-white p-6 rounded shadow">
        <div class="flex justify-between mb-4">
            <h1 class="text-2xl font-bold">Gebruikers</h1>

            <a href="{{ route('admin.users.create') }}"
               class="bg-blue-600 text-black px-4 py-2 rounded">
                Gebruiker toevoegen
            </a>
        </div>

        @if(session('success'))
            <div class="mb-4 text-green-600">
                {{ session('success') }}
            </div>
        @endif

        <form method="GET" action="{{ route('admin.users.index') }}" class="mb-4 flex gap-2">
            <input type="text"
                   name="search"
                   value="{{ request('search') }}"
                   placeholder="Zoek naam of email..."
                   class="border p-2 rounded w-full">

                <select name="role" class="border p-2 rounded">
                    <option value="">Alle rollen</option>
                    <option value="admin" @selected(request('role') === 'admin')>Admin</option>
                    <option value="ophaler" @selected(request('role') === 'ophaler')>Ophaler</option>
                    <option value="invoerder" @selected(request('role') === 'invoerder')>Invoerder</option>
                </select>

            <button class="bg-blue-600 text-black px-4 py-2 rounded">
                Zoeken
            </button>

            <a href="{{ route('admin.users.index') }}"
               class="bg-gray-300 text-black px-4 py-2 rounded">
                Reset
            </a>
        </form>

        <table class="w-full border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border p-2 text-left">Naam</th>
                    <th class="border p-2 text-left">Email</th>
                    <th class="border p-2 text-left">Rol</th>
                    <th class="border p-2 text-left">Actie</th>
                </tr>
            </thead>

            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td class="border p-2">{{ $user->name }}</td>
                        <td class="border p-2">{{ $user->email }}</td>
                        <td class="border p-2">{{ $user->role }}</td>

                        <td class="border p-2">
                            <a href="{{ route('admin.users.edit', $user) }}"
                               class="text-blue-600">
                                Bewerken
                            </a>

                            <form method="POST"
                                  action="{{ route('admin.users.destroy', $user) }}"
                                  class="inline">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        onclick="return confirm('Weet je zeker?')"
                                        class="text-red-600 ml-3">
                                    Verwijderen
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="border p-4 text-center">
                            Geen gebruikers gevonden.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
</x-app-layout>
