<?php

namespace App\Http\Controllers\Pembina;

use Illuminate\Http\Request;

use App\Models\Pembina;
use App\Models\Napi;
use App\Models\Log_kegiatan;

class DashboardController
{
    private $BASE_VIEW = 'pembina.';

    public function index()
    {
        $pembinaId = auth()->user()->pembina->id;
        $jumlahNapi = Napi::where('pembina_id', $pembinaId)->count();
        $jumlahPembina = Pembina::count();
        $jumlahLogKegiatanBulanIni = Log_kegiatan::whereHas('napi', function ($query) use ($pembinaId) {
            $query->where('pembina_id', $pembinaId);
        })->whereYear('tanggal', now()->year)->whereMonth('tanggal', now()->month)->count();

        $logs = Log_kegiatan::selectRaw('MONTH(tanggal) as month, COUNT(*) as count')
            ->whereHas('napi', function ($query) use ($pembinaId) {
                    $query->where('pembina_id', $pembinaId);
                })
            ->whereYear('tanggal', now()->year)
            ->groupBy('month')
            ->pluck('count', 'month')
            ->toArray();

        $datas = [];

        for ($i = 1; $i <= 12; $i++) {
            $datas[] = $logs[$i] ?? 0;
        }

        $chartData = [
            'tahun' => now()->year,
            'labels' => ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
            'data' => $datas,
        ];

        $leaderboard = Log_kegiatan::selectRaw('napi_id, COUNT(*) as count')
            ->whereHas('napi', function ($query) use ($pembinaId) {
                $query->where('pembina_id', $pembinaId);
            })
            ->groupBy('napi_id')
            ->orderByDesc('count')
            ->with('napi:id,nama')
            ->take(7)
            ->get();


        return view($this->BASE_VIEW . 'dashboard' , compact('jumlahNapi', 'jumlahPembina', 'jumlahLogKegiatanBulanIni', 'chartData', 'leaderboard'));
    }

}