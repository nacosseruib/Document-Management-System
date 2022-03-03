@if($showMenu == 1)
    <li class="@yield('currentPageIndex')"><a href="{{ Route::has('index') ? Route('index') : 'javascript:;' }}"> <i class="fa fa-home"></i> <b>Home</b> </a></li>
    <li class="@yield('currentPageAboutUs')"><a href="{{ Route::has('viewVisitorPage') ? Route('viewVisitorPage', ['pageRoute'=>'about-us']) : 'javascript:;' }}"><b>About us</b></a></li>
    <li class="@yield('currentPageMyAccount')"><a href="{{ Route::has('myAccount') ? Route('myAccount') : 'javascript:;' }}"><b>My Account</b></a>
        <ul>
            @if(Auth::check())
                <li><a href="{{ Route::has('logout') ? Route('logout') : 'javascript:;' }}">Logout</a></li>
                <li><a href="{{ Route::has('dashboard') ? Route('dashboard') : 'javascript:;' }}">Dashboard</a></li>
            @else
                <li><a href="{{ Route::has('login') ? Route('login') : 'javascript:;' }}">Login</a></li>
                <li><a href="{{ Route::has('register') ? Route('register') : 'javascript:;' }}">Sign up</a></li>
            @endif
		</ul>
    </li>
    <li class="@yield('currentPageContactUs')"><a href="{{ Route::has('contactUs') ? Route('contactUs') : 'javascript:;' }}"><b>Contact us</b></a></li>
@endif
