<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class PembinaController extends Controller
{
    /**
     * Display the list of binaan for the current pembina.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $user = Auth::user();
        
        // Hanya pengguna dengan status_pembina = true yang bisa mengakses halaman ini
        if (!$user->status_pembina) {
            abort(403, 'Unauthorized access. Pembina access required.');
        }

        $binaan = User::where('pembina_id', $user->id)
            ->paginate(10);

        return view('pembina.binaan', compact('binaan'));
    }
}