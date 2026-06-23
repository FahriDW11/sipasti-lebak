@extends('layouts.pembina', [
    'active' => 'napi',
    'title' => 'Data Warga Binaan'
])

@section('pembina-content')


<div class="flex items-center justify-between mb-4"> 
    <form action="{{ route('pembina.napi.index') }}" method="GET">
        <div class="flex gap-2">
            <input type="search" name="search" placeholder="Cari Warga Binaan..." value="{{ request('search') }}" class="input input-bordered input-sm w-full max-w-xs" />
            <button type="submit" class="btn btn-sm btn-primary text-xs tooltip tooltip-left" data-tip="Cari Warga Binaan">
                <x-lucide-search class="w-4 lg:w-6 text-white" />
            </button>
        </div>
    </form>
</div>

<div class="overflow-x-auto rounded-box border border-base-content/5 bg-base-100">
    <table class="table">
        <tr>
            <th></th>
            <th class="grow"></th>
            <th class="text-center">Aksi</th>
        </tr>
        @forelse($napis as $napi)
        <tr>
            <td>
                <div class="avatar">
                    <div class="w-16 rounded">
                        <img src="{{ $napi->photo ? asset('storage/' . $napi->photo) : asset('storage/images/default-avatar.png') }}" alt="{{ $napi->nama }}">
                    </div>
                </div>
            </td>
            <td class="truncate w-full max-w-xs">{{ $napi->nama }} bin {{ $napi->nama_ayah }}</td>
            <td>
                <a href="{{ route('pembina.napi.show', $napi->id) }}" class="btn btn-sm btn-info"><x-lucide-eye class="w-4 lg:w-6 text-white" /></a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="3" class="text-center">Tidak Ada Data Warga Binaan.</td>
        </tr>
        @endforelse
    </table>
</div>
@include('layouts.partials.pagination',['datas'=>$napis])

@endsection