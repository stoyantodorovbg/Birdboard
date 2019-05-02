<nav class="bg-header pl-3 pr-3">
    <div class="container mx-auto">
        <div class="flex justify-between items-center py-2">
            <a class="navbar-brand no-underline" href="{{ url('/') }}">
                <i class="fa fa-dove text-blue-light"></i>
                <span class="text-black text-lg font-bold">
                    {{ config('app.name', 'Birdboard') }}
                </span>
                <span class="p-2 text-xs text-black">
                    Feathery reminder
                </span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div>
                <!-- Right Side Of Navbar -->
                <div class="flex items-center ml-auto ">
                    <!-- Authentication Links -->
                    @guest
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        @if (Route::has('register'))
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        @endif
                    @else
                        <theme-switcher></theme-switcher>
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <a class="flex items-center text-default text-s" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                              style="display: none;">
                            @csrf
                        </form>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</nav>
