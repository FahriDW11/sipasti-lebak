<?php

namespace App\Http\Controllers\Pembina;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Pembina;
use App\Models\Log_kegiatan;
use App\Models\Kegiatan;

class LogKegiatanController
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $userId = Auth::id();
        $pembinaId = Pembina::where('user_id', $userId)->value('id');
        $logs = Log_kegiatan::whereHas('tahanan', function ($query) use ($pembinaId,$search) {
            $query->where('pembina_id', $pembinaId);
            if($search){
                $query->where('nama', 'like', "%{$search}%");
            }
        })->with('tahanan')->latest()->paginate(10);

        return view('pembina.log_kegiatan.index', compact('logs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $userId = Auth::id();
        $pembina = Pembina::where('user_id', $userId)->first();
        if (!$pembina) {
            return redirect()->back()->with('error', 'Profil data pembina Anda tidak ditemukan.');
        }

        $tahanans = $pembina->tahanans()->select('id', 'nama')->get();
        $kegiatans = Kegiatan::all();

        return view('pembina.log_kegiatan.create', compact('tahanans', 'kegiatans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'kegiatan_id'  => 'required|exists:kegiatans,id',
            'tahanan_ids'  => 'required|array|min:1', // Minimal harus mencentang 1 orang
            'tahanan_ids.*'=> 'exists:tahanans,id',
            'tanggal'      => 'required|date',
            'catatan'      => 'nullable|string|max:255'
        ]);

        $kegiatanId = $request->input('kegiatan_id');
        $tahananIds = $request->input('tahanan_ids');
        $tanggal    = $request->input('tanggal');
        $catatan    = $request->input('catatan');

        // Looping untuk menyimpan record log ke masing-masing tahanan yang dipilih
        foreach ($tahananIds as $tahananId) {
            Log_kegiatan::create([
                'kegiatan_id' => $kegiatanId,
                'tahanan_id'  => $tahananId,
                'tanggal'     => $tanggal,
                'catatan'     => $catatan
            ]);
        }

        return redirect()->route('pembina.log-kegiatan.index')
                        ->with('success', 'Log kegiatan berhasil disimpan untuk ' . count($tahananIds) . ' tahanan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
