@if ($errors->any())
    <div class="alert alert-error mb-4">
        <ul>
            @foreach ($errors->all() as $error)
                <li class="text-sm text-error-content"><x-lucide-alert-triangle class="w-4 h-4 inline mr-2 center" />{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif