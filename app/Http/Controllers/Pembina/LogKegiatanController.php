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
        $logs = Log_kegiatan::whereHas('napi', function ($query) use ($pembinaId,$search) {
            $query->where('pembina_id', $pembinaId);
            if($search){
                $query->where('nama', 'like', "%{$search}%");
            }
        })->with('napi')->latest()->paginate(10);

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

        $napis = $pembina->napis()->select('id', 'nama')->get();
        $kegiatans = Kegiatan::all();

        return view('pembina.log_kegiatan.create', compact('napis', 'kegiatans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'kegiatan_id'  => 'required|exists:kegiatans,id',
            'napi_ids'  => 'required|array|min:1', // Minimal harus mencentang 1 orang
            'napi_ids.*'=> 'exists:napis,id',
            'tanggal'      => 'required|date',
            'catatan'      => 'nullable|string|max:255'
        ]);

        $kegiatanId = $request->input('kegiatan_id');
        $napiIds = $request->input('napi_ids');
        $tanggal    = $request->input('tanggal');
        $catatan    = $request->input('catatan');

        // Looping untuk menyimpan record log ke masing-masing napi yang dipilih
        foreach ($napiIds as $napiId) {
            Log_kegiatan::create([
                'kegiatan_id' => $kegiatanId,
                'napi_id'  => $napiId,
                'tanggal'     => $tanggal,
                'catatan'     => $catatan
            ]);
        }

        return redirect()->route('pembina.log-kegiatan.index')
                        ->with('success', 'Log kegiatan berhasil disimpan untuk ' . count($napiIds) . ' napi.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $log = Log_kegiatan::with(['napi', 'kegiatan'])->findOrFail($id);
        return view('pembina.log_kegiatan.show', compact('log'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $kegiatans = Kegiatan::all();
        $log = Log_kegiatan::findOrFail($id);
        return view('pembina.log_kegiatan.edit', compact('log', 'kegiatans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'kegiatan_id' => 'required|exists:kegiatans,id',
            'tanggal'     => 'required|date',
            'catatan'     => 'nullable|string|max:255'
        ]);

        $log = Log_kegiatan::findOrFail($id);
        $log->update([
            'kegiatan_id' => $request->input('kegiatan_id'),
            'tanggal'     => $request->input('tanggal'),
            'catatan'     => $request->input('catatan')
        ]);
        return redirect()->route('pembina.log-kegiatan.index')
                        ->with('success', 'Log kegiatan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $log = Log_kegiatan::findOrFail($id);
        $log->delete();
        return redirect()->route('pembina.log-kegiatan.index')
                        ->with('success', 'Log kegiatan berhasil dihapus.');
    }
}
