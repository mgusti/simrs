@extends('layouts.app')

@section('content')
    <x-common.page-breadcrumb pageTitle="Ganti Password" />

    <div class="mx-auto max-w-lg">
        <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-theme-xs dark:border-gray-800 dark:bg-white/[0.03] sm:p-8">
            <h3 class="mb-6 text-lg font-semibold text-gray-800 dark:text-white/90">
                Ubah Password Akun
            </h3>

            @if(session('success'))
                <div class="mb-6 rounded-lg border border-green-200 bg-green-50 p-4 text-sm text-green-700 dark:border-green-800 dark:bg-green-900/20 dark:text-green-400">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('password.update') }}" method="POST">
                @csrf
                <div class="space-y-5">
                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Password Lama
                        </label>
                        <input type="password" name="old_password" required
                            class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 text-sm outline-hidden focus:border-brand-500 focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-800 dark:text-white @error('old_password') border-red-500 @enderror">
                        @error('old_password')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Password Baru
                        </label>
                        <input type="password" name="password" required
                            class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 text-sm outline-hidden focus:border-brand-500 focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-800 dark:text-white @error('password') border-red-500 @enderror">
                        @error('password')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="mb-1.5 block text-sm font-medium text-gray-700 dark:text-gray-400">
                            Konfirmasi Password Baru
                        </label>
                        <input type="password" name="password_confirmation" required
                            class="h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 text-sm outline-hidden focus:border-brand-500 focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-800 dark:text-white">
                    </div>

                    <button type="submit"
                        class="flex w-full items-center justify-center rounded-lg bg-brand-500 py-3 text-sm font-medium text-white transition hover:bg-brand-600 shadow-theme-xs">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
