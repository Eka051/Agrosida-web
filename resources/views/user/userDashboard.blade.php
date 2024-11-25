<h1 class="text-3xl m-auto">
    HALO, INI ADALAH User Dashboard
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
</h1>