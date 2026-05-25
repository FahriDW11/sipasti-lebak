<nav class="navbar w-full bg-primary/95 text-primary-content sticky top-0 z-50">
  <label for="my-drawer-4" aria-label="open sidebar" class="btn btn-square btn-ghost">
    <!-- Sidebar toggle icon (Menggunakan Lucide PanelLeftClose) -->
    <x-lucide-panel-left-close class="my-1.5 inline-block size-4" />
  </label>

  <div class="px-4 flex-1"><h2 class="text-xl font-bold">{{isset($title) ? $title : env('APP_NAME')}}</h2></div>
  <div class="flex">
    @include('layouts.components.theme-swap')
  </div>
</nav>


