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
                @foreach($users as $user)
                    <tr>
                        <td class="border p-2">{{ $user->name }}</td>
                        <td class="border p-2">{{ $user->email }}</td>
                        <td class="border p-2">{{ $user->role }}</td>
                        <td class="border p-2">
                        <a href="{{ route('admin.users.edit', $user) }}"
                        class="text-blue-600">
                            Bewerken
                        </a>
                    </td>

                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
