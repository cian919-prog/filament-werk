@extends('layouts.app')

@section('content')
<div class="mx-auto max-w-3xl">
    <div class="mb-8">
        <h1 class="text-3xl font-bold tracking-tight">{{ __('messages.settings') }}</h1>
        <p class="mt-2 text-slate-600">{{ __('messages.profile_intro') }}</p>
    </div>

    <form method="POST" action="{{ route('profile.update') }}" class="space-y-6 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="block text-sm font-medium text-slate-700">{{ __('messages.name') }}</label>
            <input id="name" name="name" value="{{ old('name', $user->name) }}" required
                   class="mt-2 block w-full rounded-xl border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-slate-700">{{ __('messages.email') }}</label>
            <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" required
                   class="mt-2 block w-full rounded-xl border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        </div>

        <div class="border-t border-slate-100 pt-6">
            <h2 class="font-semibold">{{ __('messages.change_password') }}</h2>
            <p class="mt-1 text-sm text-slate-500">{{ __('messages.password_hint') }}</p>
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-slate-700">{{ __('messages.new_password') }}</label>
            <input id="password" type="password" name="password"
                   class="mt-2 block w-full rounded-xl border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-slate-700">{{ __('messages.confirm_password') }}</label>
            <input id="password_confirmation" type="password" name="password_confirmation"
                   class="mt-2 block w-full rounded-xl border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        </div>

        <div class="flex justify-end">
            <button class="rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500">
                {{ __('messages.save') }}
            </button>
        </div>
    </form>
</div>
@endsection
