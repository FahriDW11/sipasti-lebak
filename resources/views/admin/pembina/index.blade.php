@extends('layouts.admin', [
    'active' => 'pembina',
    'title' => 'Data Pembina'
])

@section('admin-content')


<div class="flex items-center justify-between mb-4"> 
    <form action="{{ route('admin.pembina.index') }}" method="GET">
        <div class="flex gap-2">
            <input type="search" name="search" placeholder="Cari Pembina..." value="{{ request('search') }}" class="input input-bordered input-sm w-full max-w-xs" />
            <button type="submit" class="btn btn-sm btn-primary text-xs tooltip tooltip-left" data-tip="Cari Pembina">
                <x-lucide-search class="w-4 lg:w-6 text-white" />
            </button>
        </div>
    </form>
    <a href="{{ route('admin.pembina.create') }}" class="btn btn-primary btn-sm text-xs tooltip tooltip-left" data-tip="Tambah Pembina">
        <x-lucide-plus class="w-4 lg:w-6 text-white" />
    </a>
</div>

<div class="overflow-x-auto rounded-box border border-base-content/5 bg-base-100">
    <table class="table">
        <tr>
            <th>Foto</th>
            <th>Nama</th>
            <th>Aksi</th>
        </tr>
        @forelse($pembinas as $pembina)
        <tr>
            <td>
                <div class="avatar">
                    <div class="w-16 rounded">
                        <img src="{{ $pembina->photo ? asset('storage/' . $pembina->photo) : asset('storage/images/default-avatar.png') }}" alt="{{ $pembina->nama }}">
                    </div>
                </div>
            </td>
            <td class="truncate w-full max-w-xs">{{ $pembina->nama }}</td>
            <td>
                <div class="flex gap-0.5 justify-end">
                    <a href="{{ route('admin.pembina.show', $pembina->id) }}" class="btn btn-sm btn-info"><x-lucide-eye class="w-4 lg:w-6 text-white" /></a>
                    <a href="{{ route('admin.pembina.edit', $pembina->id) }}" class="btn btn-sm btn-warning"><x-lucide-edit class="w-4 lg:w-6 text-white" /></a>
                        <button type="button" onclick="openDeleteModal('{{ route('admin.pembina.destroy', $pembina->id) }}', '{{ $pembina->nama }}')" class="btn btn-sm btn-error">
                            <x-lucide-trash class="w-4 lg:w-6 text-white" />
                        </button>
                    
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="3" class="text-center">Tidak ada data pembina.</td>
        </tr>
        @endforelse
    </table>
</div>
@include('layouts.partials.pagination',['datas'=>$pembinas])

@endsection