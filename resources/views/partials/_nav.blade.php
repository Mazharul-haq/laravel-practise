<nav class="flex justify-between items-center mb-4">
  <a href="/"><img class="w-24" src=" {{ asset('images/logo.png') }} " alt="" class="logo"/></a>
  <ul class="flex space-x-6 mr-6 text-lg">
    @auth  
    <li>
      Welcome <span class="font-bold uppercase">{{ auth()->user()->name }}</span>
    </li>
    <li>
      <a href="/listings/manage" class="hover:text-laravel"><i class="fa-solid fa-gear"></i> Manage Listings</a>
    </li>
    <li>
      <form action="/logout" method="post">
        @csrf
        <button class="text-red-500 font-bold">
          Logout
        </button>
      </form>
    </li>
    @else
    <li>
      <a href="/register" class="hover:text-laravel"><i class="fa-solid fa-user-plus"></i> Register</a>
    </li>
    <li>
      <a href="/login" class="hover:text-laravel"><i class="fa-solid fa-arrow-right-to-bracket"></i> Login</a>
    </li>
    @endauth
    
  </ul>
</nav>