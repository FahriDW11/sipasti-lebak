@extends('layouts.pembina', [
    'active' => 'dashboard',
    'title' => 'Dashboard'
])

@section('pembina-content')

<!-- Welcome -->
<div class="p-6 rounded-lg">
  <h2 class="text-2xl font-bold">Selamat Datang, {{ auth()->user()->pembina->nama }}!</h2>
  <p class="text-gray-600">Ini adalah halaman dashboard untuk pembina.</p>
</div>

<!-- stats -->
<div class="stats bg-base-100 shadow-lg w-full stats-vertical lg:stats-horizontal mb-6">
  <div class="stat">
    <div class="stat-figure text-primary"><x-lucide-users class="w-8 h-8" /></div>
    <div class="stat-title">Jumlah Warga Binaan</div>
    <div class="stat-value">{{ $jumlahNapi }}</div>
  </div>

  <div class="stat">
    <div class="stat-figure text-info"><x-lucide-user class="w-8 h-8" /></div>
    <div class="stat-title">Jumlah Pembina</div>
    <div class="stat-value">{{ $jumlahPembina }}</div>
  </div>

  <div class="stat">
    <div class="stat-figure text-success"><x-lucide-activity class="w-8 h-8" /></div>
    <div class="stat-title">Kegiatan Warga Binaan Bulan Ini</div>
    <div class="stat-value">{{ $jumlahLogKegiatanBulanIni }}</div>
  </div>
</div>

<div class="flex gap-6 flex-col lg:flex-row">


    
    <!-- charts -->
    <div class="grow">

        @include('layouts.components.chart', [
          'chartId' => 'logKegiatan-chart',
          'chartTitle' => 'Statistik Kegiatan Warga Binaan Tahun ' . date('Y'),
          'chartData' => $chartData
        ])
    </div>

    <!-- info -->

    <div class="">
        <ul class="list bg-base-100 card p-4 rounded-lg">
            <li class="p-4 pb-2 text-xs opacity-60 tracking-wide">Leaderboard Warga Binaan Aktif</li>
            @foreach($leaderboard as $log)
            <li class="list-row">
            <span class="list-col-grow">{{ $log->napi->nama }}</span>
            <span class="badge badge-primary">{{ $log->count }}</span>
            </li>
            @endforeach
        </ul>
    </div>

</div>


@endsection