<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    @if (auth()->user()->role === 'team_leader')
                        <x-nav-link :href="route('leader.dashboard')" :active="request()->routeIs('leader.dashboard')">
                            チーム管理
                        </x-nav-link>
                    @endif

                    <x-nav-link :href="route('rooms.index')" :active="request()->routeIs('rooms.index')">
                        部屋一覧
                    </x-nav-link>

                    <x-nav-link :href="route('mypage.index')" :active="request()->routeIs('mypage.*')">
                        マイページ
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <!-- ドロップダウンの内容 -->
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>