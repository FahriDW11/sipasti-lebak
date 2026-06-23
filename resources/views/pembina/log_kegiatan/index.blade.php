@extends('layouts.pembina', [
    'active' => 'log-kegiatan',
    'title' => 'Log Kegiatan'
])

@section('pembina-content')


<div class="flex items-center justify-between mb-4"> 
    <form action="{{ route('pembina.log-kegiatan.index') }}" method="GET">
        <div class="flex gap-2">
            <input type="search" name="search" placeholder="Cari Log Kegiatan..." value="{{ request('search') }}" class="input input-bordered input-sm w-full max-w-xs" />
            <button type="submit" class="btn btn-sm btn-primary text-xs tooltip tooltip-left" data-tip="Cari Log Kegiatan">
                <x-lucide-search class="w-4 lg:w-6 text-white" />
            </button>
        </div>
    </form>
    <a href="{{ route('pembina.log-kegiatan.create') }}" class="btn btn-primary btn-sm text-xs tooltip tooltip-left" data-tip="Tambah Log Kegiatan">
        <x-lucide-plus class="w-4 lg:w-6 text-white" />
    </a>
</div>

<div class="overflow-x-auto rounded-box border border-base-content/5 bg-base-100">
    <table class="table">
        <tr>
            <th>Warga Binaan</th>
            <th>Kegiatan</th>
            <th>Tanggal</th>
            <th>Aksi</th>
        </tr>
        @forelse($logs as $log)
        <tr>
            <td class="truncate w-full max-w-xs">{{ $log->napi->nama }} bin {{ $log->napi->nama_ayah }}</td>
            <td>{{ $log->kegiatan->nama }}</td>
            <td class="whitespace-nowrap">{{ $log->tanggal_format }}</td>
            <td>
                <div class="flex gap-1 justify-end">
                    <a href="{{ route('pembina.log-kegiatan.show', $log->id) }}" class="btn btn-sm btn-info rounded-xl">
                        <x-lucide-eye class="w-4 text-white" />
                    </a>
                    <a href="{{ route('pembina.log-kegiatan.edit', $log->id) }}" class="btn btn-sm btn-warning rounded-xl">
                        <x-lucide-edit class="w-4 text-white" />
                    </a>
                    <button type="button" onclick="openDeleteModal('{{ route('pembina.log-kegiatan.destroy', $log->id) }}', '{{ $log->napi->nama }}')" class="btn btn-sm btn-error rounded-xl">
                        <x-lucide-trash class="w-4 text-white" />
                    </button>
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="text-center">Tidak Ada Data Log Kegiatan.</td>
        </tr>
        @endforelse
    </table>
</div>
@include('layouts.partials.pagination',['datas'=>$logs])

@endsection