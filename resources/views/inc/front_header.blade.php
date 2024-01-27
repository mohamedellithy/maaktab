<!-- ====== Header Start ====== -->
<header class="ud-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{ asset('logo.png') }}" alt="Logo">
                    </a>
                    <button class="navbar-toggler">
                        <span class="toggler-icon"> </span>
                        <span class="toggler-icon"> </span>
                        <span class="toggler-icon"> </span>
                    </button>

                    <div class="navbar-collapse">
                        <ul id="nav" class="navbar-nav mx-auto">
                            @guest
                                @php $current_page = isset($page) ? $page : null @endphp
                                @foreach(ActivePagesMenus(['position','!=' , 'footer']) as $page)
                                    @if($page->position != 'hidden')
                                        @if($loop->iteration < 7)
                                            <li class="nav-item @if($current_page == $page) active @endif">
                                                <a class="ud-menu-scroll" href="{{ url($page->slug) }}">
                                                    {{  $page->title }}
                                                </a>
                                            </li>
                                        @elseif($loop->iteration >= 7)
                                            @if($loop->iteration == 7)
                                                <li class="menu-item-has-children"><a href="#">صفحات أخرى</a>
                                                    <ul class="ud-submenu">
                                                        <li class="ud-submenu-item @if($current_page == $page) active @endif">
                                                            <a class="ud-submenu-link" href="{{ url($page->slug) }}">{{ $page->title }}</a>
                                                        </li>
                                            @else
                                                        <li class="ud-submenu-item @if($current_page == $page) active @endif">
                                                            <a href="{{ url($page->slug) }}" class="ud-submenu-link">
                                                                {{ $page->title }}
                                                            </a>
                                                        </li>
                                            @endif

                                            @if($loop->last)
                                                    </ul>
                                                </li>
                                            @endif
                                        @endif
                                    @endif
                                @endforeach
                            @else
                                <li class="nav-item">
                                    <a class="ud-menu-scroll " href="{{ url('/') }}">
                                        <i class='lni lni-dashboard'></i>
                                        الرئيسية
                                    </a>
                                </li>
                                <li class="nav-item {{ IsActiveOnlyIf(['projects_show','single_project']) }}">
                                    <a class="ud-menu-scroll {{ IsActiveOnlyIf(['projects_show','single_project']) }}" href="{{ route('projects_show') }}">
                                        <i class='lni lni-first-aid'></i>
                                        تصفح المشاريع
                                    </a>
                                </li>
                                <li class="nav-item {{ IsActiveOnlyIf(['services','single_service']) }}">
                                    <a class="ud-menu-scroll {{ IsActiveOnlyIf(['services','single_service']) }}" href="{{ route('services') }}">
                                        <i class='lni lni-grid-alt'></i>
                                        الخدمات
                                    </a>
                                </li>
                                <li class="nav-item {{ IsActiveOnlyIf(['my-orders','order-single']) }}">
                                    <a class="ud-menu-scroll {{ IsActiveOnlyIf(['my-orders','order-single']) }}" href="{{ route('my-orders') }}">
                                        <i class='lni lni-layers'></i>
                                        مشاريعي
                                    </a>
                                </li>
                                <li class="nav-item {{ IsActiveOnlyIf(['my-payments']) }}">
                                    <a class="ud-menu-scroll {{ IsActiveOnlyIf(['my-payments']) }}" href="{{ route('my-payments') }}">
                                        <i class='lni lni-wallet'></i>
                                        مدفوعاتي
                                    </a>
                                </li>
                            @endguest
                        </ul>
                    </div>

                    {{-- d-none --}}
                    <div class="navbar-btn  d-sm-inline-block">
                        @guest
                            <a href="{{ route('login') }}" class="ud-main-btn ud-login-btn">
                                تسجيل الدخول
                            </a>
                            <a href="{{ route('register') }}"  class="ud-main-btn ud-white-btn" href="javascript:void(0)">
                                انشاء الحساب
                            </a>
                        @else
                        <div class="dropdown">
                            <button class="btn btn-success dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="lni lni-user"></i>
                                {{ auth()->user()->name }}
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <a class="dropdown-item" href="{{ route('setting-account') }}">
                                <i class="lni lni-cog"></i>
                                اعدادات الحساب
                              </a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="#" onclick="document.getElementById('logout').submit()">
                                <i class="lni lni-exit"></i>
                                تسجيل الخروج
                              </a>
                            </div>
                        </div>
                        <form id="logout" method="post" action="{{ route('logout') }}">
                            @csrf
                        </form>
                        @endguest
                    </div>
                </nav>
            </div>
        </div>
    </div>
    @yield('after_header')
</header>
<!-- ====== Header End ====== -->
