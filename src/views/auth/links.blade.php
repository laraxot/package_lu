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
    <li class="nav-item">
        <a href="{{ asset('/login') }}" class="ajax-popup-link nav-link">
            <i class="fa fa-sign-in"></i>&nbsp;Sign in
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ asset('/register') }}" class="ajax-popup-link nav-link">
            <i class="fa fa-edit"></i>&nbsp;Sign up
        </a>
    </li>
    {{--
    <li class="nav-item">
        <a class="popup-ajax nav-link" 
            href="#popup-ajax" 
            data-effect="mfp-move-from-top"  
            title="Sign in" 
            data-src="{{ asset('/login') }}">
            <i class="fa fa-sign-in"></i>&nbsp;Sign in Ajax
        </a>
    </li>

    <li  class="nav-item"><a class="popup-text nav-link" href="#login-dialog" data-effect="mfp-move-from-top"><i class="fa fa-sign-in"></i>&nbsp;Sign in</a>
    </li>
    <li  class="nav-item"><a class="popup-text nav-link" href="#register-dialog" data-effect="mfp-move-from-top"><i class="fa fa-edit"></i>&nbsp;Sign up</a>
    </li>
    --}}
@endif

{{--
<div id="popup-ajax" class="mfp-with-anim mfp-hide mfp-dialog clearfix"><i class="fa fa-refresh fa-spin"></i></div>    
@include('lu::auth.login_register_recover')
--}}
{{ Theme::add('theme/bc/jquery/dist/jquery.min.js') }}
{{ Theme::add('theme/bc/magnific-popup/dist/jquery.magnific-popup.min.js') }}
{{ Theme::add('theme/bc/magnific-popup/dist/magnific-popup.css') }}

{{ Theme::add('lu::css/lighbox.css') }}
{{ Theme::add('lu::js/lighbox.js') }}