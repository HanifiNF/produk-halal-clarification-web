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
    public function index(Request $request)
    {
        $user = Auth::user();

        // Hanya pengguna dengan status_pembina = true yang bisa mengakses halaman ini
        if (!$user->status_pembina) {
            abort(403, 'Unauthorized access. Pembina access required.');
        }

        $query = User::where('pembina_id', $user->id);

        // Handle search
        $search = $request->get('search');
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('nama_umkm', 'like', '%' . $search . '%');
            });
        }

        $binaan = $query->paginate(10);
        $binaan->appends(['search' => $search]);

        return view('pembina.binaan', compact('binaan', 'search'));
    }
}