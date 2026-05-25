<?php

namespace App\Http\Controllers\Admin;

use App\Models\Log_kegiatan;

class LogKegiatanController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        Log_kegiatan::with(['tahanan', 'kegiatan'])->get();
        return view('admin.log_kegiatan.index', [
            'log_kegiatans' => Log_kegiatan::with(['tahanan', 'kegiatan'])->get()
        ]);
    }

    public function show(string $id)
    {
        //
        $log_kegiatan = Log_kegiatan::with(['tahanan', 'kegiatan'])->findOrFail($id);
        return view('admin.log_kegiatan.show', compact('log_kegiatan'));
    }

}
