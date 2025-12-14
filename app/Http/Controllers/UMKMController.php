<?php

namespace App\Http\Controllers;

use App\Models\UMKM;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UMKMController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $umkms = Auth::user()->umkms()->latest()->paginate(10);
        return view('umkm.index', compact('umkms'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Return a response for when accessed directly
        // Since we're now using modals, redirect to the index page
        return redirect()->route('umkm.index');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_umkm' => 'required|string|max:255',
            'email_umkm' => 'nullable|email|max:255',
            'nomor_handphone_umkm' => 'nullable|string|max:20',
            'alamat' => 'required|string|max:500',
            'kota' => 'required|string|max:100',
            'provinsi' => 'required|string|max:100',
            'tahun_berdiri' => 'required|integer|min:1900|max:' . date('Y'),
        ]);

        $umkm = UMKM::create([
            'user_id' => Auth::user()->id,
            'owner' => Auth::user()->name,
            'nama_umkm' => $validatedData['nama_umkm'],
            'email_umkm' => $validatedData['email_umkm'],
            'nomor_handphone_umkm' => $validatedData['nomor_handphone_umkm'],
            'alamat' => $validatedData['alamat'],
            'kota' => $validatedData['kota'],
            'provinsi' => $validatedData['provinsi'],
            'tahun_berdiri' => $validatedData['tahun_berdiri'],
        ]);

        // Check if the request is AJAX (for the modal form)
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'UMKM registered successfully.',
                'umkm' => $umkm // include the created UMKM data if needed
            ]);
        }

        return redirect()->route('umkm.index')->with('success', 'UMKM registered successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(UMKM $umkm)
    {
        $currentUser = Auth::user();
        // Ensure the user can only view their own UMKM
        if ($umkm->user_id == Auth::user()->id || $currentUser->admin || $currentUser->data_access) {
            return view('umkm.show', compact('umkm'));
        }

        abort(403, 'Unauthorized access.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UMKM $umkm)
    {
        // Only allow the owner or admin to edit - data access users can only view
        if ($umkm->user_id == Auth::user()->id || Auth::user()->admin) {
            return view('umkm.edit', compact('umkm'));
        }

        abort(403, 'Unauthorized access.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UMKM $umkm)
    {
        // Only allow the owner or admin to update - data access users can only view
        if ($umkm->user_id == Auth::user()->id || Auth::user()->admin) {
             $request->validate([
                'nama_umkm' => 'required|string|max:255',
                'email_umkm' => 'nullable|email|max:255',
                'nomor_handphone_umkm' => 'nullable|string|max:20',
                'alamat' => 'required|string|max:500',
                'kota' => 'required|string|max:100',
                'provinsi' => 'required|string|max:100',
                'tahun_berdiri' => 'required|integer|min:1900|max:' . date('Y'),
            ]);

            $umkm->update([
                'nama_umkm' => $request->nama_umkm,
                'email_umkm' => $request->email_umkm,
                'nomor_handphone_umkm' => $request->nomor_handphone_umkm,
                'alamat' => $request->alamat,
                'kota' => $request->kota,
                'provinsi' => $request->provinsi,
                'tahun_berdiri' => $request->tahun_berdiri,
            ]);

            return redirect()->route('umkm.index')->with('success', 'UMKM updated successfully.');
        }

        abort(403, 'Unauthorized access.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UMKM $umkm)
    {
        // Only allow the owner or admin to delete - data access users can only view
        if ($umkm->user_id == Auth::user()->id || Auth::user()->admin) {
            $umkm->delete();

            return redirect()->route('umkm.index')->with('success', 'UMKM deleted successfully.');
        }

        abort(403, 'Unauthorized access.');
    }
    
    /**
     * Display a listing of all UMKMs for admin users.
     */
    public function listAll()
    {
        $currentUser = Auth::user();
        // Allow admin and data access users to view all UMKMs
        if (!$currentUser->admin && !$currentUser->data_access) {
            abort(403, 'Unauthorized access. Admin or data access required.');
        }

        $umkms = UMKM::with('user')->latest()->paginate(10);
        return view('umkm.listall', compact('umkms'));
    }
}