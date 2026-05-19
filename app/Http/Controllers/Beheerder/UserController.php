<?php

namespace App\Http\Controllers\beheerder;

// Controller basis class
use App\Http\Controllers\Controller;

// User model
use App\Models\User;

// Request voor formulier data
use Illuminate\Http\Request;

// Hash voor wachtwoord encryptie
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Toon alle gebruikers + zoeken + filter + paginatie
    public function index(Request $request)
    {
        $users = User::query()
            // Zoeken op naam of email
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%");
                });
            })

            // Filteren op rol
            ->when($request->role, function ($query, $role) {
                $query->where('role', $role);
            })

            // Nieuwste gebruikers eerst
            ->latest()

            // gebruikers per pagina
            ->paginate(5)

            // Zoek/filter behouden bij paginatie
            ->withQueryString();

        // Stuur gebruikers naar de view
        return view('beheerder.index', compact('users'));
    }

    // Toon formulier om gebruiker toe te voegen
    public function create()
    {
        return view('beheerder.create');
    }

    // Sla nieuwe gebruiker op
    public function store(Request $request)
    {
        // Controleer ingevulde velden
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'role' => 'required|in:beheerder,ophaler,invoerder',
        ]);

        // Maak gebruiker aan
        User::create([
            'name' => $request->name,
            'email' => $request->email,

            // Wachtwoord veilig opslaan
            'password' => Hash::make($request->password),

            'role' => $request->role,
        ]);

        // Terug naar gebruikerslijst
        return redirect()->route('beheerder.users.index')
            ->with('success', 'Gebruiker toegevoegd!');
    }

    // Toon formulier om gebruiker te bewerken
    public function edit(User $user)
    {
        return view('beheerder.edit', compact('user'));
    }

    // Werk gebruiker bij
    public function update(Request $request, User $user)
    {
        // Controleer ingevulde velden
        $request->validate([
            'name' => 'required|string|max:255',

            // Email moet uniek zijn, behalve voor deze gebruiker
            'email' => 'required|email|unique:users,email,' . $user->id,

            'role' => 'required|in:beheerder,ophaler,invoerder',
        ]);

        // Update gebruiker
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);

        // Terug naar gebruikerslijst
        return redirect()->route('beheerder.users.index')
            ->with('success', 'Gebruiker aangepast!');
    }

    // Verwijder gebruiker

    public function destroy(User $user)
    {
        // beheerder mag zichzelf niet verwijderen
        if (auth()->id() === $user->id) {
            return redirect()->route('beheerder.users.index')
                ->with('error', 'Je kunt jezelf niet verwijderen!');
        }

        $user->delete();

        return redirect()->route('beheerder.users.index')
            ->with('success', 'Gebruiker verwijderd!');
    }
}
