@extends('layouts.app')
@section('title')
    Data Tahanan
@endsection



@section('content')

<h1>Data Tahanan</h1>
<a href="/tahanan/create">Tambah Tahanan</a>


<div class="overflow-x-auto rounded-box border border-base-content/5 bg-base-100">
    <table class="table">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Aksi</th>
        </tr>
        @foreach($tahanans as $tahanan)
        <tr>
            <td>{{ $tahanan->id }}</td>
            <td>{{ $tahanan->nama }} bin {{ $tahanan->nama_ayah }}</td>
            <td>
                <a href="/tahanan/{{ $tahanan->id }}" class="btn btn-info">Detail</a>
                <a href="/tahanan/{{ $tahanan->id }}/edit" class="btn btn-warning">Edit</a>
                <form action="/tahanan/{{ $tahanan->id }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-error">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
</div>
@endsection