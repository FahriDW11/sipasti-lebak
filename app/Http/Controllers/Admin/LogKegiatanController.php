<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Models\Log_kegiatan;

class LogKegiatanController
{
    private $BASE_VIEW = 'admin.log_kegiatan.';
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $search = $request->input('search');
        $logs = Log_kegiatan::whereHas('napi', function ($query) use ($search) {
            if($search){
                $query->where('nama', 'like', "%{$search}%");
            }
        })->with('napi')->orderBy('tanggal','desc')->paginate(15);

        return view($this->BASE_VIEW.'index', compact('logs'));
    }

    public function show(string $id)
    {
        //
        $log = Log_kegiatan::with(['napi', 'kegiatan'])->findOrFail($id);
        return view($this->BASE_VIEW.'show', compact('log'));
    }

}
