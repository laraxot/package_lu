@if(\Auth::check())
    <li  class="nav-item"><a class="popup-text " href="#" data-effect="mfp-move-from-top"><i class="fa fa-user"></i>Welcome {{\Auth::user()->handle}}!</a>
    <li>
        <a href="{{ url('/logout') }}"
           onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
            Logout
        </a>
        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
        </form>
    </li>
@else
    <li  class="nav-item"><a class="popup-text nav-link" href="#login-dialog" data-effect="mfp-move-from-top"><i class="fa fa-sign-in"></i>&nbsp;Sign in</a>
    </li>
    <li  class="nav-item"><a class="popup-text nav-link" href="#register-dialog" data-effect="mfp-move-from-top"><i class="fa fa-edit"></i>&nbsp;Sign up</a>
    </li>
@endif