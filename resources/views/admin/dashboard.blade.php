@extends('layouts.admin', [
    'active' => 'dashboard',
    'title' => 'Dashboard'
])

@section('admin-content')
<h1>Admin Dashboard</h1>

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

<!-- charts -->

    @include('layouts.components.chart', [
    'chartId' => 'logKegiatan-chart',
    'chartTitle' => 'Statistik Kegiatan Warga Binaan Tahun ' . date('Y'),
    'chartData' => $chartData
])

<!-- info -->


@endsection