<nav>
    <header class="sidebar-header" style="margin: 10px">
        <div class="text header-text">
            <button type="button" class="btn-close" aria-label="Close" id="close-sidebar"></button>
            <div class="card-body">
                <div class="d-flex text-black">
                    <div class="flex-grow-1">
                        <div class="row px-3">
                            <div class="col-md-4 p-0">
                                <img src="{{ Avatar::create(Auth::user()->name)->toBase64(); }}" alt="Generic placeholder image" class="img-fluid"
                                     style="width: 50px; border-radius: 10px;">
                            </div>
                            <div class="col-md-8 p-0">
                                <p class="mb-1">{{ strtoupper(Auth::user()->name) }}</p>
                                <p class="mb-2 pb-1" style="color: #2b2a2a;">Senior Developer</p>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center rounded-3 p-2 mb-2 text-center" style="background-color: #efefef;font-size: 14px">
                            <div>
                                <p class="small text-muted mb-1">Todolist</p>
                                <p class="mb-0">{{ $count_todolist }}</p>
                            </div>
                            <div class="px-3">
                                <p class="small text-muted mb-1">Revenue</p>
                                <p class="mb-0" style="font-size:12px">{{ number_format($revenueThisMonth, 0, ',', '.') }}</p>
                            </div>
                            <div>
                                <p class="small text-muted mb-1">Expense</p>
                                <p class="mb-0" style="font-size:12px">{{ number_format($expenseThisMonth, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="menu-bar">
        <div class="menu">
            <ul class="menu-links">
                <li class="nav-link">
                    <a href="{{ route('home') }}" class="sidebar-active">
                        <i class='bx bx-home-alt icon' ></i>
                        <span class="text nav-text">Dashboard</span>
                    </a>
                </li>
                <li class="nav-link">
                    <a href="{{ route('revenue') }}">
                        <i class='bx bx-money icon'></i>
                        <span class="text nav-text">Revenue</span>
                    </a>
                </li>
                <li class="nav-link">
                    <a href="{{ route('expense') }}">
                        <i class='bx bx-money-withdraw icon'></i>
                        <span class="text nav-text">Expense</span>
                    </a>
                </li>
                <li class="nav-link">
                    <a href="{{ route('todolist') }}">
                        <i class='bx bx-edit-alt icon'></i>
                        <span class="text nav-text">Todolist</span>
                    </a>
                </li>

                <li class="nav-link">
                    <a href="{{ route('investment') }}">
                        <i class='bx bxs-bar-chart-alt-2 icon'></i>
                        <span class="text nav-text">Investment</span>
                    </a>
                </li>

            </ul>
        </div>

        <div class="bottom-content">
            <li class="">
                <form action="{{ route('logout') }}" method="POST" id="logout-form">
                    @csrf
                    <a href="#" onclick="$('#logout-form').submit();">
                        <i class='bx bx-log-out icon' ></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </form>
            </li>
        </div>
    </div>
</nav>
@push('js')
    <script>
        const menu_toggle = document.querySelector("#hamburger"),
            close_sidebar = document.querySelector("#close-sidebar"),
            body = document.querySelector('body'),
            sidebar = body.querySelector('.sidebar'),
            modeSwitch = body.querySelector(".toggle-switch");

        // dark mode
        @if(Auth::user()->themes)
            @if(Auth::user()->themes->mode == 'dark')
                body.classList.toggle("dark");
            @endif

            @if(Auth::user()->themes->mode == 'light')
                body.classList.toggle("light");
            @endif
        @endif

        // sidebar toggle
        menu_toggle.addEventListener('click', () => {
            sidebar.classList.toggle("is-active");
        });

        close_sidebar.addEventListener('click', () => {
            sidebar.classList.remove("is-active");
        });

        $(window).resize(function(){
            if(window.innerWidth > 768){
                $('.sidebar').removeClass('is-active');
            }
        });
    </script>
    <script>
        (function () {
            let current_page = window.location.href;
            let nav = document.querySelectorAll('.nav-link > a');
            let active_page = document.querySelectorAll('.nav-link > a')[0];
            if(active_page.classList.contains('sidebar-active')){
                active_page.classList.remove('sidebar-active');
            }
            for (let i = 0; i < nav.length; i++) {
                if (nav[i].href == current_page) {
                    nav[i].classList.add('sidebar-active');
                }
            }
        })();
    </script>

@endpush

