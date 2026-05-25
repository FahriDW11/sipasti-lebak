@extends('layouts.app')

@section('content')
    <div class="drawer lg:drawer-open">
        <input id="my-drawer-4" type="checkbox" class="drawer-toggle" />
        
        <div class="drawer-content">
            <!-- Navbar -->
            @include('layouts.partials.navbar' )
            <div class="m-1 md:m-1.5 lg:m-2 bg-base-100 rounded-lg p-4">
                @yield('pembina-content')
            </div>
            @include('layouts.partials.addition')
        </div>

        @include('layouts.partials.sidebar-pembina')
    </div>
@endsection