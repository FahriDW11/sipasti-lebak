<?php

namespace App\Http\Controllers\Pembina;

use Illuminate\Http\Request;

use App\Models\Napi;
use App\Models\Log_kegiatan;

class NapiController
{
    

    public function index(Request $request) 
    {
        $pembinaId = auth()->user()->pembina->id;
        $search = $request->input('search');
        $napis = Napi::where('pembina_id', $pembinaId)->when($search, function ($query, $search) {
            return $query->where('nama', 'like', "%{$search}%");
        })->orderBy('nama', 'asc')->paginate(10);;
        return view('pembina.napi.index', compact('napis'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $napi = Napi::findOrFail($id);
        $logKegiatan = Log_kegiatan::where('napi_id', $id)->orderBy('tanggal', 'desc')->get();

        $logs = Log_kegiatan::selectRaw('MONTH(tanggal) as month, COUNT(*) as count')
            ->where('napi_id', $id)
            ->whereYear('tanggal', now()->year)
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();

        $datas = [];

        for ($i = 1; $i <= 12; $i++) {
            $datas[] = $logs[$i] ?? 0;
        }

        $chartData = [
            'labels' => ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
            'data' => $datas,
        ];
        return view('pembina.napi.show', compact('napi', 'chartData', 'logKegiatan'));
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
