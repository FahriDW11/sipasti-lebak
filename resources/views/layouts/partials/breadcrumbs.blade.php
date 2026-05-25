@php
// Contoh data breadcrumb, bisa diganti dengan data dinamis sesuai kebutuhan
$breadcrumbs = [
    ['name' => 'Home', 'url' => '../../'],
    ['name' => 'Documents', 'url' => '../'],
    ['name' => 'Add Document', 'url' => null], // Item terakhir, tidak perlu URL
];
@endphp


<div class="breadcrumbs text-sm mx-6">
  <ul>
    @foreach ($breadcrumbs as $breadcrumb)
        <li>
            @if ($breadcrumb['url'])
                <a href="{{ $breadcrumb['url'] }}" class="hover:underline">{{ $breadcrumb['name'] }}</a>
            @else
                <span>{{ $breadcrumb['name'] }}</span>
            @endif
        </li>
    @endforeach
  </ul>
</div>