<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Napi;
use App\Models\Log_kegiatan;

class SearchController
{
    //
    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $napis = Napi::query()
    ->where(function ($query) use ($keyword) {
        $query->where('nama', 'LIKE', "%{$keyword}%")
              ->orWhere('nama_ayah', 'LIKE', "%{$keyword}%")
              ->orWhereRaw('nama SOUNDS LIKE ?', [$keyword]);
    })
    ->orderByRaw(
        "CASE
            WHEN nama = ? THEN 1
            WHEN nama LIKE ? THEN 2
            WHEN nama_ayah LIKE ? THEN 3
            ELSE 4
        END",
        [
            $keyword,
            "%{$keyword}%",
            "%{$keyword}%"
        ]
    )
    ->select('id', 'photo', 'nama', 'nama_ayah')
    ->paginate(10);
        return view('public.search.results', compact('napis'));
    }

    public function searchDetail(Request $request, $id)
    {
        $tglahir = $request->input('tglahir');
        $napi = Napi::findOrFail($id);

        if ($napi->tgl_lahir !== $tglahir) {
            return redirect()->back()->withErrors(['tglahir' => 'Tanggal lahir tidak sesuai.']);
        }

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


        return view('public.search.show', compact('napi', 'chartData', 'logKegiatan'));
    }
   

}