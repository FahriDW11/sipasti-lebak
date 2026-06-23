@extends('layouts.pembina', ['active'=>'napi','title' => 'Detail Warga Binaan'])

@section('pembina-content')

<div class="flex flex-col items-center gap-4 mb-4">
    <a class="btn btn-accent self-start" href="{{ route('pembina.napi.index') }}">
        <x-lucide-arrow-left class="w-4 lg:w-6 text-white"/>
    </a>
    <div class="avatar">
        <div class="w-40 rounded">
            <img src="{{ $napi->photo ? asset('storage/' . $napi->photo) : asset('storage/images/default-avatar.png') }}" alt="{{ $napi->nama }}">
        </div>
    </div>
    <div class="w-full max-w-md">
        <h2 class="text-xl font-bold text-center">{{ $napi->nama }}</h2>
        <table class="table table-sm mt-2 md:table-md">
            <tbody>
                <tr>
                    <th>Nama Ayah</th>
                    <td>{{ $napi->nama_ayah }}</td>
                </tr>
                <tr>
                    <th>Jenis Kelamin</th>
                    <td>{{ $napi->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                </tr>
                <tr>
                    <th>Tanggal Lahir</th>
                    <td>{{ $napi->tgl_lahir_format }}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>{{ $napi->alamat }}</td>
                </tr>
                
            </tbody>
        </table>
    </div>
</div>

@include('layouts.components.chart', [
    'chartId' => 'logKegiatan-chart',
    'chartTitle' => 'Statistik Kegiatan Warga Binaan Tahun ' . date('Y'),
    'chartData' => $chartData
])

<!-- list log kegiatan -->
<div class="mt-8">
    <h2 class="font-display text-2xl text-white mb-4">Log Kegiatan Warga Binaan</h2>
    <div class="overflow-x-auto rounded-box border border-base-content/5 bg-base-100 w-full">
        <table class="table">
            <tr>
                <th>Tanggal</th>
                <th>Kegiatan</th>
                <th>Catatan</th>
            </tr>
            @forelse($logKegiatan as $log)
            <tr>
                <td>{{ $log->tanggal_format }}</td>
                <td>{{ $log->kegiatan->nama }}</td>
                <td>{{ $log->catatan }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center text-base-content/50">Tidak ada log kegiatan untuk warga binaan ini.</td>
            </tr>
            @endforelse
        </table>
    </div>
</div>

@endsection