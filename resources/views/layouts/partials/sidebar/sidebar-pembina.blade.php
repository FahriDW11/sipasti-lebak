@extends('layouts.partials.sidebar.sidebar')

@php
    $listItems = [
        ['name' => 'Dashboard', 'icon' => 'house', 'route' => '/pembina', 'active' => 'dashboard'],
        // ['name' => 'Kegiatan', 'icon' => 'calendar', 'route' => '/pembina/kegiatan', 'active' => 'kegiatan'],
        ['name' => 'Log Kegiatan', 'icon' => 'activity', 'route' => '/pembina/log-kegiatan', 'active' => 'log-kegiatan'],
        ['name' => 'Warga Binaan', 'icon' => 'users', 'route' => '/pembina/napi', 'active' => 'napi'],
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

