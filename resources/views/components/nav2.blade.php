<nav class="flex top-0 z-10 fixed w-full justify-end items-center p-5 bg-greenSecondary border-b border-gray-400">
    <div class="text-3xl text-white gap-4 flex items-center">
        <span class="iconify" data-icon="qlementine-icons:user-16"></span>
        @php
            $user = auth()->user();
            if ($user->hasRole('seller')) {
            $profileUrl = route('profile-seller');
            } elseif ($user->hasRole('admin')) {
            $profileUrl = route('profile-admin');
            } else {
            $profileUrl = route('profile-user');
            }
        @endphp
        <a href="{{ $profileUrl }}" class="text-lg font-medium mr-16">{{ auth()->user()->name }}</a>
    </div>
</nav>