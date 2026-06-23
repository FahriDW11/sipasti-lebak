<div class="drawer-side is-drawer-close:overflow-visible">
    <label for="my-drawer-4" aria-label="close sidebar" class="drawer-overlay"></label>
    <div class="flex min-h-full flex-col items-start bg-base-200 is-drawer-close:w-14 is-drawer-open:w-64">
        <div class="flex w-full bg-base-100 min-h-16">
            <a href="/admin" class="w-full flex items-center justify-center grow normal-case text-xl overflow-hidden">
                <x-lucide-shield-check class="w-7" />
                <span class="is-drawer-close:hidden ml-2 truncate">{{ $role == 'admin' ? 'Admin Panel' : 'Pembina Panel' }}</span>
            </a>
        </div>

        <!-- Sidebar content here -->
        <ul class="menu w-full grow bg-base-100">
            @yield('sidebar-content')
            <!-- Spacer -->
            <li class="flex-1 invisible"></li>
            <div class="divider"></div>
            <!-- List item 5: Settings -->
            <!-- <li>
            <a class="is-drawer-close:tooltip is-drawer-close:tooltip-right" data-tip="Settings">
                Settings icon (Menggunakan Lucide Settings)
                <x-lucide-settings class="my-1.5 inline-block size-4" />
                <span class="is-drawer-close:hidden">Settings</span>
            </a>
            </li> -->
            <!-- List item 6: Keluar -->
            <li>
                <button class="is-drawer-close:tooltip is-drawer-close:tooltip-right cursor-pointer" onclick="logout_modal.showModal()" data-tip="Keluar">
                    <x-lucide-log-out class="my-1.5 inline-block size-4" />
                    <span class="is-drawer-close:hidden">Keluar</span>
                </button>
            </li>
        </ul>
    </div>
</div>