@props([
    'maxContentWidth' => null,
])

<x-filament::layouts.base :title="$title">
    <div class="flex w-full h-full filament-app-layout overflow-x-clip">
        <div
            x-data="{}"
            x-cloak
            x-show="$store.sidebar.isOpen"
            x-transition.opacity.500ms
            x-on:click="$store.sidebar.close()"
            class="fixed inset-0 z-20 w-full h-full filament-sidebar-close-overlay bg-gray-900/50 lg:hidden"
        ></div>

        <x-filament::layouts.app.sidebar />

        <div
            @if (config('filament.layout.sidebar.is_collapsible_on_desktop'))
                x-data="{}"
                x-bind:class="{
                    'lg:pl-[var(--collapsed-sidebar-width)] rtl:lg:pr-[var(--collapsed-sidebar-width)]': ! $store.sidebar.isOpen,
                    'filament-main-sidebar-open lg:pl-[var(--sidebar-width)] rtl:lg:pr-[var(--sidebar-width)]': $store.sidebar.isOpen,
                }"
                x-bind:style="'display: flex'" {{-- Mimics `x-cloak`, as using `x-cloak` causes visual issues with chart widgets --}}
            @endif
            @class([
                'filament-main flex-col gap-y-6 w-screen flex-1 rtl:lg:pl-0',
                'hidden h-full transition-all' => config('filament.layout.sidebar.is_collapsible_on_desktop'),
                'flex lg:pl-[var(--sidebar-width)] rtl:lg:pr-[var(--sidebar-width)]' => ! config('filament.layout.sidebar.is_collapsible_on_desktop'),
            ])
        >
            <x-filament::topbar :breadcrumbs="$breadcrumbs" />

            <div @class([
                'filament-main-content flex-1 w-full px-4 mx-auto md:px-6 lg:px-8',
                match ($maxContentWidth ??= config('filament.layout.max_content_width')) {
                    null, '7xl', '' => 'max-w-7xl',
                    'xl' => 'max-w-xl',
                    '2xl' => 'max-w-2xl',
                    '3xl' => 'max-w-3xl',
                    '4xl' => 'max-w-4xl',
                    '5xl' => 'max-w-5xl',
                    '6xl' => 'max-w-6xl',
                    'full' => 'max-w-full',
                    default => $maxContentWidth,
                },
            ])>
                {{ \Filament\Facades\Filament::renderHook('content.start') }}

                {{ $slot }}

                {{ \Filament\Facades\Filament::renderHook('content.end') }}

            <div
			class="sticky flex items-center justify-between h-4 p-5 px-6 m-2 text-gray-900 cursor-pointer lg:h-20 lg:w-1/3 shadow-3xl rounded-2xl bg-primary-300" id="bar-mobile">
			<div
            onclick="routeto('/admin')"
            class="flex flex-col items-center transition duration-200 ease-in hover:text-blue-400 ">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-5 h-4 bi bi-house" viewBox="0 0 16 16">
  <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z"/>
</svg>
בית
			</div>


            <div
            onclick="routeto('/admin/my-profile')"
            class="flex flex-col items-center transition duration-200 ease-in hover:text-blue-400 ">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-4" fill="none" viewBox="0 0 24 24"
					stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
						d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z">
					</path>
				</svg>
                פרופיל
			</div>


            <div
            onclick="openQuickCreateMenu()"
            class="flex flex-col items-center hover:text-blue-400">
				<div
					class="absolute flex items-center justify-center w-20 h-20 p-2 text-3xl text-center text-white transition duration-200 ease-in border-4 rounded-full shadow-2xl bg-primary-600 bottom-5 border-gray-50 hover:border-blue-500 ">
					<i class="fa-solid fa-plus"></i>
					<span
                            class="absolute inline-flex w-full h-full border-4 rounded-full opacity-50 "></span>
				</div>
			</div>


            <div
            onclick="routeto('/admin/events')"
            class="flex flex-col items-center transition duration-200 ease-in hover:text-blue-400">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-5 h-4 bi bi-calendar3" viewBox="0 0 16 16">
  <path d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2M1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857z"/>
  <path d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2m3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
</svg>
ארועים
			</div>


            <div
            onclick="routeto('/admin/customers')"
            class="flex flex-col items-center transition duration-200 ease-in hover:text-blue-400">
            <svg xmlns="http://www.w3.org/2000/svg"  fill="currentColor" class="w-5 h-4 bi bi-people" viewBox="0 0 16 16">
  <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4"/>
</svg>
לקוחות
			</div>
		</div>
	</div>
</div>
            </div>

            <div class="py-4 mt-[4rem] filament-main-footer shrink-0">
                <x-filament::footer />
            </div>
        </div>
    </div>

    <style>
        #bar-mobile {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            margin: 0;
        }

        @media (min-width: 1024px) {
            #bar-mobile {
                right: 33%;
            }
        }
    </style>

    <script>
        function routeto(route) {
            window.location.href =  window.location.origin + route;
        }

        function openQuickCreateMenu() {
            document.querySelector('.filament-dropdown-panel').style.minWidth = "100vw";
            document.querySelector('.filament-dropdown-panel').style.right="0";


            document.querySelector('.filament-dropdown-trigger button').setAttribute('aria-expanded', true);
            setTimeout(() => {
                document.querySelector('.filament-dropdown-trigger button').click();
            }, 100);



        }
    </script>
</x-filament::layouts.base>
