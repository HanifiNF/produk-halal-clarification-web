<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        // Dapatkan daftar pembina (user dengan status_pembina = 1)
        // Use try-catch to handle potential database issues
        try {
            $pembinaList = \App\Models\User::where('status_pembina', true)->get();
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Error fetching pembina list: ' . $e->getMessage());
            // Return empty collection if there's an error
            $pembinaList = collect();
        }

        return view('auth.register', compact('pembinaList'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone_number' => ['nullable', 'string', 'max:20'],
            'nama_umkm' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:500'],
            'city' => ['nullable', 'string', 'max:100'],
            'province' => ['nullable', 'string', 'max:100'],
            'establish_year' => ['nullable', 'integer', 'min:1900', 'max:'.date('Y')],
            'pembina_id' => ['nullable', 'exists:users,id', function ($attribute, $value, $fail) {
                if (!empty($value)) {
                    try {
                        $pembinaExists = User::where('id', $value)
                            ->where('status_pembina', true)
                            ->exists();

                        if (!$pembinaExists) {
                            $fail('The selected pembina is not valid or does not have pembina status.');
                        }
                    } catch (\Exception $e) {
                        \Log::error('Error validating pembina: ' . $e->getMessage());
                        $fail('There was an error validating the pembina selection.');
                    }
                }
            }],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'nama_umkm' => $request->nama_umkm,
            'address' => $request->address,
            'city' => $request->city,
            'province' => $request->province,
            'establish_year' => $request->establish_year,
            'pembina_id' => $request->pembina_id,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
