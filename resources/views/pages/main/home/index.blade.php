<x-main-layout>
    <h1 class="text-center text-4xl">HOMEE</h1>
    <p>User: {{ Auth::user() }}</p>
    <form action="{{ route('auth.logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
</x-main-layout>
