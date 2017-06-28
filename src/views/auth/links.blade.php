@if(\Auth::check())
    <li class="nav-item dropdown">
        <a class="popup-text nav-link dropdown-toggle" href="#" data-effect="mfp-move-from-top" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-user"></i>Welcome {{\Auth::user()->handle}}!
        </a>
        <div class="dropdown-menu">
            <a href="{{ url('/logout') }}" class="dropdown-item" 
                onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">
                Logout
            </a>
            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
        </div>
    </li>
@else
    <li  class="nav-item"><a class="popup-text nav-link" href="#login-dialog" data-effect="mfp-move-from-top"><i class="fa fa-sign-in"></i>&nbsp;Sign in</a>
    </li>
    <li  class="nav-item"><a class="popup-text nav-link" href="#register-dialog" data-effect="mfp-move-from-top"><i class="fa fa-edit"></i>&nbsp;Sign up</a>
    </li>
@endif

@include('lu::auth.login_register_recover')

{{ Theme::add('theme/bc/jquery/dist/jquery.min.js') }}
{{ Theme::add('theme/bc/magnific-popup/dist/jquery.magnific-popup.min.js') }}
{{ Theme::add('theme/bc/magnific-popup/dist/magnific-popup.css') }}


{{ Theme::add('lu::css/lighbox.css') }}
 
{{ Theme::add('lu::js/lighbox.js') }}