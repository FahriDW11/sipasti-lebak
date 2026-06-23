<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Models\Pembina;
use App\Models\Napi;
use App\Models\Log_kegiatan;

class DashboardController
{
    private $BASE_VIEW = 'admin.';

    public function index()
    {
        $jumlahNapi = Napi::count();
        $jumlahPembina = Pembina::count();
        $jumlahLogKegiatanBulanIni = Log_kegiatan::whereMonth('created_at', now()->month)->count();

        $logs = Log_kegiatan::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', now()->year)
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


        return view($this->BASE_VIEW . 'dashboard' , compact('jumlahNapi', 'jumlahPembina', 'jumlahLogKegiatanBulanIni', 'chartData'));
    }

}