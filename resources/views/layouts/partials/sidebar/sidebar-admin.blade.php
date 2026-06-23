@extends('layouts.partials.sidebar.sidebar')

@php
    $listItems = [
        ['name' => 'Dashboard', 'icon' => 'house', 'route' => '/admin', 'active' => 'dashboard'],
        ['name' => 'Kegiatan', 'icon' => 'calendar', 'route' => '/admin/kegiatan', 'active' => 'kegiatan'],
        ['name' => 'Log Kegiatan', 'icon' => 'activity', 'route' => '/admin/log-kegiatan', 'active' => 'log-kegiatan'],
        ['name' => 'Pembina', 'icon' => 'user', 'route' => '/admin/pembina', 'active' => 'pembina'],
        ['name' => 'Warga Binaan', 'icon' => 'users', 'route' => '/admin/napi', 'active' => 'napi'],
    ];
@endphp

@section('sidebar-content')

@foreach ($listItems as $item)
    <li>
        <a href="{{ $item['route'] }}" class="is-drawer-close:tooltip is-drawer-close:tooltip-right {{ $active === $item['active'] ? 'bg-primary text-primary-content' : '' }}" data-tip="{{ $item['name'] }}">
            <x-dynamic-component :component="'lucide-' . $item['icon']" class="my-1.5 inline-block size-4" />
            <span class="is-drawer-close:hidden {{ strlen($item['name']) > 10 ? 'truncate' : '' }}">{{ $item['name'] }}</span>
        </a>
    </li>
@endforeach

@endsection
