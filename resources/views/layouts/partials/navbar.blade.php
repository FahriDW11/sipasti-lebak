<nav class="navbar w-full bg-base-100/80 backdrop-blur-md border-b border-base-300 sticky top-0 z-10">
  <label for="my-drawer-4" aria-label="open sidebar" class="btn btn-square btn-ghost">
    <!-- Sidebar toggle icon (Menggunakan Lucide PanelLeftClose) -->
    <x-lucide-panel-left-close class="my-1.5 inline-block size-4" />
  </label>

  <div class="px-4 flex-1"><h2 class="text-xl font-bold">{{isset($title) ? $title : env('APP_NAME')}}</h2></div>
  <div class="flex">
    @include('layouts.components.theme-swap')
  </div>
</nav>


