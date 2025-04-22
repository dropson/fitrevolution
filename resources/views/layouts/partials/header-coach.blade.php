<header class="sticky top-0  text-white p-4 z-10 md:h-15">

    <nav class="navbar shadow absolute bg-accent/70 start-0 top-0 z-[1]">

        <div class="navbar-start">
            <a class="link text-base-content link-neutral text-xl font-semibold no-underline" href="#">
                Fit Revo
            </a>
        </div>

        <div class="navbar-center max-md:hidden ">
            
            @include('layouts.partials.navigation')
        </div>

        <div class="navbar-end items-center gap-4">

            @auth
                <div class="navbar-end flex items-center gap-4">

                    <div class="dropdown relative inline-flex [--auto-close:inside] [--offset:8] [--placement:bottom-end]">
                        <button id="dropdown-scrollable" type="button"
                            class="dropdown-toggle btn btn-text bg-gray-100 btn-circle dropdown-open:bg-base-content/10 size-10"
                            aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                            <div class="indicator">
                                <span class="icon-[tabler--list-details] text-base-content size-[1.375rem]"></span>
                            </div>
                        </button>

                        <ul class="dropdown-menu dropdown-open:opacity-100 hidden min-w-60" role="menu"
                            aria-orientation="vertical" aria-labelledby="dropdown-avatar">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <span class="icon-[tabler--user]"></span>
                                    My Profile
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    <span class="icon-[tabler--settings]"></span>
                                    Settings
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    <span class="icon-[tabler--receipt-rupee]"></span>
                                    Subscription
                                </a>
                            </li>
                            <li class="dropdown-footer gap-2">
                                <form method="POST" class="w-full" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-error btn-soft btn-block">
                                        <span class="icon-[tabler--logout]"></span>
                                        Sign out
                                    </button>
                                </form>

                            </li>
                        </ul>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}"
                    class="rounded-md py-2 px-4  bg-indigo-700 hover:bg-indigo-600 transition text-white">
                    Log in
                </a>

                <a href="{{ route('register') }}"
                    class="rounded-md py-2 px-4  bg-indigo-500 hover:bg-indigo-400 transition text-white">
                    Register
                </a>
            @endauth

        </div>
    </nav>

</header>
