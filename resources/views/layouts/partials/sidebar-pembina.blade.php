<div class="drawer-side is-drawer-close:overflow-visible">
    <label for="my-drawer-4" aria-label="close sidebar" class="drawer-overlay"></label>
    <div class="flex min-h-full flex-col items-start bg-base-200 is-drawer-close:w-14 is-drawer-open:w-64">
        <div class="flex w-full bg-primary text-primary-content min-h-16">
            <a href="/pembina" class="w-full flex items-center justify-center grow normal-case text-xl overflow-hidden">
                <x-lucide-shield-check class="w-7" />
                <span class="is-drawer-close:hidden ml-2 truncate">Pembina Panel</span>
            </a>
        </div>
        <!-- Sidebar content here -->
        <ul class="menu w-full grow bg-primary/10 border-r border-primary/20">
            <!-- List item 1: Dashboard -->
            <li>
            <a href="/pembina" class="is-drawer-close:tooltip is-drawer-close:tooltip-right {{ $active === 'dashboard' ? 'bg-primary/80 text-primary-content' : '' }}" data-tip="Dashboard">
                <!-- Home icon (Menggunakan Lucide House) -->
                <x-lucide-house class="my-1.5 inline-block size-4" />
                <span class="is-drawer-close:hidden">Dashboard</span>
            </a>
            </li>

             <!-- List item 2: Daftar Kegiatan -->
            <li>
            <a href="/pembina/kegiatan" class="is-drawer-close:tooltip is-drawer-close:tooltip-right {{ $active === 'kegiatan' ? 'bg-primary text-primary-content' : '' }}" data-tip="Kegiatan">
                <!-- Daftar Kegiatan icon (Menggunakan Lucide Calendar) -->
                <x-lucide-calendar class="my-1.5 inline-block size-4" />
                <span class="is-drawer-close:hidden truncate">Kegiatan</span>
            </a>
            </li>

            <!-- List item 3: Log Kegiatan -->
            <li>
            <a href="/pembina/log-kegiatan" class="is-drawer-close:tooltip is-drawer-close:tooltip-right {{ $active === 'log-kegiatan' ? 'bg-primary text-primary-content' : '' }}" data-tip="Log Kegiatan">
                <!-- Log Kegiatan icon (Menggunakan Lucide Activity) -->
                <x-lucide-activity class="my-1.5 inline-block size-4" />
                <span class="is-drawer-close:hidden truncate">Log Kegiatan</span>
            </a>
            </li>

            <!-- List item 4: Tahanan -->
            <li>
            <a href="/pembina/tahanan" class="is-drawer-close:tooltip is-drawer-close:tooltip-right {{ $active === 'tahanan' ? 'bg-primary text-primary-content' : '' }}" data-tip="Tahanan">
                <!-- Tahanan icon (Menggunakan Lucide Users) -->
                <x-lucide-users class="my-1.5 inline-block size-4" />
                <span class="is-drawer-close:hidden">Tahanan</span>
            </a>
            </li>

            <!-- Spacer -->
            <li class="flex-1 invisible"></li>
            <div class="divider"></div>
            
            <!-- List item 5: Settings -->
            <li>
            <a class="is-drawer-close:tooltip is-drawer-close:tooltip-right" data-tip="Settings">
                <!-- Settings icon (Menggunakan Lucide Settings) -->
                <x-lucide-settings class="my-1.5 inline-block size-4" />
                <span class="is-drawer-close:hidden">Settings</span>
            </a>
            </li>

             <!-- List item 6: Keluar -->
            <li>
                <button class="is-drawer-close:tooltip is-drawer-close:tooltip-right cursor-pointer" onclick="logout_modal.showModal()">
                    <x-lucide-log-out class="my-1.5 inline-block size-4" />
                    <span class="is-drawer-close:hidden">Keluar</span>
                </button>
            </li>

        </ul>
    </div>
</div>