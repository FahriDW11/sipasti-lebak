@if ($datas->hasPages())
<div class="flex justify-center mt-4">
    <div class="join">
            
        {{-- Tombol Previous --}}
        @if ($datas->onFirstPage())
            <button class="join-item btn btn-sm lg:btn-md btn-disabled">«</button>
        @else
            <a href="{{ $datas->previousPageUrl() }}" class="join-item btn btn-sm lg:btn-md">«</a>
        @endif

        {{-- Daftar Angka Halaman --}}
        @foreach ($datas->getUrlRange(max(1, $datas->currentPage() - 2), min($datas->lastPage(), $datas->currentPage() + 2)) as $page => $url)
            @if ($page == $datas->currentPage())
                <button class="join-item btn btn-sm lg:btn-md btn-active btn-primary">{{ $page }}</button>
            @else
                <a href="{{ $url }}" class="join-item btn btn-sm lg:btn-md">{{ $page }}</a>
            @endif
        @endforeach

        {{-- Tombol Next --}}
        @if ($datas->hasMorePages())
            <a href="{{ $datas->nextPageUrl() }}" class="join-item btn btn-sm lg:btn-md">»</a>
        @else
            <button class="join-item btn btn-sm lg:btn-md btn-disabled">»</button>
        @endif

    </div>
</div>
@endif