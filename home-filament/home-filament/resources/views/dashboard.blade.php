@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-7xl">
    <div class="mb-8">
        <p class="text-sm font-medium text-indigo-600">{{ __('messages.welcome_back') }}</p>
        <h1 class="mt-1 text-3xl font-bold tracking-tight">{{ __('messages.dashboard') }}</h1>
        <p class="mt-2 text-slate-600">{{ __('messages.dashboard_intro') }}</p>
    </div>

    <div class="grid gap-6 md:grid-cols-2">
        <a href="{{ route('filament.admin.resources.users.index') }}" class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
            <div class="mb-4 text-2xl">👥</div>
            <h2 class="text-lg font-semibold">{{ __('messages.users') }}</h2>
            <p class="mt-1 text-sm text-slate-500">{{ __('messages.users_intro') }}</p>
        </a>

        <a href="{{ route('profile.edit') }}" class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
            <div class="mb-4 text-2xl">⚙️</div>
            <h2 class="text-lg font-semibold">{{ __('messages.settings') }}</h2>
            <p class="mt-1 text-sm text-slate-500">{{ __('messages.profile_intro') }}</p>
        </a>
    </div>
</div>
@endsection
