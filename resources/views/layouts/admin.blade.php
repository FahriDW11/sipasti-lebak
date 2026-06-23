@extends('layouts.app')

@php
    $role = 'admin';
@endphp

@section('content')
    <div class="drawer lg:drawer-open">
        <input id="my-drawer-4" type="checkbox" class="drawer-toggle" />
        
        <div class="drawer-content bg-base-100">
            <!-- Navbar -->
            @include('layouts.partials.navbar')
            <!-- @include('layouts.partials.breadcrumbs') -->
            <div class="m-1 md:m-1.5 lg:m-2 bg-base-200 rounded-lg p-4">
                @yield('admin-content')
            </div>
            @include('layouts.partials.addition')
        </div>

        @include('layouts.partials.sidebar.sidebar-admin', ['active' => $active])
    </div>
@endsection