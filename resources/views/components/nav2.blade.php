<nav class="flex top-0 z-10 fixed w-full justify-end items-center p-5 bg-greenSecondary border-b border-gray-400">
    <div class="text-3xl text-white gap-4 flex items-center ">
        <span class="iconify" data-icon="qlementine-icons:user-16"></span>
        <p class="text-lg font-medium mr-16">{{ auth()->user()->name }}</p>
    </div>
</nav>