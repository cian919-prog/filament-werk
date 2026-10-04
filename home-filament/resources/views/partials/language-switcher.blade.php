{{-- Language dropdown. Used by the Blade layout AND injected into the Filament top bar
     (see AdminPanelProvider, PanelsRenderHook::USER_MENU_BEFORE). One source = same look everywhere. --}}
<div class="relative z-50" x-data="{ open: false }">
    <button type="button"
            @click="open = !open"
            class="rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm font-medium text-slate-900 shadow-sm hover:bg-slate-50">
        {{ config('app.locales')[app()->getLocale()] ?? app()->getLocale() }}
    </button>
    <div x-show="open" x-cloak @click.outside="open = false"
         class="absolute right-0 mt-2 w-44 rounded-xl border border-slate-200 bg-white p-1 shadow-lg">
        @foreach (config('app.locales') as $code => $label)
            <a href="{{ route('locale', $code) }}"
               class="block rounded-lg px-3 py-2 text-sm text-slate-900 hover:bg-slate-50 {{ app()->getLocale() === $code ? 'font-semibold' : '' }}">
                {{ $label }}
            </a>
        @endforeach
    </div>
</div>
